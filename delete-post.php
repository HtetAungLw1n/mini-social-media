<?php
session_start();
require "./config/config.php";

if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
    header("Location: login.php");
};

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id=" . $_GET['id']);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SESSION['user_id'] != $post['user_id']) {
    echo "<script>alert('Sorry,This is not Your Post');window.location.href='index.php';</script>";
} else {

    // this code also delete the image from the folder when the post is deleted.
    if (!empty($post['image'])) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE image = :image AND id != :id");
        $stmt->execute([':image' => $post['image'], ':id' => $_GET['id']]);
        $imageCount = $stmt->fetchColumn();

        if ($imageCount == 0) {
            $imagePath = 'image/' . $post['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }

    $stmt = $pdo->prepare("DELETE FROM posts WHERE id=" . $_GET['id']);
    $result = $stmt->execute();


    header("Location: index.php");
}
