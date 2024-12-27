<?php
session_start();
require "./config/config.php";

if (!empty($_POST)) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $profilePicture = 'defaultprofile.jpg';
  $userRole = 0;

  $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
  $stmt->bindValue(':email', $email);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    echo "<script>alert('This email is already existed!');</script>";
  } else {
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, profile_picture, role) VALUES (:name, :email, :password, :profilePicture, :role)");
    $result = $stmt->execute(
      array(':name' => $name, ':email' => $email, ':password' => $passwordHash, ':profilePicture' => $profilePicture, ':role' => $userRole)
    );

    if ($result) {
      echo "<script>alert('Account created successfully.');window.location.href = 'login.php';</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mini Social Media | Sign In Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style type="text/tailwindcss">
    @layer base {
            input {
               @apply block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6
            }
        }
    </style>
</head>

<body class="h-screen">
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h1 class="text-center text-4xl/10 font-bold text-violet-600 tracking-wider">MINI SOCIAL MEDIA</h1>
      <h2 class="text-center text-xl tracking-tight text-gray-900 mt-5">Sign in to your account</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="sign-in.php" method="POST">

        <div>
          <label for="name" class="block text-sm/6 font-medium text-gray-900">Your name</label>
          <div class="mt-2">
            <input type="text" name="name" id="name" autocomplete="name" required>
          </div>
        </div>

        <div>
          <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
          <div class="mt-2">
            <input type="email" name="email" id="email" autocomplete="email" required>
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
          <div class="mt-2">
            <input type="password" name="password" id="password" autocomplete="current-password" required>
          </div>
        </div>

        <div>
          <button type="submit" class="transition duration-100 mt-7 flex w-full justify-center rounded-md bg-violet-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-violet-700 hover:ease-in focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Sign in</button>
        </div>
      </form>

      <p class="mt-7 text-center text-sm/6 text-gray-500">
        Already having a account?
        <a href="login.php" class="font-semibold text-violet-600 hover:text-violet-500">Login</a>
      </p>
    </div>
  </div>

  </div>
</body>

</html>