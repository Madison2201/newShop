<?php

namespace shop\services\manage\Shop;

use shop\entities\Meta;
use shop\entities\Shop\Brand;
use shop\forms\manage\Shop\BrandForm;
use shop\repositories\Shop\BrandRepository;
use shop\repositories\Shop\ProductRepository;

class BrandManageService
{
    private BrandRepository $brands;
    private ProductRepository $products;

    public function __construct(BrandRepository $brands, ProductRepository $products)
    {
        $this->brands = $brands;
        $this->products = $products;
    }

    public function create(BrandForm $form): Brand
    {
        $brand = Brand::create(
            $form->name,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->brands->save($brand);
        return $brand;
    }

    public function edit(int $id, BrandForm $form): void
    {
        $brand = $this->brands->get($id);
        $brand->edit(
            $form->name,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->brands->save($brand);
    }

    public function remove(int $id): void
    {
        $brand = $this->brands->get($id);
        if ($this->products->existsByBrand($brand->id)) {
            throw new \DomainException('Brand can not be removed, it is already used by other product.');
        }
        $this->brands->remove($brand);
    }
}