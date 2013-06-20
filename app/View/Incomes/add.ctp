<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'incomes', 'action' => 'index')) ?>">Pendapatan</a></li>
            <li><a href="#">Tambah</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-green" id="expense-tab">PENDAPATAN</h2>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font">Tambah Data Pendapatan</h2>
    </div>
</div>
<div class="row">
    <div class="large-8 large-offset-2 columns">        
        <p class="lead">Isi formulir di bawah ini untuk menambahkan data pendapataan Anda.</p>
        
        <!-- Form Tambah -->
        
        <form id="formID" action="<?php echo Router::url(array('controller' => 'incomes', 'action' => 'add'))?>" method="POST" class="custom">
        <fieldset>
            <legend>Nominal dan Deskripsi</legend>
            <div class="row">
                <div class="large-4 columns">
                    <div class="row collapse">
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="text" class="validate[required,custom[onlyNumberSp]] text-input" name="data[Transaction][amount]"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rp</span>
                        </div>
                    </div>                    
                </div>
                <div class="large-8 columns">
                    <label>Deskripsi</label>
                    <textarea class="validate[required] text-input" name="data[Transaction][description]" style="display: block; height: 145px;"></textarea>
                </div>
            </div>
        </fieldset>
            <fieldset>
            <legend>Klasifikasi Pendapatan</legend>
            <div class="row">
                <div class="large-6 columns">
                    <label>Kategori / Subkategori</label>
                    <select class="medium" name="data[Transaction][sub_category_id]">
                    <?php
                        foreach ($categories as $category): 
                            foreach ($category['SubCategory'] as $subCategory):
                    ?>
                        <option value="<?php echo $subCategory['id']?>"><?php echo $category['Category']['name']?> / <?php echo $subCategory['name'] ?></option>
                    <?php 
                            endforeach;
                        endforeach; 
                    ?>
                    </select>
                </div>
                <div class="large-6 columns">
                    <label>Pengaturan</label>
                    <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'income')) ?>" class="small button secondary expand">Atur Kategori</a>
                </div>
            </div>            
        </fieldset>
        <fieldset>
            <legend>Waktu & Penyimpanan Pendapatan</legend>
            <div class="row">
                <div class="large-4 columns">
                    <label>Tanggal</label>
                    <input type="text" name="data[Transaction][date]" id="datepicker" value="<?php echo date('Y-m-d'); ?>" readonly/>
                </div>
                <div class="large-8 columns">
                    <label>Penyimpanan</label>
                    <select name="data[Transaction][account_id]">
                        <?php foreach ($accounts as $account): ?>
                        <option value="<?php echo $account['Account']['id']?>"><?php echo $account['Account']['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
    </div>
   
</div>

<script>
    $(function() {
        $(document).foundation();
        $('#datepicker').datepicker({dateFormat: 'yy-mm-dd'});
        $('#formID').validationEngine();
    });
</script>