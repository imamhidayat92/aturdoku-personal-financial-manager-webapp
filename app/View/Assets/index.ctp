<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Data Aset</a></li>
        </ul>
    </div>
    <div class="large-3 columns">
        <h1 class="aturdoku-nav-head aturdoku-bg-orange">ASET</h1>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <a href="#" class="small secondary expand button aturdoku-button">Tambah Data Aset</a>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Data Aset Lengkap</h2>
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="150">Tanggal</th>
                    <th width="400">Nama Aset</th>
                    <th width="150">Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>8 April 2013</td>
                    <td><em>nama aset di sini</em></td>
                    <td>Rp ###.###,##</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>