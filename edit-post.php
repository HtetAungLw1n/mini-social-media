<?php
session_start();
require "./config/config.php";

if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
    header("Location: login.php");
};

$stmt = $pdo->prepare("SELECT * FROM users WHERE id=" . $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id=" . $_GET['id']);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user['id'] != $post['user_id']) {
    echo "<script>alert('Sorry,This is not Your Post');window.location.href='index.php';</script>";
};

if (!empty($_POST)) {
    $status = $_POST['status'];

    if ($_FILES['image']['name'] != null) {
        $file = 'image/' . ($_FILES['image']['name']);
        $imageType = pathinfo($file, PATHINFO_EXTENSION);

        if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg') {
            echo "<script>alert('Image must be png, jpg or jpeg');</script>";
        } else {
            $image = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $file);
            $stmt = $pdo->prepare("UPDATE posts SET status='$status', image='$image' WHERE id=" . $_GET['id']);
            $result = $stmt->execute();

            if ($result) {
                echo "<script>alert('Successfully Updated');window.location.href='index.php';</script>";
            }
        }
    } else {
        $stmt = $pdo->prepare("UPDATE posts SET status='$status' WHERE id=" . $_GET['id']);
        $result = $stmt->execute();

        if ($result) {
            echo "<script>alert('Successfully Updated');window.location.href='index.php';</script>";
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

                    <div class="bg-stone-800 rounded-xl my-5">

                        <form action="edit-post.php?id=<?php echo $post['id'] ?>" method="post" enctype="multipart/form-data" class="flex flex-col p-5">
                            <div class="flex flex-col">
                                <label for="status" class="text-lg font-bold">Status</label>
                                <input type="text" name="status" id="status" class="w-full bg-stone-700 rounded-lg p-2 mt-2" value="<?php echo $post['status']; ?>">
                            </div>

                            <?php
                            if ($post['image'] !== "") {
                            ?>
                                <div class="flex flex-col mt-5 ">
                                    <img src="image/<?php echo $post['image']; ?>" alt="" class="max-w-full w-full max-h-[500px] object-cover">
                                    <input type="file" name="image" id="fileInput" class="hidden">
                                    <label for="fileInput" class="cursor-pointer text-white rounded-lg mt-2 text-lg font-bold">Change Image</label>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="w-full flex mt-10">

                                <button type="submit" class="bg-stone-50 w-max px-5 pll-0 py-2 font-medium rounded hover:bg-stone-200 transition duration-150 text-stone-800">
                                    Edit
                                </button>
                                <div class="w-max px-5 py-2 text-white font-medium rounded hover:text-stone-200 transition duration-150">
                                    <a href="index.php">
                                        Cancel
                                    </a>
                                </div>
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