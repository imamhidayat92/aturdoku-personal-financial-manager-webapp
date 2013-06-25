<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'expenseplans', 'action' => 'index')) ?>">Rencana Pengeluaran</a></li>
            <li><a href="#">Ubah</a></li>
        </ul>
    </div>
</div>
<div class="row">    
    <div class="large-8 large-offset-2 columns">
        <h2 class="special-font">Buat Rencana Pengeluaran</h2>
        <p class="lead">Isi formulir di bawah ini untuk membuat rencana pengeluaran Anda.</p>
        
        <!-- Form Tambah -->
        
        <form class="custom" action="<?php echo Router::url(array('controller' => 'expenseplans', 'action' => 'edit'))?>" method="POST">
        <fieldset>
            <legend>Nominal dan Deskripsi</legend>
            <div class="row">
                <div class="large-4 columns">
                    <div class="row collapse">
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="hidden" name="data[ExpensePlan][id]" value="<?php echo $expensePlan['ExpensePlan']['id']; ?>"/>
                            <input type="text" name="data[ExpensePlan][amount]" value="<?php echo $expensePlan['ExpensePlan']['amount']?>"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rp</span>
                        </div>
                    </div>                    
                </div>
                <div class="large-4 columns">
                    <label>Kategori</label>
                    <select class="medium" name="data[ExpensePlan][category_id]">
                        <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['Category']['id']?>" <?php if ($category['Category']['id'] == $expensePlan['ExpensePlan']['category_id']) echo "selected" ?>><?php echo $category['Category']['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="large-4 columns">
                    <label>Bulan</label>
                    <select class="medium" name="data[ExpensePlan][month]">
                        <?php 
                        $i = 1;
                        foreach ($this->Aturdoku->months as $month): ?>
                        <option value="<?php echo $i?>"<?php if (date('m') == $i) echo " selected" ?>><?php echo $month?></option>
                        <?php 
                            $i++;
                        endforeach; ?>
                    </select>
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
        
    </div>
    
</div>

<script>
    $(document).foundation();
</script>