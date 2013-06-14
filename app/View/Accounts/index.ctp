<div class="row">
    
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Data Akun</a></li>
        </ul>
    </div>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-purple">AKUN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <a href="#" data-reveal-id="myModal" class="small expand button purple-button">Tambah Data Akun</a>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Data Akun Tunai Terkini</h2>
        
        <!-- Tabel Index -->
        
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>                    
                    <th width="300">Nama</th>
                    <th width="250">Saldo</th>
                    <th width="130">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 0; foreach ($accounts as $account) { ?>
                <tr>
                    <?php if ($account['Account']['bank_name'] == null) {?>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>                    
                    <td><?php echo $account['Account']['name']?></td>
                    <td>
                        <?php 
                            $accountExpenseIndex = 0;
                            $accountExpenseFound = false;
                            
                            foreach($accountExpenses as $accountExpense) {
                                if ($accountExpense['transactions']['account_id'] == $account['Account']['id']) {
                                    $accountExpenseFound = true;
                                    break;
                                }
                                $accountExpenseIndex++;
                            }
                            
                            $accountIncomeIndex = 0;
                            $accountIncomeFound = false;
                            
                            foreach ($accountIncomes as $accountIncome) {
                                if ($accountIncome['transactions']['account_id'] == $account['Account']['id']) {
                                    $accountIncomeFound = true;
                                    break;
                                }
                                $accountIncomeIndex++;
                            }
                            
                            $totalBalance = $account['Account']['balance'];
                            if ($accountExpenseFound) $totalBalance -= $accountExpenses[$accountExpenseIndex][0]['total'];
                            if ($accountIncomeFound) $totalBalance += $accountIncomes[$accountIncomeIndex][0]['total'];                            
                        ?>
                        <?php echo $this->Aturdoku->currencyFormat($totalBalance)?>
                    </td>
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
                            <?php echo $this->Html->link('Ubah', array('controller' => 'accounts','action' => 'edit', $account['Account']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                            <?php echo $this->Html->link('Hapus', array('controller' => 'account','action' => 'delete', $account['Account']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
                        </p>
                    </td>
                    <?php } ?>
                </tr>
             <?php } ?>
            </tbody>
        </table>
        
        <h2 class="special-font underline">Data Akun Non-Tunai Terkini</h2>
        
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
                    <?php if ($account['Account']['bank_name'] != null) {?>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $account['Account']['bank_name']?></td>
                    <td><?php echo $account['Account']['name']?></td>
                    <td>
                        <?php 
                            $accountExpenseIndex = 0;
                            $accountExpenseFound = false;
                            
                            foreach($accountExpenses as $accountExpense) {
                                if ($accountExpense['transactions']['account_id'] == $account['Account']['id']) {
                                    $accountExpenseFound = true;
                                    break;
                                }
                                $accountExpenseIndex++;
                            }
                            
                            $accountIncomeIndex = 0;
                            $accountIncomeFound = false;
                            
                            foreach ($accountIncomes as $accountIncome) {
                                if ($accountIncome['transactions']['account_id'] == $account['Account']['id']) {
                                    $accountIncomeFound = true;
                                    break;
                                }
                                $accountIncomeIndex++;
                            }
                            
                            $totalBalance = $account['Account']['balance'];
                            if ($accountExpenseFound) $totalBalance -= $accountExpenses[$accountExpenseIndex][0]['total'];
                            if ($accountIncomeFound) $totalBalance += $accountIncomes[$accountIncomeIndex][0]['total'];                            
                        ?>
                        <?php echo $this->Aturdoku->currencyFormat($totalBalance)?>
                    </td>
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
                            <?php echo $this->Html->link('Ubah', array('controller' => 'accounts','action' => 'edit', $account['Account']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                            <?php echo $this->Html->link('Hapus', array('controller' => 'account','action' => 'delete', $account['Account']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
                        </p>
                    </td>
                    <?php } ?>
                </tr>
             <?php } ?>
            </tbody>
        </table>                
    </div>
</div>
<?php
    echo $this->Html->script('foundation/foundation.reveal');
?>
<script>
    $(document).foundation();
</script>
<div id="myModal" class="reveal-modal">
    <div class="row">        
        <div class="large-12 columns">
            <h1 class="special-font">Tambah Akun</h1>
            <p>
                Akun Apa Yang Ingin Anda Tambahkan?               
            </p>
            <ul class="button-group even-2">
              <li><a href="<?php echo Router::url(array('controller' => 'accounts', 'action' => 'cash')) ?>" class="button">Tunai</a></li>
              <li><a href="<?php echo Router::url(array('controller' => 'accounts', 'action' => 'noncash')) ?>" class="secondary button">Non-Tunai</a></li>              
            </ul>
        </div>        
    </div>
    <a class="close-reveal-modal">&#215;</a>
</div>