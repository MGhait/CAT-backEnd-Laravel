<?php
session_start();
include_once 'Product.php';
include_once 'Category.php';
include_once 'Variant.php';
include_once 'Cart.php';

//$cart = new Cart();
$categories = [
    $iphone = new Category('Iphone'),
    $laptop =new Category('Laptop'),
    $phones = new Category('Phones'),
];


$products = [
    new Product('Iphone12pro', 'imges/iphone12pro.jpg', 2000),
    new Product('Iphone14promax', 'imges/iphone14promax.jpg', 3500),
    new Product('LenovoLigon5', 'imges/lenovolegoin5.jpg', 3000),
    new Product('nova7i', 'imges/nova7i.jpg', 1000)
];

