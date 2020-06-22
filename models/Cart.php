<?php


namespace app\models;



class Cart extends Record
{
    protected int $userId;
    protected int $productId;
    protected int $amount;
    protected ?Product $product;
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