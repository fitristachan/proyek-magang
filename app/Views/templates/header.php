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
              <a href="#" class="flex items-center space-x-2">
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
            </nav>
            <div class="flex-shrink-0 p-4">
              <button class="flex items-center space-x-2">
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
              </button>
            </div>
          </div>
        </div> 
      </div> 

  <!-- navbar-->
  <nav class="bg-gray-100">
    <div class="relative flex h-16">
      <div class="absolute inset-y-0 left-5 flex items-center sm:hidden">
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
          <a href="/home/index" class="text-lg no-underline text-grey-darkest hover:text-blue-dark ml-3">Home</a>
          <?php if ($session->role_id = "1") : ?>
            <a href="/auth/viewUser" class="text-lg no-underline text-grey-darkest hover:text-blue-dark ml-3">Users</a>
          <?php endif; ?>
          <a href="/three" class="text-lg no-underline text-grey-darkest hover:text-blue-dark ml-3">Decision</a>
          <a href="/three" class="text-lg no-underline text-grey-darkest hover:text-blue-dark ml-3">History</a>
        </div>
      </div>

      <div class="absolute inset-y-0 right-10 flex items-center sm:hidden">
        <!-- Profile dropdown -->
        <div class="relative ml-3">
          <div>
            <button type="button" class="flex rounded-full bg-gray-800 text-lg text-violet-900 font-bold focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-expanded="false" aria-haspopup="true" data-dropdown-toggle="dropdown">
              <span class="sr-only">Open user menu</span>
              Hi, <?php $session->nama; ?>!</button>
          </div>
          <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"  id="dropdown">
            <!-- Active: "bg-gray-100", Not Active: "" -->
            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
          </div>

        </div>
      </div>
      </div>
          </nav>
      
<main class="flex flex-col flex-1 pt-2 pl-10 pr-4 bg-white">
   