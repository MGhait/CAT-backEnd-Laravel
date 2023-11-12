<?php

class Category
{
    private $name;

    private $products = [];
    private $variants = [];


    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function addProduct(Product $product)
    {
        if (!in_array($product, $this->products)){
            $this->products[] = $product;
            $product->addCategory($this);
        }
    }

    public function removeProduct(Product $product)
    {
        $key = array_search($product, $this->products);
        if ($key !== false) {
            unset($this->products[$key]);
            $product->removeCategory($this);
        }
    }

    public function addVariant(Variant $variant)
    {
        if (!in_array($variant, $this->variants)){
            $this->variants[] = $variant;
            $variant->addCategory($this);
        }
    }

    public function removeVariant(Variant $variant)
    {
        $key = array_search($variant, $this->variants);
        if ($key !== false) {
            unset($this->variants[$key]);
            $variant->removeCategory($this);
        }
    }


}