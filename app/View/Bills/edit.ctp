<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'bills', 'action' => 'index')) ?>">Tagihan</a></li>
            <li><a href="#">Ubah</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-8 large-offset-2 columns">
        <h2 class="special-font">Ubah Data Tagihan</h2>
        <p class="lead">Isi formulir di bawah ini untuk mengubah data tagihan Anda.</p>
        
        <!-- Form Tambah -->
        
        <form id="formID" action="<?php echo Router::url(array('controller' => 'bills', 'action' => 'edit'))?>" method="POST" class="custom">
        <fieldset>
            <legend>Nominal dan Deskripsi</legend>
            <div class="row">
                <div class="large-4 columns">
                    <input type="hidden" name="data[Bill][id]" value="<?php echo $bill['Bill']['id']; ?>"/>
                    <label>Nama</label>
                    <input type="text" name="data[Bill][name]" value="<?php echo $bill['Bill']['name']; ?>"/>
                    <div class="row collapse">
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="text" class="validate[required,custom[onlyNumberSp]] text-input" name="data[Bill][amount]" value="<?php echo $bill['Bill']['amount']; ?>"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rp</span>
                        </div>
                    </div>
                    <label>Jatuh Tempo</label>
                    <input type="text" name="data[Bill][due_date]" id="datepicker" value="<?php echo $bill['Bill']['due_date']; ?>" readonly/>
                </div>
                <div class="large-8 columns">
                    <label>Deskripsi</label>
                    <textarea class="validate[required] text-input" name="data[Bill][description]" style="display: block; height: 159px;"><?php echo $bill['Bill']['description']; ?></textarea>
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