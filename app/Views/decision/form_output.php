
Data:
<table>
    <throw>
        <th>Nama Magang</th>
        <th>Bayaran per Bulan</th>
        <th>Waktu Kerja per Hari</th>
        <th>Jarak Lokasi</th>
        <th>Ongkos Transportasi</th>
        
    </throw>
    <?php foreach($data as $d):?>
    <tr>
        <td><?= $d->name;?></td>
        <td>Rp<?= $d->salary;?></td>
        <td><?= $d->work_hour;?> Jam</td>
        <td><?= $d->distance;?> Km</td>
        <td>Rp<?= $d->transport_fee;?></td>
    </tr>
    <?php endforeach; ?>
</table>
Kriteria:
<table>
    <throw>
        <th>Kriteria</th>
        <th>Jenis</th>
        <th>Bobot</th>
    </throw>
    <tr><td>Bayaran</td><td>Benefit</td><td>32%</td></tr>
    <tr><td>Waktu Kerja</td><td>Cost</td><td>25%</td></tr>
    <tr><td>Jarak</td><td>Benefit</td><td>13%</td></tr>
    <tr><td>Biaya Transport</td><td>Cost</td><td>30%</td></tr>
</table>
Hasil:
<table>
    <throw>
        <th>Nama Magang</th>
        <th>Skor</th>
    </throw>
    
    <?php
    for($i=0; $i<count($data); $i++):
    ?>
        <tr><td><?=$data[$i]->name?></td><td><?=$hasil[$i]?></td></tr>
    <?php
    endfor;
    ?>
</table>