<?php
    session_start();
    require 'config.php';

    if(!empty($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email=:email');
        $stmt->bindValue(':email',$email);
        $stmt->execute();
        $currentUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$currentUser){
            echo "<script>alert('This email is not exist.');</script>";
        } else {
            $passwordVaild = password_verify($password,$currentUser['password']);

            if(!$passwordVaild){
                echo "<script>alert('Your password is not correct.');</script>";
            }else {
                $_SESSION['user_id'] = $currentUser['id'];
                $_SESSION['logged_in'] = time();

                header('Location: index.php');
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>MSM Login</title>
</head>
<body class="bg-neutral-50">
    <div class="isolate px-6 py-24 sm:py-32 lg:px-8">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">MINI SOCIAL MEDIA</h2>
    </div>
    <form action="login.php" method="POST" class="mx-auto mt-10 max-w-xl sm:mt-10">
        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">

        <div class="sm:col-span-2">
            <label for="email" class="block text-sm/6 font-semibold text-gray-900">Email</label>
            <div class="mt-2.5">
            <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-grey-800">
            </div>
        </div>

        <div class="sm:col-span-2">
            <label for="password" class="block text-sm/6 font-semibold text-gray-900">Password</label>
            <div class="mt-2.5">
            <input type="password" name="password" id="company" autocomplete="organization" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-grey-800">
            </div>
        </div>

        </div>

        <div class="mt-10">
            <button type="submit" class="block w-full rounded-md bg-red-800 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-red-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Login</button>
            <button class="mt-5 block w-full rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-black hover:text-red-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a href="signIn.php">Sign In</a></button>
        </div>
    </form>
    </div>

</body>
</html>