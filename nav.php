  <!-- navbar start -->
  <nav class="fixed w-60 inset-y-0 left-0 pl-5">
      <div class="flex flex-col h-full justify-between py-7">
          <div class="pl-3 text-xl font-medium"><a href="">Mini Social Media</a></div>
          <div>
              <ul>
                  <li class="py-3 pl-3 hover:bg-stone-800 rounded-lg transition duration-150">
                      <a href="index.php" class="flex items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                              <path fill="currentColor" d="M4 19v-7.375L3 12.4q-.35.25-.75.2t-.65-.4t-.187-.75t.387-.65l8.975-6.875q.275-.2.588-.3t.637-.1t.638.1t.587.3l9 6.875q.325.25.375.65t-.2.75q-.25.325-.65.375t-.725-.2L20 11.625V19q0 .825-.587 1.413T18 21H6q-.825 0-1.412-.587T4 19m2 0h12v-8.9l-6-4.575L6 10.1zm2-4q.425 0 .713-.288T9 14t-.288-.712T8 13t-.712.288T7 14t.288.713T8 15m4 0q.425 0 .713-.288T13 14t-.288-.712T12 13t-.712.288T11 14t.288.713T12 15m4 0q.425 0 .713-.288T17 14t-.288-.712T16 13t-.712.288T15 14t.288.713T16 15M6 19h12z" />
                          </svg>
                          <p class="text-lg font-medium ml-3">Home</p>
                      </a>
                  </li>

                  <li class="py-3 pl-3 hover:bg-stone-800 rounded-lg transition duration-150">
                      <a href="search.php" class="flex items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                              <path fill="currentColor" d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                          </svg>
                          <p class="text-lg font-medium ml-3">Search</p>
                      </a>
                  </li>

                  <li class="py-3 pl-3 hover:bg-stone-800 rounded-lg transition duration-150">
                      <a href="create-post.php" class="flex items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                              <path fill="currentColor" d="M12 21q-.425 0-.712-.288T11 20v-7H4q-.425 0-.712-.288T3 12t.288-.712T4 11h7V4q0-.425.288-.712T12 3t.713.288T13 4v7h7q.425 0 .713.288T21 12t-.288.713T20 13h-7v7q0 .425-.288.713T12 21" />
                          </svg>
                          <p class="text-lg font-medium ml-3">Create</p>
                      </a>
                  </li>

              </ul>
          </div>

          <div>
              <a href="my-profile.php" class="pl-3 flex items-center">
                  <img src="image/profile/<?php echo $user['profile_picture'] ?>" alt="" class="w-10 h-10 rounded-full object-cover">
                  <p class="text-lg font-medium ml-3"><?php echo $user['name'] ?></p>
              </a>
          </div>
      </div>
  </nav>
  <!-- navbar end -->