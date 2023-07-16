<section class="h-screen">
  <div class="container h-full px-6 py-6">
        <nav class="lg:flex lg:items-center lg:justify-between">
            <div class="max-w-screen-xl flex flex-wrap mx-2 p-4 ">
                 <h2 class="text-2xl font-bold leading-7 text-violet-900 sm:truncate sm:text-3xl sm:tracking-tight">Add Users</h2>
            </div>     
        </nav>

        <div class="min-w-0 flex-1 px-4 py-4">
            <hr class="border-t-4 border-violet-500 opacity-100 dark:opacity-50 "></hr>
        </div>

        <form method="post" action="<?= base_url('/auth/saveUser'); ?>">
            <?= csrf_field(); ?>
            <input type="hidden" value="<?= isset($data['user_id']) ? $data['user_id'] : '' ?>" name="user_id">
            <div class="md:inline-flex  space-y-4 md:space-y-0  w-full p-4 text-gray-500 items-center">
                <h2 class="md:w-1/3 mx-auto max-w-sm text-black font-bold">Personal info</h2>
                <div class="md:w-2/3 mx-auto max-w-sm space-y-5">
                    <div>
                        <label class="text-sm text-black">Full name</label>
                            <div class="w-full inline-flex border">
                                 <div class="w-2/12 pt-2 bg-gray-100">
                                    <svg
                                     fill="none"
                                     class="w-6 text-black mx-auto"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                    >
                                    <path
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     stroke-width="2"
                                     d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                    </svg>
                                 </div>
                             <input
                                type="text"
                                name="nama"
                                id="nama"
                                class="w-10/12 focus:outline-none focus:text-black p-2"
                                value="<?= isset($data['nama']) ? $data['nama'] : '' ?>" 
                                placeholder="User Full Name" 
                                required="required"
                              />
                            </div>
                    </div>
                <div>
                <label class="text-sm text-black">NIM</label>
                    <div class="w-full inline-flex border">
                     <div class="pt-2 w-2/12 bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 text-black mx-auto">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                        </svg>
                     </div>
                        <input
                            type="text"
                            name="nim"
                            id="nim"
                            class="w-10/12 focus:outline-none focus:text-black p-2"
                            value="<?= isset($data['nim']) ? $data['nim'] : '' ?>" 
                            placeholder="User NIM (required for login)" 
                            required="required"
                        />
                    </div>
                </div>
                </div>
            </div>

        <div class="min-w-0 flex-1 px-4 py-4">
            <hr></hr>
        </div>

        <div class="md:inline-flex  space-y-4 md:space-y-0  w-full p-4 text-gray-500 items-center">
        <h2 class="md:w-1/3 mx-auto max-w-sm text-black font-bold">Authorization</h2>
            <div class="md:w-2/3 mx-auto max-w-sm space-y-5">
              <div>
                <label class="text-sm text-black">User Role</label>
                <div class="w-full inline-flex border">
                  <div class="w-2/12 pt-2 bg-gray-100">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 text-black mx-auto">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                  </svg>
                  </div>

                  <select class="w-10/12 focus:outline-none focus:text-black p-2"  name="role_id" id="role_id" required>
                  <option value="" hidden>---Choose Role Name--- </option>
                  <?php foreach ($roles as $key => $value): ?>
                        <option value="<?= $value->role_id?>"><?= $value->role_name?></option>
                    <?php endforeach?>
                </select>
                </div>
              </div>
            </div>
            </div>

            <div class="min-w-0 flex-1 px-4 py-4">
            <hr></hr>
            </div>

        <div class="md:inline-flex  space-y-4 md:space-y-0  w-full p-4 text-gray-500 items-center">
            <h2 class="md:w-1/3 mx-auto max-w-sm text-black font-bold">Authentication</h2>
            <div class="md:w-2/3 mx-auto max-w-sm space-y-5">
              <div>
                <label class="text-sm text-black">Password</label>
                <div class="w-full inline-flex border">
                  <div class="w-2/12 pt-2 bg-gray-100">
                  <svg
                    fill="none"
                    class="w-6 text-black mx-auto"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                    />
                  </svg>
                  </div>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-10/12 focus:outline-none focus:text-black p-2"
                    placeholder="Password" 
                    required="required"
                  />
                </div>
              </div>
              <div>
                <label class="text-sm text-black">Confirm Password</label>
                <div class="w-full inline-flex border">
                  <div class="pt-2 w-2/12 bg-gray-100">
                  <svg
                    fill="none"
                    class="w-6 text-black mx-auto"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                    />
                  </svg>
                  </div>
                  <input
                    type="password"
                    name="confirm_password"
                    id="confirm_password"
                    class="w-10/12 focus:outline-none focus:text-black p-2"
                    placeholder="Password" 
                    required="required"
                  />
                </div>
              </div>
            </div>
          </div>

        <div class="min-w-0 flex-1 px-4 py-4">
            <hr></hr>
        </div>

        <div class="pb-12 pt-4 items-center justify-between sm:text-center">
        <button class="text-white text-l bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:outline-none focus:ring-violet-300 font-bold rounded-lg px-4 py-2 text-center mr-3 md:mr-0 dark:bg-violet-600 dark:hover:bg-violet-700 dark:focus:ring-violet-800"
            type="submit"
            id="editUser">Edit User</button>
        </div>
        </form>
    </div>
</section>
   