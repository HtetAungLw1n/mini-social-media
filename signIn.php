<?php
    require 'config.php';

    if(!empty($_POST)){
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $profilePicture = "defaultprofile.jpg";

        if($name == '' || $email == '' || $password == ''){
            echo "<script>alert('Fill all forms');</script>";
        }else {
            $sql = 'SELECT COUNT(email) AS num FROM users WHERE email=:email';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':email',$email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($result['num'] == 0){
                $passwordHash = password_hash($password,PASSWORD_BCRYPT);
                $sql = 'INSERT INTO users (name,email,password,profile_picture) VALUES (:name,:email,:passwordHash,:profilePicture)';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':name',$name);
                $stmt->bindValue(':email',$email);
                $stmt->bindValue(':passwordHash',$passwordHash);
                $stmt->bindValue(':profilePicture',$profilePicture);
                $result = $stmt->execute();

                if($result){
                  echo "<script>alert('Thanks for sign in.');
                  window.location.href='login.php'</script>";
                }
            }else {
                echo "<script>alert('This email is already exit');</script>";
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
    <title>MSM Sign In</title>
</head>
<body class="bg-neutral-50">
    <div class="isolate px-6 py-24 sm:py-32 lg:px-8">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Sign In</h2>
    </div>
    <form action="signIn.php" method="POST" class="mx-auto mt-10 max-w-xl sm:mt-10">
        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">

        <div class="sm:col-span-2">
            <label for="name" class="block text-sm/6 font-semibold text-gray-900">Name</label>
            <div class="mt-2.5">
            <input type="text" name="name" id="name" autocomplete="given-name" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-grey-800">
            </div>
        </div>

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
            <button type="submit" class="block w-full rounded-md bg-red-800 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-red-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Sign In</button>
            <button class="mt-5 block w-full rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-black shadow-sm hover:text-red-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a href="#">Back</a></button>
        </div>
    </form>
    </div>

</body>
</html>