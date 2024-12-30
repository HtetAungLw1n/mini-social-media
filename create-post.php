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

    $status = $_POST['title'];

    // image pr tyin
    if ($_FILES) {
        $file = 'image/' . $_FILES['image']['name'];
        $image = $_FILES['image']['name'];

        move_uploaded_file($_FILES['image']['tmp_name'], $file);

        $stmt = $pdo->prepare("INSERT INTO posts(status, image, user_id) VALUES(:status, :image, :user_id)");
        $result = $stmt->execute(
            array(
                ':status' => $status,
                ':image' => $image,
                ':user_id' => $user['id']
            )
        );
    } else {
        // image ma pr yin
        $stmt = $pdo->prepare("INSERT INTO posts(status, user_id) VALUES(:status, :user_id)");
        $result = $stmt->execute(
            array(
                ':status' => $status,
                ':user_id' => $user['id']
            )
        );
    }


    if ($result) {
        header('Location: index.php');
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

        <?php include "nav.php" ?>

        <div class="flex w-full">

            <!-- main content start -->
            <section class="w-3/4 ml-80 flex flex-col items-center">

                <div class="w-1/2 pt-14">
                    <form action="create-post.php" method="post" enctype="multipart/form-data">
                        <div class="bg-stone-800 rounded-xl p-5">
                            <!-- porfile and name section -->
                            <div class="flex justify-between">
                                <div class="author px-5 py-3 flex items-center">
                                    <img src="image/profile/<?php echo $user['profile_picture'] ?>" alt="" class="max-w-10 rounded-full">
                                    <div>
                                        <p class="font-medium text-lg ml-3"><?php echo $user['name'] ?></p>
                                    </div>
                                </div>

                            </div>
                            <!-- porfile and name section -->
                            <!-- form section start -->
                            <div class="flex flex-col gap-5  px-5 py-3">
                                <input type="text" name="title" class="outline-none w-full px-3 py-2 rounded bg-stone-800 border-b-4" placeholder="Title">
                                <input type="file" name="image" class="outline-none w-full py-2 bg-stone-800">
                                <div class="w-full flex justify-end">
                                    <div class="w-max px-5 py-2 text-white font-medium rounded hover:text-stone-200 transition duration-150">
                                        <a href="index.php">
                                            Back
                                        </a>
                                    </div>
                                    <button type="submit" class="bg-stone-50 w-max px-5 py-2 font-medium rounded hover:bg-stone-200 transition duration-150 text-stone-800">
                                        Post
                                    </button>
                                </div>
                            </div>
                            <!-- form section end -->
                        </div>

                </div>
                </form>


            </section>
            <!-- main content end -->

            <!-- second section start -->
            <section class="w-1/4 pt-14 mr-28">
                <div class="flex items-center h-max bg-stone-800 rounded-full px-3 py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                    </svg>
                    <input type="text" class="w-2/3 h-10 bg-stone-800 rounded-lg px-3 outline-none" placeholder="Search">
                </div>

                <hr class="border-stone-500 mt-5">

                <div class="h-96 bg-stone-800 mt-5 rounded-xl px-5 py-3">
                    <div class="text-lg font-medium">Following</div>
                    <div class="flex flex-col overflow-y-auto h-5/6 mt-3">

                        <!-- user start -->
                        <div class="py-3">
                            <a href="" class="flex items-center">
                                <img src="image/defaultprofile.jpg" alt="" class="w-9 h-9 rounded-full">
                                <p class="text-lg font-medium ml-3">Username</p>
                            </a>
                        </div>
                        <div class="py-3">
                            <a href="" class="flex items-center">
                                <img src="image/defaultprofile.jpg" alt="" class="w-9 h-9 rounded-full">
                                <p class="text-lg font-medium ml-3">Username</p>
                            </a>
                        </div>
                        <div class="py-3">
                            <a href="" class="flex items-center">
                                <img src="image/defaultprofile.jpg" alt="" class="w-9 h-9 rounded-full">
                                <p class="text-lg font-medium ml-3">Username</p>
                            </a>
                        </div>
                        <div class="py-3">
                            <a href="" class="flex items-center">
                                <img src="image/defaultprofile.jpg" alt="" class="w-9 h-9 rounded-full">
                                <p class="text-lg font-medium ml-3">Username</p>
                            </a>
                        </div>
                        <div class="py-3">
                            <a href="" class="flex items-center">
                                <img src="image/defaultprofile.jpg" alt="" class="w-9 h-9 rounded-full">
                                <p class="text-lg font-medium ml-3">Username</p>
                            </a>
                        </div>
                        <div class="py-3">
                            <a href="" class="flex items-center">
                                <img src="image/defaultprofile.jpg" alt="" class="w-9 h-9 rounded-full">
                                <p class="text-lg font-medium ml-3">Username</p>
                            </a>
                        </div>
                        <div class="py-3">
                            <a href="" class="flex items-center">
                                <img src="image/defaultprofile.jpg" alt="" class="w-9 h-9 rounded-full">
                                <p class="text-lg font-medium ml-3">Username</p>
                            </a>
                        </div>
                        <!-- user end -->

                    </div>

                </div>
            </section>
            <!-- second section end -->

        </div>
    </div>
</body>

</html>