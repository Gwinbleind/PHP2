<?php


namespace app\models;



class Cart extends Record
{
    public int $userId;
    public int $productId;
    public int $amount;
    public ?Product $product;
    protected static array $hiddenProps = [
        'hiddenProps',
        'database',
        'id',
        'changed',
        'arrayOfColumns',
        'product',
    ];

    public static function getTableName(): string
    {
        return 'cart';
    }
    public function __construct($id = null)
    {
        parent::__construct($id);
    }
}