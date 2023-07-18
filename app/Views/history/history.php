    <div class="container mx-auto p-8">
        <h1 class="text-center text-2xl font-bold leading-9 text-gray-900 mb-8">History</h1>
    </div>

    <div class="container mx-auto p-8">
        <table class="table-auto w-full bg-white shadow rounded-lg">
            <thead class="border border-gray-300">
                <tr>
                    <th class="px-4 py-2 bg-indigo-600 text-white">Calculation ID</th>
                    <th class="px-4 py-2 bg-indigo-600 text-white">Internships</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($calculations as $calculation) : ?>
                    <tr class="border border-gray-300">
                        <td class="px-4 py-2 text-center"><?= $calculation->calculation_id ?></td>
                        <td class="px-4 py-2">
                            <?php if (isset($calculation->internships)) : ?>
                                <table class="table-auto w-full bg-white shadow rounded-lg">
                                    <thead class="border border-gray-300">
                                        <tr>
                                            <th class="px-4 py-2 bg-indigo-600 text-white">Nama Magang</th>
                                            <th class="px-4 py-2 bg-indigo-600 text-white">Bayaran per Bulan</th>
                                            <th class="px-4 py-2 bg-indigo-600 text-white">Waktu Kerja per Hari</th>
                                            <th class="px-4 py-2 bg-indigo-600 text-white">Jarak Lokasi</th>
                                            <th class="px-4 py-2 bg-indigo-600 text-white">Ongkos Transportasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($calculation->internships as $internship) : ?>
                                            <tr class="border border-gray-300">
                                                <td class="px-4 py-2"><?= $internship->name ?></td>
                                                <td class="px-4 py-2">Rp<?= $internship->salary ?></td>
                                                <td class="px-4 py-2"><?= $internship->work_hour ?> Jam</td>
                                                <td class="px-4 py-2"><?= $internship->distance ?> Km</td>
                                                <td class="px-4 py-2">Rp<?= $internship->transport_fee ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>