<?php
session_start();
require "./config/config.php";

if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
    header("Location: login.php");
};

$stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $pdo->prepare("SELECT * FROM users WHERE id=" . $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);


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
        <!-- navbar start -->
        <nav class="fixed w-60 inset-y-0 left-0 pl-5">
            <div class="flex flex-col h-full justify-between py-5">
                <div class="pl-3 text-lg font-medium"><a href="">Mini Social Media</a></div>
                <div>
                    <ul>
                        <li class="py-3 pl-3 hover:bg-stone-800 rounded-lg transition duration-150">
                            <a href="" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M4 19v-7.375L3 12.4q-.35.25-.75.2t-.65-.4t-.187-.75t.387-.65l8.975-6.875q.275-.2.588-.3t.637-.1t.638.1t.587.3l9 6.875q.325.25.375.65t-.2.75q-.25.325-.65.375t-.725-.2L20 11.625V19q0 .825-.587 1.413T18 21H6q-.825 0-1.412-.587T4 19m2 0h12v-8.9l-6-4.575L6 10.1zm2-4q.425 0 .713-.288T9 14t-.288-.712T8 13t-.712.288T7 14t.288.713T8 15m4 0q.425 0 .713-.288T13 14t-.288-.712T12 13t-.712.288T11 14t.288.713T12 15m4 0q.425 0 .713-.288T17 14t-.288-.712T16 13t-.712.288T15 14t.288.713T16 15M6 19h12z" />
                                </svg>
                                <p class="text-lg font-medium ml-3">Home</p>
                            </a>
                        </li>

                        <li class="py-3 pl-3 hover:bg-stone-800 rounded-lg transition duration-150">
                            <a href="" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                                </svg>
                                <p class="text-lg font-medium ml-3">Search</p>
                            </a>
                        </li>

                        <li class="py-3 pl-3 hover:bg-stone-800 rounded-lg transition duration-150">
                            <a href="" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 21q-.425 0-.712-.288T11 20v-7H4q-.425 0-.712-.288T3 12t.288-.712T4 11h7V4q0-.425.288-.712T12 3t.713.288T13 4v7h7q.425 0 .713.288T21 12t-.288.713T20 13h-7v7q0 .425-.288.713T12 21" />
                                </svg>
                                <p class="text-lg font-medium ml-3">Create</p>
                            </a>
                        </li>

                        <li class="py-3 pl-3 hover:bg-stone-800 rounded-lg transition duration-150">
                            <a href="" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M5.5 8a2.5 2.5 0 1 1 5 0a2.5 2.5 0 0 1-5 0M8 4a4 4 0 1 0 0 8a4 4 0 0 0 0-8m7.5 5a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0M17 6a3 3 0 1 0 0 6a3 3 0 0 0 0-6m-2.752 13.038c.703.285 1.604.462 2.753.462c2.282 0 3.586-.697 4.297-1.558c.345-.418.52-.84.61-1.163a2.7 2.7 0 0 0 .093-.573v-.027A2.18 2.18 0 0 0 19.822 14H14.18q-.042 0-.082.002c.394.41.68.925.816 1.498h4.908c.372 0 .674.299.679.669l-.003.032q-.006.058-.037.18a1.6 1.6 0 0 1-.32.605c-.35.426-1.172 1.014-3.14 1.014c-.98 0-1.676-.146-2.17-.345c-.108.4-.286.883-.583 1.383M4.25 14A2.25 2.25 0 0 0 2 16.25v.278a2 2 0 0 0 .014.208a4.5 4.5 0 0 0 .778 2.07C3.61 19.974 5.172 21 8 21s4.39-1.025 5.208-2.195a4.5 4.5 0 0 0 .778-2.07a3 3 0 0 0 .014-.207v-.278A2.25 2.25 0 0 0 11.75 14zm-.75 2.507v-.257a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 .75.75v.257l-.007.08a3 3 0 0 1-.514 1.358C11.486 18.65 10.422 19.5 8 19.5s-3.486-.85-3.98-1.555a3 3 0 0 1-.513-1.358z" />
                                </svg>
                                <p class="text-lg font-medium ml-3">Followers</p>
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <a href="#userdetail" class="pl-3 flex items-center">
                        <img src="image/profile/<?php echo $user['profile_picture'] ?>" alt="" class="w-9 h-9 rounded-full">
                        <p class="text-lg font-medium ml-3"><?php echo $user['name'] ?></p>
                    </a>
                </div>
            </div>
        </nav>
        <!-- navbar end -->

        <div class="flex w-full">

            <!-- main content start -->
            <section class="w-3/4 ml-80 flex flex-col items-center">

                <!-- header -->
                <header class="text-center text-lg font-medium pt-3">For You</header>

                <!-- posts -->
                <div class="w-1/2">

                    <!-- post -->
                    <?php
                    if ($posts) {
                        foreach ($posts as $post) {
                            $user_stmt = $pdo->prepare("SELECT * FROM users WHERE id=" . $post['user_id']);
                            $user_stmt->execute();
                            $user = $user_stmt->fetch(PDO::FETCH_ASSOC);
                            $like_stmt = $pdo->prepare("SELECT COUNT(*) as totalLikes FROM likes WHERE post_id=" . $post['id']);
                            $like_stmt->execute();
                            $likes = $like_stmt->fetch(PDO::FETCH_ASSOC);

                            $postId = $post['id'];
                    ?>
                            <div class="bg-stone-800 rounded-xl my-5">
                                <!-- author -->
                                <div class="flex justify-between">
                                    <div class="author px-5 py-3 flex items-center">
                                        <img src="image/profile/<?php echo $user['profile_picture'] ?>" alt="" class="max-w-10 rounded-full">
                                        <div>
                                            <p class="font-medium text-lg ml-3"><?php echo $user['name'] ?></p>
                                            <p class="text-xs font-light ml-3"><?php echo $post['created_at'] ?></p>
                                        </div>
                                    </div>
                                    <!-- dropdown start -->
                                    <div class="relative px-5 py-3 select-none">
                                        <div class="cursor-pointer hover:bg-stone-600 rounded-lg transition ease-in-out duration-300 px-1" id="dropdown-btn-<?php echo $postId ?>" onclick="dropdown('dropdown<?php echo  $postId ?>')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16">
                                                <path fill="currentColor" d="M3 9.5a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3" />
                                            </svg>
                                        </div>
                                        <div class="absolute text-right -left-24 bg-stone-700 flex rounded-lg opacity-0 mt-2 transition-opacity duration-300 ease-in-out drop-down" id="dropdown<?php echo $postId ?>">
                                            <a href="edit.php?id=<?php echo $postId ?>">
                                                <div class="px-5 py-2 hover:bg-stone-600 rounded-lg transition ease-in-out duration-300">Edit</div>
                                            </a>
                                            <a href="delete.php?id=<?php echo $postId ?>">
                                                <div class="px-5 py-2 hover:bg-stone-600 rounded-lg transition ease-in-out duration-300">Delete
                                                </div>
                                            </a>
                                        </div>
                                        <script>
                                            function dropdown(id) {
                                                let dropdowns = document.querySelectorAll('.drop-down');

                                                dropdowns.forEach(dropdown => {
                                                    if (dropdown.id === id) {
                                                        if (dropdown.classList.contains('opacity-0')) {
                                                            dropdown.classList.remove('opacity-0');
                                                            dropdown.classList.add('opacity-100');
                                                            dropdown.classList.remove('hidden');
                                                        } else {
                                                            dropdown.classList.remove('opacity-100');
                                                            dropdown.classList.add('opacity-0');
                                                            dropdown.classList.add('hidden');
                                                        }
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                    <!-- dropdown end -->
                                </div>
                                <!-- caption -->
                                <p class="px-5 pb-3"><?php echo $post['status'] ?></p>
                                <!-- image -->
                                <a href="">
                                    <img src="./image/<?php echo $post['image'] ?>" alt="" class="max-w-full w-full max-h-[500px] object-cover">
                                </a>
                                <!-- like -->
                                <div class="px-5 py-3 flex gap-5">
                                    <button class="">
                                        <svg xmlns="http: //www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M12 20.325q-.35 0-.712-.125t-.638-.4l-1.725-1.575q-2.65-2.425-4.788-4.812T2 8.15Q2 5.8 3.575 4.225T7.5 2.65q1.325 0 2.5.562t2 1.538q.825-.975 2-1.537t2.5-.563q2.35 0 3.925 1.575T22 8.15q0 2.875-2.125 5.275T15.05 18.25l-1.7 1.55q-.275.275-.637.4t-.713.125M11.05 6.75q-.725-1.025-1.55-1.563t-2-.537q-1.5 0-2.5 1t-1 2.5q0 1.3.925 2.763t2.213 2.837t2.65 2.575T12 18.3q.85-.775 2.213-1.975t2.65-2.575t2.212-2.837T20 8.15q0-1.5-1-2.5t-2.5-1q-1.175 0-2 .538T12.95 6.75q-.175.25-.425.375T12 7.25t-.525-.125t-.425-.375m.95 4.725" />
                                        </svg>
                                    </button>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M12 3C6.5 3 2 6.58 2 11a7.22 7.22 0 0 0 2.75 5.5c0 .6-.42 2.17-2.75 4.5c2.37-.11 4.64-1 6.47-2.5c1.14.33 2.34.5 3.53.5c5.5 0 10-3.58 10-8s-4.5-8-10-8m0 14c-4.42 0-8-2.69-8-6s3.58-6 8-6s8 2.69 8 6s-3.58 6-8 6m5-5v-2h-2v2zm-4 0v-2h-2v2zm-4 0v-2H7v2z" />
                                        </svg>
                                    </a>

                                </div>

                            </div>
                    <?php
                        }
                    }
                    ?>
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