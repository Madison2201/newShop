<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\Category;
use shop\repositories\NotFoundException;

class CategoryRepository
{
    public function get(int $id): Category
    {
        if (!$tag = Category::findOne($id)) {
            throw new NotFoundException('Category is not found.');
        }
        return $tag;
    }

    public function save(Category $tag): void
    {
        if (!$tag->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Category $tag): void
    {
        if (!$tag->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}