<!doctype html>
<html class="dark">
<head>
<pre><link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif"></pre>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title?></title>
  
  <link href="/css/app.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>
</head>
<body>
  <!-- sidebar-->
  <!-- component -->
<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');">
      <div class="flex bg-blue-100 dark:bg-dark dark:text-light">
        <!-- Loading screen -->
        <div
          x-ref="loading"
          class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-violet-900"
        >
          Loading.....
        </div>
 
        <!-- Sidebar -->
        <div
          x-transition:enter="transform transition-transform duration-300"
          x-transition:enter-start="-translate-x-full"
          x-transition:enter-end="translate-x-0"
          x-transition:leave="transform transition-transform duration-300"
          x-transition:leave-start="translate-x-0"
          x-transition:leave-end="-translate-x-full"
          x-show="isSidebarOpen"
          class="fixed inset-y-0 z-10 flex w-80"
        >
          <!-- Curvy shape -->
          <svg
            class="absolute inset-0 w-full h-full text-white"
            style="filter: drop-shadow(10px 0 10px #00000030)"
            preserveAspectRatio="none"
            viewBox="0 0 309 800"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M268.487 0H0V800H247.32C207.957 725 207.975 492.294 268.487 367.647C329 243 314.906 53.4314 268.487 0Z"
            />
          </svg>
          <!-- Sidebar content -->
          <div class="z-10 flex flex-col flex-1">
            <div class="flex items-center justify-between flex-shrink-0 w-64 p-4">
              <!-- Logo -->
              <a href="#">
                <h1  class="w-16 h-auto text-xl text-violet-900 dark:text-white font-bold text-gray-900">SPK Magang</h1>
              </a>
              <!-- Close btn -->
              <button @click="isSidebarOpen = false" class="p-1 rounded-lg focus:outline-none focus:ring">
                <svg
                  class="w-6 h-6"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span class="sr-only">Close sidebar</span>
              </button>
            </div>
            <nav class="flex flex-col flex-1 w-64 p-4 mt-4">
              <a href="/home/index" class="flex items-center space-x-4">
                <svg
                  class="w-6 h-6"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  />
                </svg>
                <span>Home</span>
              </a>
              <?php if($session->id == 1){ ?>
              <a href="/auth/viewUser" class="flex items-center space-x-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                <span>Users</span>
                <?php }?>
              </a>
              <a href="#" class="flex items-center space-x-4 mt-4">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
              </svg>
                <span>Decision</span>
              </a>
              <a href="#" class="flex items-center space-x-4 mt-4">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
              </svg>
                <span>History</span>
              </a>
            </nav>
            <div class="flex-shrink-0 p-4">
              <a href="/auth/logout" class="flex items-center space-x-4">
                <svg
                  aria-hidden="true"
                  class="w-6 h-6"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                  />
                </svg>
                <span>Logout</span>
              </a>
            </div>
          </div>
        </div> 
      </div> 

  <!-- navbar-->
  <nav class="bg-gray-100">
    <div class="relative flex h-16 visible">
      <div class="absolute inset-y-0 left-5 flex items-center visible">
        <button @click="isSidebarOpen = true" class="p-2 text-white bg-violet-500 rounded-lg">
            <svg
              class="w-6 h-6"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="sr-only">Open menu</span>
          </button>
          <p  class="p-2 text-xl text-violet-900 dark:text-violet-400 font-bold ml-3">SPK Magang</p>

        <div class="p-2 text-violet-900 dark:text-white top-4 right-16">
          <a href="/home/index" class="text-lg no-underline text-violet-900 hover:text-violet-500">Home</a>
          <?php if($session->id == 1){ ?>
            <a href="/auth/viewUser" class="text-lg no-underline visible text-violet-900 hover:text-violet-500 ml-3">Users</a>
          <?php } ?>
          <a href="/three" class="text-lg no-underline text-violet-900hover:text-violet-500 ml-3">Decision</a>
          <a href="/three" class="text-lg no-underline text-violet-900 hover:text-violet-500 ml-3">History</a>
        </div>

      </div>



      <div class="absolute inset-y-0 right-10 flex items-center visible">
        <!-- Profile dropdown -->
          <div>
            <button type="button" class="flex rounded-full text-lg text-violet-900 font-bold hover:text-violet-700 focus:text-violet-500" aria-expanded="false" aria-haspopup="true" data-dropdown-toggle="dropdown">
              <span class="sr-only">Open user menu</span>
              Hi, <?php echo $session->name ?>!</button>
          </div>
          <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"  id="dropdown">
            <!-- Active: "bg-gray-100", Not Active: "" -->
            <a href="/auth/logout" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
          </div>
        </div>
      </div>

    </nav>
      
<main class="flex flex-col flex-1 pt-2 pl-10 pr-4 bg-white">
   