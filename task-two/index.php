<?php
include 'include.php';
if (isset($_POST['added'])){
    $productChosen = $_POST['added'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (!in_array($productChosen,$_SESSION['cart'])){
        $_SESSION['cart'][] = $productChosen;
    }
}

if (isset($_POST['header'])) {
    header('Location: checkCart.php');
}

if (isset($_POST['reset'])) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Test Store
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            /*flex-direction: row;*/
            flex-direction: column;

        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        .product {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 250px;
            height: 300px;
            padding: 10px;
            margin: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .btn {
            position:absolute;
            top: 60%;
            right: 44%;
        }
        form {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .product img {
            max-width: 100%;
            height: auto;
        }

        .product h3 {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .product p {
            font-size: 1rem;
            margin: 10px 0;
        }
        .product img {
            max-width: 100%;
            height: auto;
            max-height: 150px; /* Set the maximum height to make the images smaller */
            width: auto;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        button:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
<h2>
    Products
</h2>

<form method="post" ACTION="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
    <div class="btn">
        <button <?= !isset($_SESSION['cart']) ? 'disabled="disabled"' : '' ?>
            <?= isset($_POST['reset']) ? 'hidden = "hidden"' : ''?>
                type="submit" name="header" value="goToCart">
            Go to cart
        </button>
        <button type="submit" name="reset" value="value">
            reset
        </button>
    </div>
    <?php foreach ($products as $product) :?>
        <div class="product">
            <img src="<?= $product->getImgURL() ?>" alt="<?= $product->getName()?>">
            <h3> <?= $product->getName(); ?> </h3>
            <p> <?= $product->getPrice() ?> </p>
            <button  type="submit" value="<?= $product->getName()?>" name="added" >
                Add to cart
            </button>
        </div>
    <?php endforeach;?>
</form>
</body>
</html>
