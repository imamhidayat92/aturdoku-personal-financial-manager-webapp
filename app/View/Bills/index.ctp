<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Data Tagihan</a></li>
        </ul>
    </div>
    <div class="large-3 columns">
        <h1 class="aturdoku-nav-head aturdoku-bg-blue">TAGIHAN</h1>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data', array('controller' => 'bills', 'action' => 'add'), array('class' => 'small blue-button expand button'))?>            
        </p>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Data Tagihan Belum Terbayar</h2>
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="150">Nama</th>
                    <th width="150">Jatuh Tempo</th>                    
                    <th width="170">Nominal</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 0; foreach ($bills as $bill) { ?>
                <tr>
                    <?php if ($bill['Bill']['paid_status'] == 0) {?>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $bill['Bill']['name']?></td>
                    <td><?php echo $bill['Bill']['due_date']?></td>                    
                    <td><?php echo $this->Aturdoku->currencyFormat($bill['Bill']['amount'])?></td>
                    <td>
                        <p align="center" style="margin:0;padding:0;">
                            <?php echo $this->Html->link('Ubah', array('controller' => 'bills','action' => 'edit', $bill['Bill']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                            <?php echo $this->Html->link('Hapus', array('controller' => 'bills','action' => 'delete', $bill['Bill']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
                            <?php echo $this->Html->link('Bayar', array('controller' => 'bills','action' => 'pay', $bill['Bill']['id']), array('class' => 'tiny button success aturdoku-button')); ?>
                        </p>
                    </td>
                    <?php } ?>
                </tr>
             <?php } ?>
            </tbody>
        </table>
        
        <h2 class="special-font underline">Data Tagihan Terbayar</h2>
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="150">Nama</th>
                    <th width="150">Jatuh Tempo</th>                    
                    <th width="170">Nominal</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 0; foreach ($bills as $bill) { ?>
                <tr>
                    <?php if ($bill['Bill']['paid_status'] == 1) {?>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $bill['Bill']['name']?></td>
                    <td><?php echo $bill['Bill']['due_date']?></td>                    
                    <td><?php echo $this->Aturdoku->currencyFormat($bill['Bill']['amount'])?></td>
                    <td>
                        <p align="center" style="margin:0;padding:0;">
                            <?php echo $this->Html->link('Ubah', array('controller' => 'bills','action' => 'edit', $bill['Bill']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                            <?php echo $this->Html->link('Hapus', array('controller' => 'bills','action' => 'delete', $bill['Bill']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>                            
                        </p>
                    </td>
                    <?php } ?>
                </tr>
             <?php } ?>
            </tbody>
        </table>
        
    </div>
</div>