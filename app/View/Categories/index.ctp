<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Atur Kategori</a></li>
        </ul>
    </div>
    <div class="large-3 columns">
        <h1 class="aturdoku-nav-head aturdoku-bg-black">KATEGORI</h1>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Kategori Pengeluaran</h2>
        <h2 class="special-font underline">Kategori Pemasukan</h2>
    </div>
</div>