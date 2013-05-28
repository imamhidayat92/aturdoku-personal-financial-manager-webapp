<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'index')) ?>">Kategori</a></li>
            <li><a href="#"><?php echo $category['Category']['name']; ?></a></li>
        </ul>
    </div>
    
    <div class="large-3 columns">
        <h1 class="aturdoku-nav-head aturdoku-bg-black">KATEGORI</h1>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Data Transaksi</h2>
        <h4>Kategori: <?php echo $category['Category']['name'] ?></h4>
        <!-- Tabel Index -->
        
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="120">Tanggal</th>
                    <th width="300">Deskripsi</th>
                    <th width="150">Nominal</th>
                    <th width="130">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 0; foreach ($transactions as $transaction) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $transaction['Transaction']['date']?></td>
                    <td><?php echo $transaction['Transaction']['description']?></td>
                    <td><?php echo $this->Aturdoku->currencyFormat($transaction['Transaction']['amount'])?></td>
                    <td>
                        <?php echo $this->Html->link('Ubah', array('controller' => 'incomes','action' => 'edit', $transaction['Transaction']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                        <?php echo $this->Html->link('Hapus', array('controller' => 'incomes','action' => 'delete', $transaction['Transaction']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
                    </td>
                    
                </tr>
             <?php } ?>
            </tbody>
        </table>
    </div>
</div>