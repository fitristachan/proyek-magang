<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
  <div class="container mx-auto p-8">
    <h1 class="text-center text-2xl font-bold leading-9 text-gray-900 mb-8">Rekap Perhitungan Magang</h1>
    <a href="<?= $pdfUrl ?>" target="_blank" class="bg-violet-600 hover:bg-violet-500 text-white font-bold py-2 px-4 rounded">
      Generate PDF
    </a>
  </div>

  <div class="overflow-x-auto">
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
        <?php foreach ($data as $d) : ?>
          <tr class="border border-gray-300">
            <td class="px-4 py-2"><?= $d->name; ?></td>
            <td class="px-4 py-2">Rp<?= $d->salary; ?></td>
            <td class="px-4 py-2"><?= $d->work_hour; ?> Jam</td>
            <td class="px-4 py-2"><?= $d->distance; ?> Km</td>
            <td class="px-4 py-2">Rp<?= $d->transport_fee; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="overflow-x-auto mt-8">
    <table class="table-auto w-full bg-white shadow rounded-lg">
      <thead>
        <tr class="border border-gray-300">
          <th class="px-4 py-2 bg-indigo-600 text-white">Kriteria</th>
          <th class="px-4 py-2 bg-indigo-600 text-white">Jenis</th>
          <th class="px-4 py-2 bg-indigo-600 text-white">Bobot</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border border-gray-300">
          <td class="px-4 py-2">Bayaran</td>
          <td class="px-4 py-2">Benefit</td>
          <td class="px-4 py-2">32%</td>
        </tr>
        <tr class="border border-gray-300">
          <td class="px-4 py-2">Waktu Kerja</td>
          <td class="px-4 py-2">Cost</td>
          <td class="px-4 py-2">25%</td>
        </tr>
        <tr class="border border-gray-300">
          <td class="px-4 py-2">Jarak</td>
          <td class="px-4 py-2">Benefit</td>
          <td class="px-4 py-2">13%</td>
        </tr>
        <tr class="border border-gray-300">
          <td class="px-4 py-2">Biaya Transport</td>
          <td class="px-4 py-2">Cost</td>
          <td class="px-4 py-2">30%</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="overflow-x-auto mt-8">
    <h1 class="text-center text-2xl font-bold leading-9 text-gray-900 mb-8">Hasil Perhitungan</h1>
    <table class="table-auto w-full bg-white shadow rounded-lg">
      <thead>
        <tr class="border border-gray-300">
          <th class="px-4 py-2 bg-indigo-600 text-white">Nama Magang</th>
          <th class="px-4 py-2 bg-indigo-600 text-white">Skor</th>
        </tr>
      </thead>
      <tbody>
        <?php for ($i = 0; $i < count($data); $i++) : ?>
          <tr class="border border-gray-300">
            <td class="px-4 py-2"><?= $data[$i]->name ?>
              <?php if ($hasil[$i] == max($hasil)) {
                echo "⭐";
              } ?>
            </td>
            <td class="px-4 py-2"><?= $hasil[$i] ?></td>
          </tr>
        <?php endfor; ?>
      </tbody>
    </table>
  </div>
  </div>
</body>

</html>