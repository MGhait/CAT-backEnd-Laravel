<?php

$error = [];
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$error = ['email' => '', 'name' => ''];

    // getting the variables and sanitize them
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);


    // validation
    if (empty($email)) {
        $error['email'] = 'Email Can\'t be empty';
    } else {
        // validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Inter a Valid Email';
        }
    }
    if (empty($name)) {
        $error['name'] = 'Name Can\'t be empty';
    }

//    var_dump($error);
    if (empty($error['name']) && empty($error['email'])) {

        $message = 'you fill the from successfully ' . $name . ' your Email is: ' . $email;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Form</title>

</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;

    }
    .container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
    }
    form {
        display: flex;
        /*align-items: center;*/

        flex-direction: column;
    }
    label {
        margin: 10px 0;
    }
    input[type="text"], input[type="email"] {
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        width: 380px;
        border-radius: 5px;
    }
    #message {
        padding-top: 35px;
        text-align: center;
        font-weight: bold;
    }
    .success {
        color: green;
    }
    .error {
        color: red;
    }
</style>
<body>
<div class="container">
    <h2>Form</h2>
    <form action="" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <label>
            <span class="error">
                        <?= isset($error['name']) ? $error['name'] : ''?>
            </span>
        </label>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label>
            <span class="error">
                        <?= isset($error['email']) ? $error['email'] : ''?>
            </span>
        </label>
        <button type="submit" >Submit</button>
    </form>

    <div class="success" id="message">
        <?php if (empty($error['name']) && empty($error['email'])) :?>
            <?= $message ?>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
