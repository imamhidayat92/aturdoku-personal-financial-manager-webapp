<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'incomes', 'action' => 'index')) ?>">Pendapatan</a></li>
            <li><a href="#">Ubah</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-8 large-offset-2 columns">
        <h2 class="special-font">Ubah Data Pendapatan</h2>
        <p class="lead">Ubah formulir di bawah ini untuk melakukan pengubahan data pendapatan Anda.</p>
        
        <!-- Form Edit -->
        
        <form id="formID" action="<?php echo Router::url(array('controller' => 'incomes', 'action' => 'edit', $income['Transaction']['id']))?>" method="POST" class="custom">
        <fieldset>
            <legend>Nominal dan Deskripsi</legend>
            <div class="row">
                <div class="large-4 columns">
                    <div class="row collapse">
                        
                        <input type="hidden" name="data[Transaction][id]" value="<?php echo $income['Transaction']['id']; ?>"/>
                        
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="text" class="validate[required,custom[onlyNumberSp]] text-input" name="data[Transaction][amount]" value="<?php echo $income['Transaction']['amount']?>"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rp</span>
                        </div>
                    </div>
                    <label>Kategori</label>
                    <select class="medium" name="data[Transaction][category_id]">
                        <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['Category']['id']?>"<?php if ($category['Category']['id'] == $income['Transaction']['category_id']) echo " selected" ?>><?php echo $category['Category']['name']?></option>
                        <?php endforeach;?>
                    </select>
                    <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'income')) ?>" class="small button secondary expand aturdoku-button">Atur Kategori</a>
                    <p class="clear10px"></p>
                </div>
                <div class="large-8 columns">
                    <label>Keperluan</label>
                    <!-- ini harus di benerin -->
                    <textarea class="validate[required] text-input" name="data[Transaction][description]" style="height: 145px; display: block;"><?php echo $income['Transaction']['description']?></textarea>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Waktu & Penyimpanan Pendapatan</legend>
            <div class="row">
                <div class="large-4 columns">
                    <label>Tanggal (<em>Optional</em>)</label>
                    <input type="text" name="data[Transaction][date]" id="datepicker" value="<?php echo $income['Transaction']['date'] ?>" readonly/>
                </div>
                <div class="large-8 columns">
                    <label>Penyimpanan</label>
                    <select name="data[Transaction][account_id]">
                        <?php foreach ($accounts as $account): ?>
                        <option value="<?php echo $account['Account']['id']?>"<?php if ($account['Account']['id'] == $income['Transaction']['account_id']) echo " selected" ?>><?php echo $account['Account']['name']?></option>
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