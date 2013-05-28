<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Kategori</a></li>
        </ul>
    </div>
    <div class="large-3 columns">
        <h1 class="aturdoku-nav-head aturdoku-bg-black">KATEGORI</h1>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Kategori Pengeluaran</h2>
        <form action="<?php echo Router::url(array('controller' => 'categories', 'action' => 'add_expense'))?>" method="POST">
            <fieldset>
                <legend>Tambah Kategori Pengeluaran</legend>
                <div class="row">
                    <div class="large-4 columns">
                      <label>Nama</label>
                        <input type="text" name="data[Category][name]"/>
                    </div>
                    <div class="large-8 columns">
                        <label>Deskripsi</label>
                        <input type="text" name="data[Category][description]" />
                    </div>
                </div>
            </fieldset>
            <input type="submit" class="alert button" value="Tambah Kategori Pengeluaran"/>
        </form>
        <h2 class="special-font underline">Kategori Pemasukan</h2>
        <form action="<?php echo Router::url(array('controller' => 'categories', 'action' => 'add_income'))?>" method="POST">
        <fieldset>
            <legend>Tambah Kategori Pendapatan</legend>
            <div class="row">
                <div class="large-4 columns">
                  <label>Nama</label>
                    <input type="text" name="data[Category][name]"/>
                </div>
                <div class="large-8 columns">
                    <label>Deskripsi</label>
                    <input type="text" name="data[Category][description]" />
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Tambah Kategori Pendapatan"/>
    </form>
    </div>
</div>