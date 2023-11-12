<?php

class Cart
{

    public static $items = [];
    public  $totalPrice = 0.0;


    public static function addItem(Product $product, $quantity) {
        if(array_key_exists($product->getName(), self::$items)) {
            // if it has a value I'll add one on the last value
            self::$items[$product->getName()] += 1;
        } else {
            self::$items[$product->getName()] = $quantity;
        }
    }

    public function removeItem(Product $product, $quantity) {
        if (array_key_exists($product->getName(), self::$items)) {
            if (self::$items[$product->getName()] >= 1) {
                self::$items[$product->getName()] -= 1;
            }
            else  {
                unset(self::$items[$product->getName()]);
            }
        }
    }

    public  function getTotalPrice() {
        foreach (self::$items as $productName => $quantity) {
            $product = self::getProductByName($productName);
            if ($product !== null) {
                $this->totalPrice += $product->getPrice() * $quantity;
            }
        }
        return $this->totalPrice;
    }


    public  function getProductByName($product)
    {
        foreach (Product::$instances as $productObject) {
            $name = $productObject->getName();
            if ($name == $product) {
                return $productObject;
            }
        }
        return null;
    }
}