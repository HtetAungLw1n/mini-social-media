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

                        <!-- <li class="py-3 flex hover:bg-stone-800 rounded-lg transition duration-150">
                            <a href="" class="flex items-center hover:text-zinc-300 transition duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M5 19q-.425 0-.712-.288T4 18t.288-.712T5 17h1v-7q0-2.075 1.25-3.687T10.5 4.2v-.7q0-.625.438-1.062T12 2t1.063.438T13.5 3.5v.7q2 .5 3.25 2.113T18 10v7h1q.425 0 .713.288T20 18t-.288.713T19 19zm7 3q-.825 0-1.412-.587T10 20h4q0 .825-.587 1.413T12 22m-4-5h8v-7q0-1.65-1.175-2.825T12 6T9.175 7.175T8 10z" />
                                </svg>
                                <p class="text-lg font-medium ml-3">Notification</p>
                            </a>
                        </li> -->

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
                    <a href="" class="pl-3 flex items-center">
                        <img src="image/defaultprofile.jpg" alt="" class="w-9 h-9 rounded-full">
                        <p class="text-lg font-medium ml-3">Username</p>
                    </a>

                </div>
            </div>
        </nav>
        <!-- navbar end -->

    </div>
</body>

</html>