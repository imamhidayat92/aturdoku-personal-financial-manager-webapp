<div class="row">
    
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Data Akun</a></li>
        </ul>
    </div>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-purple">Akun</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data', array('controller' => 'accounts', 'action' => 'add'), array('class' => 'small purple-button expand button'))?>
        </p>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Data Akun Terkini</h2>
        
        <!-- Tabel Index -->
        
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="150">Nama Bank</th>
                    <th width="270">Atas Nama</th>
                    <th width="150">Saldo</th>
                    <th width="130">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 0; foreach ($accounts as $account) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $account['Account']['bank_name']?></td>
                    <td><?php echo $account['Account']['name']?></td>
                    <td><?php echo $this->Aturdoku->currencyFormat($account['Account']['balance'])?></td>
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
                            <?php echo $this->Html->link('Ubah', array('controller' => 'accounts','action' => 'edit', $account['Account']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                            <?php echo $this->Html->link('Hapus', array('controller' => 'account','action' => 'delete', $account['Account']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
                        </p>
                    </td>
                    
                </tr>
             <?php } ?>
            </tbody>
        </table>
    </div>
</div>