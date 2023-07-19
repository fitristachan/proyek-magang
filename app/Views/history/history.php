    <div class="container mx-auto p-8">
        <h1 class="text-center text-2xl font-bold leading-9 text-gray-900 mb-8">History</h1>
    </div>

    <div class="container mx-auto p-8">
        <table class="table-auto w-full bg-white shadow rounded-lg">
            <thead class="border border-gray-300">
                <tr>
                    <th class="px-4 py-2 bg-indigo-600 text-white">Calculation ID</th>
                    <th class="px-4 py-2 bg-indigo-600 text-white">Time Created</th>
                    <th class="px-4 py-2 bg-indigo-600 text-white">Internships</th>
                    <th class="px-4 py-2 bg-indigo-600 text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($calculations as $calculation) : ?>
                    <tr class="border border-gray-300">
                        <td class="px-4 py-2 text-center"><?= $calculation->calculation_id ?></td>
                        <td class="px-4 py-2 text-center"><?= $calculation->created_at ?></td>
                        <td class="px-4 py-2">
                            <?php if (isset($calculation->internships)) : ?>
                                <ul class="list-disc">
                                <?php foreach ($calculation->internships as $internship) : ?>
                                    <li class="px-4 py-2"><?= $internship->name ?></li>
                                <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="/spk/result/<?=$calculation->calculation_id?>" class="bg-violet-600 hover:bg-violet-500 text-white font-bold py-2 px-4 rounded">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>