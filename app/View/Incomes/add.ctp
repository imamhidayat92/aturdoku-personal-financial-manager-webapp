<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'incomes', 'action' => 'index')) ?>">Data Aset</a></li>
            <li><a href="#">Tambah</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-8 large-offset-2 columns">
        <h2 class="special-font">Tambah Data Pendapatan</h2>
        <p class="lead">Isi formulir di bawah ini untuk menambahkan data pendapataan Anda.</p>
        
        <!-- Form Tambah -->
        
        <form action="<?php echo Router::url(array('controller' => 'incomes', 'action' => 'add'))?>" method="POST">
        <fieldset>
            <legend>Nominal dan Deskripsi</legend>
            <div class="row">
                <div class="large-4 columns">
                    <div class="row collapse">
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="text" name="data[Transaction][amount]"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rupiah</span>
                        </div>
                    </div>
                    <label>Kategori</label>
                    <select class="medium" name="data[Transaction][category_id]">
                        <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['Category']['id']?>"><?php echo $category['Category']['name']?></option>
                        <?php endforeach;?>
                    </select>
                    <p class="clear10px">  </p>
                  <label>Tanggal (<em>Optional</em>)</label>
                    <input type="text" name="data[Transaction][date]" id="datepicker"/>
                </div>
                <div class="large-8 columns">
                    <label>Deskripsi</label>
                    <!-- ini harus di benerin -->
                    <textarea name="data[Transaction][description]" style="height: 30px; display: block;"></textarea>
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