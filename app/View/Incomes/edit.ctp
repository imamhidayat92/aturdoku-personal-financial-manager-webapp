<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'incomes', 'action' => 'index')) ?>">Data Aset</a></li>
            <li><a href="#">Ubah</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-8 large-offset-2 columns">
        <h2 class="special-font">Edit Data Pendapatan</h2>
        <p class="lead">Ubah formulir di bawah ini untuk melakukan pengubahan data pendapatan Anda.</p>
        
        <!-- Form Edit -->
        
        <form action="<?php echo Router::url(array('controller' => 'incomes', 'action' => 'edit'))?>" method="POST">
        <fieldset>
            <legend>Nominal dan Deskripsi</legend>
            <div class="row">
                <div class="large-4 columns">
                    <div class="row collapse">
                        
                        <input type="hidden" name="data[Transaction][id]" value="<?php echo $income['Transaction']['id']; ?>"/>
                        
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="text" name="data[Transaction][amount]" value="<?php echo $income['Transaction']['amount']?>"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rupiah</span>
                        </div>
                    </div>
                    <label>Kategori</label>
                    <select class="medium">
                        <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['Category']['id']?>"<?php if ($category['Category']['id'] == $income['Transaction']['category_id']) echo " selected" ?>><?php echo $category['Category']['name']?></option>
                        <?php endforeach;?>
                    </select>
                    <p class="clear10px">  </p>
                  <label>Tanggal (<em>Optional</em>)</label>
                  <input type="text" name="data[Transaction][date]" id="datepicker" value="<?php echo $income['Transaction']['date']?>"/>
                </div>
                <div class="large-8 columns">
                    <label>Keperluan</label>
                    <!-- ini harus di benerin -->
                    <textarea name="data[Transaction][description]" style="height: 30px; display: block;"><?php echo $income['Transaction']['description']?></textarea>
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
    </div>
   
</div>
<script>
    $(function() {
        $('#datepicker').datepicker();
    });
</script>