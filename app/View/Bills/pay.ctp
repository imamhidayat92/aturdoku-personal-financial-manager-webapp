<div class="row">
<?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'bills', 'action' => 'index')) ?>">Tagihan</a></li>
            <li><a href="#">Bayar</a></li>
        </ul>
    </div>
</div>
<div class="row">    
    <div class="large-8 large-offset-2 columns">
        <h2 class="special-font">Tambah Data Pembayaran Tagihan</h2>
        <p class="lead">Isi formulir di bawah ini untuk menambahkan data pembayaran tagihan Anda.</p>
        
        <!-- Form Tambah -->
        
        <form id="formID" class="custom" action="<?php echo Router::url(array('controller' => 'bills', 'action' => 'pay', $bill['Bill']['id']))?>" method="POST">
        <fieldset>
            <legend>Nominal dan Deskripsi</legend>
            <div class="row">
                <div class="large-4 columns">
                    <div class="row collapse">
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="text" class="validate[required,custom[onlyNumberSp]] text-input" name="data[Transaction][amount]" value="<?php echo $bill['Bill']['amount'];?>"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rp</span>
                        </div>
                    </div>                    
                </div>
                <div class="large-8 columns">
                    <label>Keperluan</label>
                    <textarea class="validate[required] text-input" name="data[Transaction][description]" style="height: 150px;"><?php echo $bill['Bill']['description'];?></textarea>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Klasifikasi Pengeluaran</legend>
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
                    <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'expense')) ?>" class="small button secondary expand">Atur Kategori</a>
                </div>
            </div>            
        </fieldset>
        <fieldset>
            <legend>Waktu & Sumber Dana</legend>
            <div class="row">
                <div class="large-4 columns">
                    <label>Tanggal</label>
                    <input type="text" class="validate[required] text-input" name="data[Transaction][date]" id="datepicker" value="<?php echo date('Y-m-d') ?>" readonly/>
                </div>
                <div class="large-8 columns">
                    <label>Sumber Dana</label>
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