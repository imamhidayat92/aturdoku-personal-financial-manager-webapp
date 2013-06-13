<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'accounts', 'action' => 'index')) ?>">Akun</a></li>
            <li><a href="#">Perbarui</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <h2 class="special-font">Perbarui Data Akun</h2>
        <p>Nama Bank: <?php echo $account['Account']['bank_name']; ?></p>
        <p>Atas Nama: <?php echo $account['Account']['name']; ?></p>
        <p>Cabang: <?php echo $account['Account']['branch']; ?></p>
        <p class="lead">Isi formulir di bawah ini untuk memperbarui data akun Anda.</p>
        
        <!-- Form Tambah -->
        
        <form id="formID" action="<?php echo Router::url(array('controller' => 'accounts', 'action' => 'update', $account['Account']['id']))?>" method="POST" class="custom">
        <fieldset>
            <legend>Perbarui Akun</legend>
            <div class="row">
                <input type="hidden" name="data[Account][id]" value="<?php echo $account['Account']['id']; ?>"/>
                <div class="large-4 columns">                    
                    <div class="small-4 columns">
                        <label class="right inline">Saldo</label>
                    </div>
                    <div class="row collapse">
                        <div class="large-5 columns">
                            <input type="text" name="data[Account][balance]"/>
                        </div>
                            <div class="large-3 columns">
                            <span class="postfix">Rp</span>                    
                        </div>
                    </div>
                </div>                
                <div class="large-4 columns">
                    <div class="small-4 columns">
                        <label class="right inline">Tanggal</label>
                    </div>
                    <div class="small-8 columns">
                        <input type="text" name="data[Account][last_update]" id="datepicker" readonly>
                    </div>
                </div>
                <div class="large-3 columns">
                    <input type="submit" class="small expand success button" value="Simpan Data"/>
                </div>
            </div>
        </fieldset>       
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