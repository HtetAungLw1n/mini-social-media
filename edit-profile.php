<?php
session_start();
require "./config/config.php";

if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
    header("Location: login.php");
};


$stmt = $pdo->prepare("SELECT * FROM users WHERE id=" . $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $image = $_FILES['image']['name'] ? $_FILES['image']['name'] : $user['profile_picture'];

    $stmtForEmail = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $stmtForEmail->execute(['email' => $email]);
    $userForEmail = $stmtForEmail->fetch(PDO::FETCH_ASSOC);

    if ($userForEmail && $userForEmail['id'] != $user['id']) {
        echo "<script>alert('This email is already existed!');</script>";
    } else {
        if ($oldPassword && $newPassword) {
            $passwordVerify = password_verify($oldPassword, $user['password']);
            if ($passwordVerify) {
                $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);

                $path = 'image/profile/' . $image;
                $imageType = pathinfo($path, PATHINFO_EXTENSION);

                if ($imageType != 'jpg' && $imageType != 'png' && $imageType != 'jpeg') {
                    echo "<script>alert('Image type must be jpg, jpeg, or png!');</script>";
                } else {
                    move_uploaded_file($_FILES['image']['tmp_name'], $path);

                    $stmt = $pdo->prepare("UPDATE users SET name=:name, email=:email, password=:password, profile_picture=:profile_picture WHERE id=" . $_SESSION['user_id']);
                    $result = $stmt->execute(['name' => $name, 'email' => $email, 'password' => $passwordHash, 'profile_picture' => $image]);

                    if ($result) {
                        echo "<script>alert('Account updated successfully.');window.location.href = 'index.php';</script>";
                    }
                }
            } else {
                echo "<script>alert('Old password is incorrect!');</script>";
            }
        } else {

            $path = 'image/profile/' . $image;
            $imageType = pathinfo($path, PATHINFO_EXTENSION);

            if ($imageType != 'jpg' && $imageType != 'png' && $imageType != 'jpeg') {
                echo "<script>alert('Image type must be jpg, jpeg, or png!');</script>";
            } else {
                move_uploaded_file($_FILES['image']['tmp_name'], $path);

                $stmt = $pdo->prepare("UPDATE users SET name=:name, email=:email, profile_picture=:profile_picture WHERE id=" . $_SESSION['user_id']);
                $result = $stmt->execute(['name' => $name, 'email' => $email, 'profile_picture' => $image]);

                if ($result) {
                    echo "<script>alert('Account updated successfully.');window.location.href = 'index.php';</script>";
                }
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
    <title>Mini Social Media</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="max-h-max bg-stone-900">
    <div class="relative text-white">

        <?php include('nav.php'); ?>

        <div class="flex w-full">

            <!-- main content start -->
            <section class="w-3/5 ml-[350px] flex flex-col items-center">

                <!-- header -->
                <header class="text-center text-lg font-medium pt-5">Your Account</header>

                <!-- card -->
                <div class="w-1/3">

                    <div class="relative bg-stone-800 rounded-xl my-5">

                        <!-- back btn -->
                        <a href="my-profile.php">
                            <div class="absolute hover:bg-stone-500 px-3 py-2 rounded-tl-xl text-sm transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="m7.825 13l4.9 4.9q.3.3.288.7t-.313.7q-.3.275-.7.288t-.7-.288l-6.6-6.6q-.15-.15-.213-.325T4.426 12t.063-.375t.212-.325l6.6-6.6q.275-.275.688-.275t.712.275q.3.3.3.713t-.3.712L7.825 11H19q.425 0 .713.288T20 12t-.288.713T19 13z" />
                                </svg>
                            </div>
                        </a>
                        <!-- back btn -->

                        <form action="edit-profile.php" method="post" enctype="multipart/form-data" class="flex flex-col p-5">
                            <div class="flex flex-col">
                                <img src="image/profile/<?php echo $user['profile_picture']; ?>" alt="" class="w-32 h-32 rounded-full mx-auto">
                                <input type="file" name="image" id="fileInput" class="hidden">
                                <label for="fileInput" class="cursor-pointer  text-white rounded-lg p-2 mt-2 mx-auto text-center w-1/3">Edit Image</label>
                            </div>
                            <div class="flex flex-col mt-5">
                                <label for="name" class="text-sm">Name</label>
                                <input type="text" name="name" id="name" class="w-full bg-stone-700 rounded-lg p-2 mt-2" value="<?php echo $user['name']; ?>">
                            </div>
                            <div class="flex flex-col mt-5">
                                <label for="email" class="text-sm">Email</label>
                                <input type="email" name="email" id="email" class="w-full bg-stone-700 rounded-lg p-2 mt-2" value="<?php echo $user['email']; ?>">
                            </div>
                            <div class="flex flex-col mt-5 hidden dropdownPassword">
                                <label for="password" class="text-sm">Old Password</label>
                                <input type="password" name="old_password" id="old_password" class="w-full bg-stone-700 rounded-lg p-2 mt-2">
                            </div>
                            <div class="flex flex-col mt-5 hidden dropdownPassword">
                                <label for="password" class="text-sm">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="w-full bg-stone-700 rounded-lg p-2 mt-2">
                            </div>
                            <div class="text-sm text-center mt-5 cursor-pointer hover:text-violet-300" onclick="dropdown()">Forget Password</div>
                            <div class="flex flex-col mt-5">
                                <button type="submit" class="bg-violet-500 hover:bg-violet-600 text-white rounded-lg p-2 w-full">Update</button>
                            </div>
                        </form>
                    </div>

                </div>



            </section>
            <!-- main content end -->

        </div>
    </div>

    <script>
        function dropdown() {
            const dropDownBtns = document.querySelectorAll('.dropdownPassword');
            dropDownBtns.forEach((btn) => {
                btn.classList.toggle('hidden');
            });
        }
    </script>
</body>