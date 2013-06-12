<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'expenseplans', 'action' => 'index')) ?>">Rencana Pengeluaran</a></li>
            <li><a href="#">Tambah</a></li>
        </ul>
    </div>
</div>