<?php

namespace shop\services;


class ProductReader
{
    public function readCsv($file): array
    {
        $result = [];
        $f = fopen($file->tmpName, 'r');
        while ($row = fgets($f)) {
            $result[] = [
                'code' => $row[0],
                'price_old' => $row[1],
                'price_new' => $row[2],
                'modification' => $row[3],
                'modification_price' => $row[4],
            ];
        }
        fclose($f);
        return $result;
    }
}

//    public function import(int $id, ImportForm $form): void
//    {
//        $this->transaction->wrap(function () use ($form,) {
//            $results = $this->reader->readCsv($form->file);
//
//            foreach ($results as $result){
//                $product = $this->products->getByCode($result['code']);
//                $product->setPrice($result['price_new'], $result['price_old']);
//                $product->setModificationPriceByCode($result['modification'], $result['modification_price']);
//                $this->products->save($product);
//            }
//        });
//
//
//    }