<?php

class Product
{
    private $name;
    private $imgURL;
    private $price;
    public static $instances = [];


    private $categories = [];
    private $variants = [];
    public function __construct($name, $imgURL, $price)
    {
        $this->name = $name;
        $this->imgURL = $imgURL;
        $this->price = $price;
        self::$instances[] = &$this;
    }

// getters
    public function getName()
    {
        return $this->name;
    }

    public function getImgURL()
    {
        return $this->imgURL;
    }

    public function getPrice()
    {
        return $this->price;
    }

// setters
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setImgURL($imgURL)
    {
        $this->imgURL = $imgURL;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }


    public function addCategory (Category $category) {
        if (!in_array($category, $this->categories)){
            $this->categories[] = $category;
            $category->addProduct($this);
        }
        return;
    }

    public function removeCategory(Category $category) {
        $key = array_search($category, $this->categories);
        if ($key!== false) {
            unset($this->categories[$key]);
            $category->removeProduct($this);
        }
    }

    public function addVariant(Variant $variant){
        if (!in_array($variant, $this->variants)) {
            $this->variants[] = $variant;
        }
    }

    public function removeVariant(Variant $variant) {
        $key = array_search($variant, $this->variants);
        if ($key !== false) {
            unset($this->variants[$key]);
        }
    }

    public static function getProductInstances() {
        return self::$instances;
    }

    public  static function getProductByName($product)
    {
        foreach (Product::$instances as $productObject) {
            $name = $productObject->getName();
            if ($name == $product) {
                return $productObject;
            }
        }
        return null;
    }

    // getter function to get product from string
    public static function getProductName($product) {
        return self::getProductByName($product)->name;
    }

    public static function getProductPrice($product) {
        return self::getProductByName($product)->price;
    }

}