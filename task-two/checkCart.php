<?php
include_once 'include.php';
include_once 'Product.php';
include_once 'Category.php';
include_once 'Variant.php';
include_once 'Cart.php';


$cart = new Cart();

$val = $_SESSION['items'] ??array_flip($_SESSION['cart']);

foreach ($val as $name=>$value) {
    if ($name!== null) {
        $cart->addItem(Product::getProductByName($name),$_POST['last'.$name] ?? 1);
    }
}

// to flash back values after submitting
$lastIphone12pro = $_POST['lastIphone12pro'] ?? 1;
$lastIphone14promax = $_POST['lastIphone14promax'] ?? 1;
$lastLenovoLigon5 = $_POST['lastLenovoLigon5'] ?? 1;
$lastnova7i = $_POST['lastnova7i'] ?? 1;

if (isset($_POST['cancel'])) {
    unset(Cart::$items[Product::getProductByName($_POST['cancel'])->getName()]);
    $_SESSION['items'] = Cart::$items;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Demo</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tfoot {
            background-color: #007BFF;
            color: #fff;
        }

        tfoot td {
            font-weight: bold;
        }

        button {
            padding: 5px 10px;
        }
    </style>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach (array_keys(Cart::$items) as $name) :?>
        <?php if ($name !== null ): ?>
            <?php $price = Product::getProductPrice($name) ?>
            <?php  if (isset($_POST['added']) && ($name == $_POST['added'])) {$cart->addItem(Product::getProductByName($name),$_POST['last'.$name]);}?>
            <?php  if (isset($_POST['removed']) && ($name == $_POST['removed'])) {$cart->removeItem(Product::getProductByName($name),1);}?>
            <tr>
                <td><?= $name ;$quantity =$_POST['last'.$name] ?? Cart::$items[Product::getProductName($name)]?></td>
                <td><?=  $quantity?></td>
                <td>$<?=   isset($_POST['last'.$name]) ? $_POST['last'.$name]*$price : Cart::$items[Product::getProductName($name)] * $price ?></td>
                <td>
                    <form method="post">
                        <!--                To Avoid Lost Data while Submitting                   -->
                        <input type="hidden" name="<?= 'lastIphone12pro' ?>" value="<?= $lastIphone12pro?>">
                        <input type="hidden" name="<?= 'lastIphone14promax'?>" value="<?= $lastIphone14promax?>">
                        <input type="hidden" name="<?= 'lastLenovoLigon5'?>" value="<?= $lastLenovoLigon5?>">
                        <input type="hidden" name="<?= 'lastnova7i'?>" value="<?= $lastnova7i?>">
                        <!--                Update The Current One                                -->
                        <input type="hidden" name="<?= 'last'. $name ?>" value="<?= Cart::$items[Product::getProductName($name)]?>">
                        <button <?= $quantity ==1 ? 'disabled="disabled"' : ''?>  type="submit" name="removed" value="<?= $name ?>">-</button>
                        <button type="submit" name="added" value="<?= $name ?>">+</button>
                        <button type="submit" name="cancel" value="<?= $name ?>">remove from cart</button>
                    </form>
                </td>
            </tr>
        <?php endif; endforeach;?>
    </tbody>
    <tfoot>
    <tr>
        <td>Total</td>
        <td> </td>
        <td>$<?= $cart->getTotalPrice() ?></td>
        <td></td>
    </tr>
    </tfoot>
</table>
</body>
</html>