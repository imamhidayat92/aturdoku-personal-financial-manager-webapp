<div class="row">
    
    <?php echo $this->Element('user-navigation'); ?>
    
    <div class="large-12 columns">
        <h1 class="special-font">Halaman Administrator Aturdoku</h1>
    </div>
    
    <!-- Pengeluaran -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">ANGGOTA</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
        <a href="#" class="small alert expand button aturdoku-button" data-reveal-id="add-expense-data">Tambah Data</a>
        </p>
        <h3 class="aturdoku-nav-subhead">Kategori</h3>
        <p>Klasifikasikan jenis pengeluaran Anda. <a href="#">(Pelajari Selengkapnya)</a></p>
        <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'expense')) ?>" class="small secondary expand button aturdoku-button">Atur Kategori</a>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Fluktuasi Pengeluaran Minggu Ini</h2>
        <?php echo $this->Aturdoku->printDateProgress(); ?>
        <div id="plot"></div>
        <p>&nbsp;</p>
        <p>Rata-rata pengeluaran bulan ini: Rp ###.###,##</p>
        <p>Pengeluaran terbesar pada tanggal 2 April 2013 sejumlah: Rp ###.###,##</p>
        <a href="#" class="secondary expand button aturdoku-button">Lihat Laporan Selengkapnya >></a>
        
        <h2 class="special-font underline">Data Pengeluaran Terkini</h2>
        
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="150">Tanggal</th>
                    <th width="400">Deskripsi Pengeluaran</th>
                    <th width="150">Nominal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>7 April 2013</td>
                    <td>Belanja bulanan</td>
                    <td>Rp ###.###,##</td>
                </tr>
            </tbody>
        </table>  
    </div>
</div>