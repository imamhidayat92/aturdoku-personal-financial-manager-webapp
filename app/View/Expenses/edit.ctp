<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'expenses', 'action' => 'index')) ?>">Pengeluaran</a></li>
            <li><a href="#">Ubah</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-8 large-offset-2 columns">
        
        <h2 class="special-font">Ubah Data Pengeluaran</h2>
        <p class="lead">Ubah formulir di bawah ini untuk melakukan pengubahan data pengeluaran Anda.</p>
        
        <!-- Form Edit -->
        
        <form id="formID" action="<?php echo Router::url(array('controller' => 'expenses', 'action' => 'edit', $expense['Transaction']['id']))?>" method="POST" class="custom">
        <fieldset>
            <legend>Nominal dan Deskripsi</legend>
            <div class="row">
                <div class="large-4 columns">
                    <div class="row collapse">
                        <input type="hidden" name="data[Transaction][id]" value="<?php echo $expense['Transaction']['id']; ?>"/>
                        
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="text" class="validate[required,custom[onlyNumberSp]] text-input" name="data[Transaction][amount]" value="<?php echo $expense['Transaction']['amount']?>"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rp</span>
                        </div>
                    </div>
                    <label>Kategori</label>
                    <select class="medium" name="data[Transaction][category_id]">
                        <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['Category']['id']?>"<?php if ($category['Category']['id'] == $expense['Transaction']['category_id']) echo " selected" ?>><?php echo $category['Category']['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="large-8 columns">
                    <label>Keperluan</label>
                    <textarea class="validate[required] text-input" name="data[Transaction][description]" style="height: 150px;"><?php echo $expense['Transaction']['description']?></textarea>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Waktu & Tempat</legend>
            <div class="row">
                <div class="large-4 columns">
                    <label>Tanggal (<em>Optional</em>)</label>
                    <input type="text" class="validate[required] text-input" name="data[Transaction][date]" id="datepicker" value="<?php echo $expense['Transaction']['date']?>" readonly/>
                </div>
                <div class="large-8 columns">
                    <label>Tempat (<a href="#">Lacak dengan Google Maps</a>)</label>
                    <input type="text" name="data[Transaction][place]" value="<?php echo $expense['Transaction']['place']?>"/>
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