<div class="row">
    <div class="large-8 large-offset-2 columns">
        <h2 class="special-font">Tambah Data Kategori Pendapatan</h2>
        <p class="lead">Isi formulir di bawah ini untuk menambahkan data kategori pendapatan Anda.</p>
        
        <!-- Form Tambah -->
        
        <form action="<?php echo Router::url(array('controller' => 'categories', 'action' => 'add_income'))?>" method="POST">
        <fieldset>
            <legend>Data Kategori Pendapatan</legend>
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
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
    </div>
   
</div>