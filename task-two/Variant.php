<?php

class Variant
{
    private $color;
    private $size;


    public function __construct($color, $size)
    {
        $this->color = $color;
        $this->size = $size;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }




    public function addCategory(Category $param)
    {
    }


    public function removeCategory(Category $param)
    {
    }
}