<?php

namespace possystem\modules\Products\Logic;

use possystem\classes\singleton\Singleton;

class Products
{
    use Singleton;
    private \possystem\modules\Products\Data\Products $data;

    public function __construct()
    {
        $this->data =new \possystem\modules\Products\Data\Products();
    }

    /**
     * @param string $name
     * @param float $price
     * @param int    $categoryID
     * @param string $image
     *
     * @return array
     * @author bmarinus (10-5-2022 - 15:39)
     */
    public function add(string $name, float $price, int $categoryID, string $image): array
    {
        return $this->data->add($name, $price, $categoryID, $image);

    }

    /**
     * @param int $productID
     *
     * @return array
     * @author bmarinus (16-5-2022 - 15:49)
     */
    public function remove(int $productID): array
    {
        return $this->data->remove($productID);
    }

    public function getByID(int $productID): array
    {
        return $this->data->getByID($productID);
    }

    public function getAll($type = 1): array
    {
        $products = $this->data->getAll();
        foreach ($products['result'] as $key => $product) {
            $price = $product->price * $type;
            $price /= 0.05;
            $price = ceil($price);
            $price *= 0.05;
            $products['result'][$key]->price = $price;
        }
        return $products;
    }

    public function change(int $productID, string $name, float $price, int $categoryID, string $image) {
        return $this->data->change($productID, $name, $price, $categoryID, $image);
    }

    public function getAllByCategoryID(int $categoryID, $type = 1): array
    {
        $products = $this->data->getAllByCategoryID($categoryID);
        foreach ($products['result'] as $key => $product) {
            $price = $product->price * $type;
            $price /= 0.05;
            $price = ceil($price);
            $price *= 0.05;
            $products['result'][$key]->price = $price;
        }
        return $products;
    }

}