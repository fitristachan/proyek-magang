<!doctype html>
<html class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/css/app.css" rel="stylesheet">

  <title>Login</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
<section class="h-screen">
  <div class="container h-full px-6 py-24">
    <div
      class="g-6 flex h-full flex-wrap items-center justify-center">
      <!-- Left column container with background-->
      <div class="ml-30 mb-12 md:mb-0 md:w-8/12 lg:w-6/12">
        <img
          src="/assets/5190703.png"
          class="w-50"
          alt="intern image" />
      </div>

      <!-- Right column container with form -->
      <div class="md:w-8/12 lg:ml-6 lg:w-5/12">
      <h1 class="mb-12 text-center text-3xl text-violet-900 dark:text-white font-bold leading-9 tracking-tight text-gray-900">
        SPK Magang</h1>

        <form method="post" action="<?= base_url('/auth/login'); ?>">
                <?= csrf_field(); ?>
          <!-- nim input -->
          <div class="relative mb-12" data-te-input-wrapper-init>
            <input
              type="text"
              class="peer block min-h-[auto] w-full rounded border bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-violet-900 transition-all duration-200 ease-linear"
              id="nim"
              name="nim"
              required="required"
              placeholder="NIM" />
            <label
              for="nim"
              class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] invisible transition-all duration-200 ease-out peer-focus:visible peer-focus:-translate-x-3 peer-focus:-translate-y-[2rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
              >NIM
            </label>
          </div>

          <!-- Password input -->
          <div class="relative mb-12" data-te-input-wrapper-init>
            <input
              type="password"
              class="peer block min-h-[auto] w-full rounded border bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-violet-900 transition-all duration-200 ease-linear"
              id="password"
              name="password"
              required="required"
              placeholder="Password" />
            <label
              for="password"
              class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] invisible transition-all duration-200 ease-out peer-focus:visible peer-focus:-translate-x-3 peer-focus:-translate-y-[2rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[2.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
              >Password
            </label>
          </div>

          <!-- Submit button -->
          <button
            type="submit"
            id="login"
            class="inline-block w-full rounded bg-violet-900 px-7 pb-2.5 pt-3 mb-12 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-violet-500 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-violet-500 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-violet-500 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
            data-te-ripple-init
            data-te-ripple-color="light">
            Login
          </button>
          </div>
        </form>
      </div>
      <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div x-data="{ nofifiction: true }" class="fixed bottom-2 right-2">
  <div x-show="nofifiction" x-transition
    class="flex items-center justify-between max-w-xs p-4 bg-white border rounded-md shadow-sm">
    <div class="flex items-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-600" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd"
        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
        clip-rule="evenodd" />
    </svg>
      <p class="ml-3 text-sm font-bold text-red-600"><?php echo session()->getFlashdata('error'); ?></p>
    </div>
    <span @click="nofifiction=false;" class="inline-flex items-center cursor-pointer ml-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24"
      stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </span>
  </div>
</div>
    <?php endif; ?>
    </div>
  </div>
</section>
</body>
</html>