<div class="row">
    <?php 
        $type = '';
        $view = '';
    
        if ($data['Category']['category_type'] == 0){
            $type = 'Pengeluaran';
            $view = 'expense';
        }
        else{
            $type = 'Pendapatan';
            $view = 'income';
        }
    ?>
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'categories', 'action' => $view )) ?>">Kategori</a></li>
            <li><a href="#">Ubah</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-8 large-offset-2 columns">
        <h2 class="special-font">Ubah Data Kategori <?php echo $type; ?></h2>
        <p class="lead">Ubah formulir di bawah ini untuk mengubah data kategori <?php echo $type; ?> Anda.</p>
        
        <!-- Form Tambah -->
        
        <form action="<?php echo Router::url(array('controller' => 'categories', 'action' => 'edit'))?>" method="POST">
        <fieldset>
            <legend>Data Kategori <?php echo $type; ?></legend>
            <div class="row">
                <input type="hidden" name="data[Category][id]" value="<?php echo $data['Category']['id']; ?>"/>
                <div class="large-4 columns">
                  <label>Nama</label>
                    <input type="text" name="data[Category][name]" value="<?php echo $data['Category']['name'];?>"/>
                </div>
                <div class="large-8 columns">
                    <label>Deskripsi</label>
                    <input type="text" name="data[Category][description]" value="<?php echo $data['Category']['description'];?>"/>
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
    </div>
   
</div>