<div class="row">
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'expense' )) ?>">Kategori Pengeluaran</a></li>
            <li><a href="#">Ubah</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-8 large-offset-2 columns">
        <h2 class="special-font">Tambah Data Kategori Pengeluaran</h2>
        <p class="lead">Isi formulir di bawah ini untuk menambahkan data kategori pengeluaran Anda.</p>
        
        <!-- Form Tambah -->
        
        <form action="<?php echo Router::url(array('controller' => 'categories', 'action' => 'add_expense'))?>" method="POST">
        <fieldset>
            <legend>Data Kategori Pengeluaran</legend>
            <div class="row">
                <div class="large-4 columns">
                  <label>Nama</label>
                    <input type="text" name="data[Category][name]"/>
                </div>
                <div class="large-8 columns">
                    <label>Deskripsi</label>
                    <input type="text" name="data[Category][name]" />
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
    </div>
   
</div>