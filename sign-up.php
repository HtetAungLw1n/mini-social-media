<?php
session_start();
require "./config/config.php";

if (!empty($_POST)) {
  if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || strlen($_POST['password']) < 4) {
    if (empty($_POST['name'])) {
      $nameError = '* Name is empty';
    }
    if (empty($_POST['email'])) {
      $emailError = '* Email is empty';
    }
    if (empty($_POST['password'])) {
      $passwordError = '* Password is empty';
    } elseif (strlen($_POST['password']) < 4) {
      $passwordError = '* Password must be at least 4';
    }
  } else {
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mini Social Media | Sign Up Page</title>
  <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="h-screen bg-stone-900">
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h1 class="text-center text-4xl/10 font-bold text-violet-600 tracking-wider">MINI SOCIAL MEDIA</h1>
      <h2 class="text-center text-xl tracking-tight text-gray-100 mt-5">Sign up to your account</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm bg-stone-800 p-6 rounded-lg shadow-md">
      <form class="space-y-6" action="sign-up.php" method="POST">

        <div>
          <label for="name" class="block text-sm/6 font-medium text-gray-100">Your name</label>
          <div class="mt-2">
            <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-stone-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-stone-600 sm:text-sm/6">
            <p class="text-sm text-red-500 mt-2"> <?php echo empty($nameError) ? "" : $nameError ?></p>
          </div>
        </div>

        <div>
          <label for="email" class="block text-sm/6 font-medium text-gray-100">Email address</label>
          <div class="mt-2">
            <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-stone-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-stone-600 sm:text-sm/6">
            <p class="text-sm text-red-500 mt-2"> <?php echo empty($emailError) ? "" : $emailError ?></p>
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm/6 font-medium text-gray-100">Password</label>
          <div class="mt-2">
            <input type="password" name="password" id="password" autocomplete="current-password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-stone-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-stone-600 sm:text-sm/6">
            <p class="text-sm text-red-500 mt-2"> <?php echo empty($passwordError) ? "" : $passwordError ?></p>
          </div>

        </div>

        <div>
          <button type="submit" class="transition duration-100 mt-10 flex w-full justify-center rounded-md bg-violet-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-violet-700 hover:ease-in focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Sign up</button>
        </div>
      </form>

      <p class="mt-7 text-center text-sm/6 text-gray-500">
        Already having a account?
        <a href="login.php" class="font-semibold text-violet-600 hover:text-violet-500">Login</a>
      </p>
    </div>
  </div>

</body>

</html>