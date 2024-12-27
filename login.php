<?php
session_start();
require "./config/config.php";

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($user)) {
        echo "<script>alert('This email is not exist!');</script>";
    } else {
        $passwordVerify = password_verify($password, $user['password']);

        if ($passwordVerify) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['logged_in'] = time();
            header("Location: index.php");
        } else {
            echo "<script>alert('Password is not correct');window.location.href = 'login.php';</script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Social Media | Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h1 class="text-center text-4xl/10 font-bold text-violet-600 md:tracking-wider tracking-wide">MINI SOCIAL MEDIA</h1>
            <h2 class="text-center text-xl tracking-tight text-gray-900 mt-5">Login to your account</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="login.php" method="POST">

                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6" required>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>

                    </div>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" autocomplete="current-password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6" required>
                    </div>
                </div>

                <div>
                    <button type="submit" class="transition duration-100 mt-7 flex w-full justify-center rounded-md bg-violet-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-violet-700 hover:ease-in focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Login</button>
                </div>
            </form>

            <p class="mt-7 text-center text-sm/6 text-gray-500">
                create a account?
                <a href="sign-in.php" class="font-semibold text-violet-600 hover:text-violet-500">Sign in</a>
            </p>
        </div>
    </div>

    </div>
</body>

</html>