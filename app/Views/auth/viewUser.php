<section class="h-screen">
  <div class="container h-full px-6 py-6">
        <nav class="lg:flex lg:items-center lg:justify-between">
            <div class="max-w-screen-xl flex flex-wrap mx-2 p-4 ">
                 <h2 class="text-2xl font-bold leading-7 text-violet-900 sm:truncate sm:text-3xl sm:tracking-tight">View Users</h2>
            </div>     
            <div class="max-w-screen-xl flex flex-wrap ml-12 p-4 md:order-2">
                <a href="<?= base_url('auth/addUser/') ?>" class="text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-violet-600 dark:hover:bg-violet-700 dark:focus:ring-violet-800">Add User</a>
            </div>
        </nav>
        <div class="min-w-0 flex-1 px-4 py-4">
            <hr class="border-t-4 border-violet-500 opacity-100 dark:opacity-50 "></hr>
        </div>

   
<div class="relative overflow-x-auto shadow-md sm:rounded-lg px-6 py-4">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    User ID
                </th>
                <th scope="col" class="px-6 py-3">
                    NIM
                </th>
                <th scope="col" class="px-6 py-3">
                    Role Name
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                    <span class="sr-only">Delete</span>
                </th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($list) > 0): ?>
        <?php $i = 1; ?>
        <?php foreach($list as $row): ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?= $row->user_id ?>
                </th>
                <td class="px-6 py-4">
                    <?= $row->nim ?>
                </td>
                <td class="px-6 py-4">
                    <?= $row->role_name ?>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="<?= base_url('auth/editUser/'.$row->user_id) ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <a href="<?= base_url('auth/deleteUser/'.$row->user_id) ?>" onclick="if(confirm('Are you sure to delete <?= $row->nim ?>?') === false) event.preventDefault()" title="Delete User" class="ml-4 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</div>
</section>