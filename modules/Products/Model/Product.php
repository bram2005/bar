<?php

namespace possystem\modules\Products\Model;

/**
 * Class Product
 *
 * @property string $table;
 * @property int $id;
 * @property string $name;
 * @property float $price;
 * @property int $categoryID;
 * @property string $image;
 * @property int $image_width;
 *
 * @package possystem\modules\Products\Model
 * @author  bmarinus (10-5-2022 - 15:10)
 */
class Product
{
    public string $table;
    public int $id;
    public string $name;
    public float $price;
    public int $categoryID;
    public string $image;

    public function __construct()
    {
        $this->table = 'products';
    }
}