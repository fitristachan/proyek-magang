<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin: auto;
            padding: 2rem;
            max-width: 800px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            border: 1px solid #E5E7EB;
        }

        .table th {
            background-color: #4F46E5;
            color: #FFFFFF;
        }

        .table tr:nth-child(even) {
            background-color: #EDF2F7;
        }

        .table tr:hover {
            background-color: #E2E8F0;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center text-2xl font-bold leading-9 text-gray-900 mb-8">Rekap Perhitungan Magang</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Magang</th>
                    <th>Bayaran per Bulan</th>
                    <th>Waktu Kerja per Hari</th>
                    <th>Jarak Lokasi</th>
                    <th>Ongkos Transportasi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $d) : ?>
                    <tr>
                        <td><?= $d->name; ?></td>
                        <td>Rp<?= $d->salary; ?></td>
                        <td><?= $d->work_hour; ?> Jam</td>
                        <td><?= $d->distance; ?> Km</td>
                        <td>Rp<?= $d->transport_fee; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <table class="table mt-8">
            <thead>
                <tr>
                    <th>Kriteria</th>
                    <th>Jenis</th>
                    <th>Bobot</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Bayaran</td>
                    <td>Benefit</td>
                    <td>32%</td>
                </tr>
                <tr>
                    <td>Waktu Kerja</td>
                    <td>Cost</td>
                    <td>25%</td>
                </tr>
                <tr>
                    <td>Jarak</td>
                    <td>Benefit</td>
                    <td>13%</td>
                </tr>
                <tr>
                    <td>Biaya Transport</td>
                    <td>Cost</td>
                    <td>30%</td>
                </tr>
            </tbody>
        </table>

        <h1 class="text-center text-2xl font-bold leading-9 text-gray-900 mb-8 mt-8">Hasil Perhitungan</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Magang</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($data); $i++) : ?>
                    <tr>
                        <td><?= $data[$i]->name ?>
                            <?php if ($hasil[$i] == max($hasil)) : ?>
                                &#9733;
                            <?php endif; ?>
                        </td>

                        <td><?= $hasil[$i] ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</body>

</html>