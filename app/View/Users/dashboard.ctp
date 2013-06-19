<?php    
    $totalExpense = 0;    
    $maxExpense = 0;
    $averageExpense = array(
        'Transaction' => array(
            'amount' => 0
        )
    );
    
    $totalIncome = 0;
    $maxIncome = 0;
    $averageIncome = array(
        'Transaction' => array(
            'amount' => 0
        )
    );
?>

<script>
    var expensePlotLoaded = false;
    var expenseCategoryPlotLoaded = false;
    var incomePlotLoaded = false;
    var incomeCategoryPlotLoaded = false;
</script>

<div class="row">    
    <?php echo $this->Element('user-navigation'); ?>    
    
    <!-- Pengeluaran -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red" id="expense-tab">PENGELUARAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p id="expense-add">
            <?php echo $this->Html->link('Tambah Data Pengeluaran', array('controller' => 'expenses', 'action' => 'add'), array('class' => 'small alert expand button aturdoku-button'))?>
        </p>
 
        <h3 class="aturdoku-nav-subhead">Kategori</h3>
        <p>Klasifikasikan jenis pengeluaran Anda.</p>
        <a id="expense-category" href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'expense')) ?>" class="small alert expand button">Atur Kategori</a>
        
        <h3 class="aturdoku-nav-subhead">Perencanaan</h3>
        <p id="expense-plan">Rencanakan pengeluaran-pengeluaran Anda.</p>
        <a href="<?php echo Router::url(array('controller' => 'expenseplans', 'action' => 'index')) ?>" class="small alert expand button">Atur Rencana</a>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Fluktuasi Pengeluaran</h2>
        <?php echo $this->Aturdoku->printDateProgress(); ?>
        
    <?php if (count($expenses) > 0): ?>
        
        <?php        
            $numberOfExpense = 0;
            foreach ($expenses as $expense) {
                $totalExpense += $expense['Transaction']['amount']; 
                
                if ($maxExpense['Transaction']['amount'] < $expense['Transaction']['amount']) {
                    $maxExpense = $expense;
                }
                
                $numberOfExpense++;
            }
            
            $averageExpense = $totalExpense / $numberOfExpense;
        ?>
        
        <script>
            expensePlotLoaded = true;
        </script>
        
        <?php if (count($dailyExpenses) > 1): ?>
        <div id="plot"></div>
        <?php else: ?>
        <h5 align="center" style="margin-top: 50px;">Data pengeluaran Anda saat ini belum dapat divisualisasikan.</h5>
        <?php endif; ?>
        <p>&nbsp;</p>
        
        <h3 class="subheader">Total pengeluaran Anda bulan ini: <?php echo $this->Aturdoku->currencyFormat($currentMonthTotalExpense); ?></h3>
        
        <p>Rata-rata pengeluaran bulan ini: <?php echo $this->Aturdoku->currencyFormat($currentMonthAverageExpense) ?></p>
        <p>Pengeluaran terbesar sejumlah: <?php echo $this->Aturdoku->currencyFormat($currentMonthMaxExpense); ?></p>
        
        <h2 class="special-font underline">Data Pengeluaran Terkini</h2>
        
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="120">Tanggal</th>
                    <th width="300">Deskripsi Pendapatan</th>
                    <th width="150">Nominal</th>
                    <th width="130">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 0; foreach ($expenses as $expense) { ?>
                <tr>
                    <?php 
                        $nomor++;
                    ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $expense['Transaction']['date']?></td>
                    <td><?php /* ?><span class="label alert"><?php echo $expense['Category']['name'] ?></span><?php */ ?><?php echo $expense['Transaction']['description']?></td>
                    <td><?php echo $this->Aturdoku->currencyFormat($expense['Transaction']['amount']);?></td>
                    <td>
                        <p align="center" style="margin:0;padding:0;">
                            <?php echo $this->Html->link('Ubah', array('controller' => 'expenses','action' => 'edit', $expense['Transaction']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                            <?php echo $this->Html->link('Hapus', array('controller' => 'expenses','action' => 'delete', $expense['Transaction']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
                        </p>
                    </td>                    
                </tr>
             <?php } ?>                
            </tbody>
        </table>
        
        <?php echo $this->Html->link('Lihat Data Pengeluaran Selengkapnya', array('controller' => 'expenses', 'action' => 'index'), array('class' => 'secondary expand button'))?>
    <?php else: ?>
        <h2 style="color: #cccccc; text-align: center; line-height: 1; margin: 100px 0 100px 0;">Anda belum menyimpan data pengeluaran apapun.</h2>
    <?php endif; ?>
        
        <h2 class="special-font underline">Pengeluaran Berdasarkan Kategori</h2>
        <div class="row">
            <div class="large-8 columns">
                <div id="expenseCategory"></div>
            </div>
            <div class="large-4 columns">
                <?php foreach ($expenseCategory as $category): ?>
                <p style="margin: 0; padding: 0;"><strong><?php echo $category['categories']['category']?></strong></p>
                <p align="right"><?php echo $this->Aturdoku->currencyFormat($category[0]['total'])?></p>
                <?php endforeach; ?>
            </div>
        </div>        
    </div>
    <div class="separator"></div>
    
    <!-- Pemasukan -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-green" id="income-tab">PENDAPATAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p id="income-add">
            <?php echo $this->Html->link('Tambah Data Pendapatan', array('controller' => 'incomes', 'action' => 'add'), array('class' => 'small success expand button'))?>
        </p>
        <h3 class="aturdoku-nav-subhead" id="income-category">Kategori</h3>
        <p>Klasifikasikan jenis pendapatan Anda.</p>
        <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'income')) ?>" class="small success expand button">Atur Kategori</a>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Ringkasan Singkat</h2>
        <?php if ($totalBalance + $totalIncomes - $totalExpenses < 0):?>
        <div class="row">
            <div class="large-8 large-offset-2 columns">
                <div class="row" style="background-color: red;">
                    <div class="large-4 columns">
                        <?php echo $this->Html->image('warning.png'); ?>
                    </div>
                    <div class="large-8 columns">
                        <h3 style="color: white; line-height: 1em; margin-top: 20px;">Saat ini kas Anda negatif!!</h3>
                        <p style="color: white; line-height: 1em;">Pastikan Anda telah mengisi data pendapatan Anda dengan lengkap.</p>
                    </div>                    
                </div>
            </div>
        </div>       
        <?php endif; ?>
        
        <?php if (count($incomes) > 0): ?>
        
        <?php        
            $numberOfIncome = 0;
            foreach ($incomes as $income) {
                $totalIncome += $income['Transaction']['amount']; 
                
                if ($maxIncome['Transaction']['amount'] < $income['Transaction']['amount']) {
                    $maxIncome = $income;
                }
                
                $numberOfIncome++;
            }
            
            //$averageExpense = $totalExpense / $numberOfExpense;
        ?>
        
        <script>
            incomePlotLoaded = true;
        </script>
        
        
        
        <?php if (count($dailyIncomes) > 1): ?>
        <div id="income"></div>
        <?php else: ?>
        <h5 align="center" style="margin-top: 50px;">Data pendapatan Anda saat ini belum dapat divisualisasikan.</h5>
        <?php endif; ?>
        <p>&nbsp;</p>
        
<!--        <div id="income"></div>-->
        <h3 class="subheader">Isi kas Anda: <?php echo $this->Aturdoku->currencyFormat($totalBalance + $totalIncomes - $totalExpenses); ?></h3>
        <h2 class="special-font underline">Data Pendapatan Terkini</h2>
        
        <table>
        <thead>
            <tr>
                <th width="40">No.</th>
                <th width="120">Tanggal</th>
                <th width="300">Deskripsi Pendapatan</th>
                <th width="150">Nominal</th>
                <th width="130">Aksi</th>
            </tr>
        </thead>
            <tbody>
                <?php $nomor = 0; foreach ($incomes as $income) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $income['Transaction']['date']?></td>
                    <td><?php echo $income['Transaction']['description']?></td>
                    <td><?php echo $this->Aturdoku->currencyFormat($income['Transaction']['amount']);?></td>
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
                            <?php echo $this->Html->link('Ubah', array('controller' => 'incomes','action' => 'edit', $income['Transaction']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                            <?php echo $this->Html->link('Hapus', array('controller' => 'incomes','action' => 'delete', $income['Transaction']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
                        </p>
                    </td>
                    
                </tr>
             <?php } ?>
            </tbody>
        </table>
        
        <?php else: ?>
            <h2 style="color: #cccccc; text-align: center; line-height: 1; margin: 100px 0 100px 0;">Anda belum menyimpan data pendapatan apapun.</h2>
        <?php endif; ?>
        
        <h2 class="special-font underline">Pendapatan Berdasarkan Kategori</h2>
        <div class="row">
            <div class="large-8 columns">
                <div id="incomeCategory"></div>
            </div>
            <div class="large-4 columns">
                <?php foreach ($incomeCategory as $category): ?>
                <p style="margin: 0; padding: 0;"><strong><?php echo $category['categories']['category']?></strong></p>
                <p align="right"><?php echo $this->Aturdoku->currencyFormat($category[0]['total'])?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <a href="<?php echo Router::url(array('controller' => 'incomes', 'action' => 'index')) ?>" class="secondary expand button">Lihat Data Pendapatan Selengkapnya</a>
    </div>
    <p class="clearfix"></p>
    <div class="separator"></div>
    
    <!-- Akun -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-purple" id="account">AKUN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <a href="#" data-reveal-id="addAccountModal" class="small expand button purple-button">Tambah Data Akun</a>
        <a href="#" data-reveal-id="transferAccountModal" class="small expand button purple-button">Transfer Dana</a>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Data Akun Tunai</h2>
        
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>                        
                    <th width="300">Atas Nama</th>
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
        
        <h2 class="special-font underline">Data Akun Non-Tunai</h2>
        
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
                
                    <?php if ($account['Account']['bank_name'] != null) {?>
                    <?php $nomor++; ?>
                <tr>
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
                </tr>
                    <?php } ?>
                
             <?php } ?>
            </tbody>
        </table>
        
        <a href="<?php echo Router::url(array('controller' => 'accounts', 'action' => 'index')) ?>" class="secondary expand button">Lihat Data Akun Lengkap</a>
    </div>
    <div class="separator"></div>
    
    <!-- Tagihan -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-blue" id="bill">Tagihan</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data Tagihan', array('controller' => 'bills', 'action' => 'add'), array('class' => 'small blue-button expand button'))?>            
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
                    <td><?php echo $this->Aturdoku->currencyFormat($bill['Bill']['amount']);?></td>                    
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
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
                    <?php if ($bill['Bill']['paid_status'] != 0) {?>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $bill['Bill']['name']?></td>
                    <td><?php echo $bill['Bill']['due_date']?></td>
                    <td><?php echo $this->Aturdoku->currencyFormat($bill['Bill']['amount']);?></td>                    
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
                            <?php echo $this->Html->link('Ubah', array('controller' => 'bills','action' => 'edit', $bill['Bill']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                            <?php echo $this->Html->link('Hapus', array('controller' => 'bills','action' => 'delete', $bill['Bill']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>                            
                        </p>
                    </td>
                    <?php } ?>
                </tr>
             <?php } ?>
            </tbody>
        </table>
        
        <a href="<?php echo Router::url(array('controller' => 'bills', 'action' => 'index')) ?>" class="secondary expand button">Lihat Data Tagihan Lengkap</a>
    </div>
    <div class="separator"></div>
    
    <!-- Aset -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-orange" id="asset">ASET</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data Aset', array('controller' => 'assets', 'action' => 'add'), array('class' => 'small orange-button expand button'))?>
            <?php echo $this->Html->link('Export Data Aset', array('controller' => 'assets', 'action' => 'outputtopdf'), array('class' => 'secondary small expand button'))?>
        </p>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Data Aset Terkini</h2>
        
        <table>
        <thead>
            <tr>
                <th width="40">No.</th>
                <th width="100">Tahun</th>
                <th width="150">Nama Aset</th>
                <th width="150">Nilai</th>
                <th width="200">Keterangan</th>
                <th width="130">Aksi</th>
            </tr>
        </thead>
            <tbody>
                <?php $nomor = 0; foreach ($assets as $asset) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $asset['Asset']['year']?></td>
                    <td><?php echo $asset['Asset']['name']?></td>
                    <td><?php echo $this->Aturdoku->currencyFormat($asset['Asset']['value']);?></td>
                    <td><?php echo $asset['Asset']['description']?></td>
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
                        <?php echo $this->Html->link('Ubah', array('controller' => 'assets','action' => 'edit', $asset['Asset']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                        <?php echo $this->Html->link('Hapus', array('controller' => 'assets','action' => 'delete', $asset['Asset']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
                        </p>
                    </td>
                    
                </tr>
             <?php } ?>
            </tbody>
        </table>  
        
        <a href="<?php echo Router::url(array('controller' => 'assets', 'action' => 'index')) ?>" class="secondary expand button">Lihat Data Aset Lengkap</a>
    </div>
    <div class="separator"></div>
</div>

<?php
    echo $this->Html->script("plugins/jqplot.highlighter.min");
    echo $this->Html->script("plugins/jqplot.cursor.min");
    echo $this->Html->script("plugins/jqplot.dateAxisRenderer.min");
    
    echo $this->Html->script('foundation/foundation');
    echo $this->Html->script('foundation/foundation.reveal');    
?>

<script>
    $(document).foundation();
    $(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
        
        if (expensePlotLoaded) {
            var line1=[
                <?php
                    foreach ($dailyExpenses as $expense):
                ?>
                    ['<?php echo $expense['transactions']['date'] ?>', <?php echo $expense[0]['total'] ?>],
                <?php
                    endforeach;
                ?>

            ];

            var dailyExpenseGraph = $.jqplot('plot', [line1], {
                seriesColors:["#ff0000"],
                animate: !$.jqplot.use_excanvas,                
                
                axes:{
                    xaxis:{
                        renderer:$.jqplot.DateAxisRenderer,
                        tickOptions:{
                            formatString:'%b&nbsp;%#d',
                            showGridline:true
                        }                     
                    },
                    yaxis:{
                        tickOptions:{
                            formatString:'Rp %.2f'
                        }                        
                    }
                },
                highlighter: {
                    show: true,
                    sizeAdjust: 7.5
                },
                cursor: {
                    show: false
                },
                grid: {
                    drawGridLines:true,
                    gridLineColor: "#ebebeb",
                    background: "#ffffff",
                    renderer: $.jqplot.CanvasGridRenderer
                }
            });    
        }
        
        if (incomePlotLoaded) {
            var barValue = [
                <?php 
                    foreach ($monthlyIncomes as $income):
                        echo $income[0]['total']." ,";
                    endforeach;
                ?>
            ];
            var barInfo = [
                <?php 
                    foreach ($monthlyIncomes as $income):
                        echo "'".$this->Aturdoku->printBarGraphDateInfo($income[0]['time'])."',";
                    endforeach;
                ?>
            ];

            var monthlyIncomeGraph = $.jqplot('income', [barValue], {
                // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
                animate: !$.jqplot.use_excanvas,
                seriesDefaults:{
                    renderer:$.jqplot.BarRenderer,
                    pointLabels: { show: false },
                    color: '#008000'
                },
                axes: {
                    xaxis: {
                        renderer: $.jqplot.CategoryAxisRenderer,
                        ticks: barInfo
                    }
                },
                highlighter: { show: false },
                grid: {
                    drawGridLines:true,
                    gridLineColor: "#ebebeb",
                    background: "#ffffff",
                    renderer: $.jqplot.CanvasGridRenderer
                }
            });
        }

        if (expenseCategoryPlotLoaded) {
            var dataExpense = [
                <?php
                    foreach ($expenseCategory as $category):
                ?>
                    ['<?php echo $category['categories']['category']?>', <?php echo $category[0]['total']?>],
                <?php
                    endforeach;
                ?>
              ];

            var expenseCategoryGraph = jQuery.jqplot ('expenseCategory', [dataExpense], 
              { 
                seriesDefaults: {
                  // Make this a pie chart.
                  renderer: jQuery.jqplot.PieRenderer, 
                  rendererOptions: {
                    // Put data labels on the pie slices.
                    // By default, labels show the percentage of the slice.
                    showDataLabels: true
                  }
                }, 
                legend: { show:true, location: 'e' }
              }
            );
        }
        
        if (incomeCategoryPlotLoaded) {
            var dataIncome = [
                <?php
                    foreach ($incomeCategory as $category):
                ?>
                    ['<?php echo $category['categories']['category']?>', <?php echo $category[0]['total']?>],
                <?php
                    endforeach;
                ?>
              ];

            var incomeCategoryGraph = jQuery.jqplot ('incomeCategory', [dataIncome], 
              { 
                seriesDefaults: {
                  // Make this a pie chart.
                  renderer: jQuery.jqplot.PieRenderer, 
                  rendererOptions: {
                    // Put data labels on the pie slices.
                    // By default, labels show the percentage of the slice.
                    showDataLabels: true
                  }
                }, 
                legend: { show:true, location: 'e' }
              }
            );
        }
        
    });
</script>

<?php 
    if ($first_time == 1):
        echo $this->Html->script('foundation/foundation.joyride');        
?>

<!-- At the bottom of your page but inside of the body tag -->
<ol class="joyride-list" data-joyride>
    <li data-button="Selanjutnya">
        <h4>Selamat datang!</h4>
        <p>Sepertinya ini adalah kunjungan pertama Anda. Mari berkeliling terlebih dahulu. :)</p>
    </li>
    
    <li data-id="expense-tab" data-button="Selanjutnya">
        <p>Bagian ini adalah navigasi yang dapat Anda gunakan untuk menambahkan data pengeluaran Anda.</p>
    </li>
    <li data-id="expense-add" data-button="Selanjutnya">
        <p>Untuk menambahkan data pengeluaran, klik tombol ini.</p>
    </li>
    <li data-id="expense-category" data-button="Selanjutnya">
        <p>Atur ketegori pengeluaran Anda dengan menggunakan menu ini. Ini akan memudahkan Anda dalam
        mengkategorikan data pengeluaran Anda.</p>
    </li>
    <li data-id="expense-plan" data-button="Selanjutnya">
        <p>Rencanakan pengeluaran Anda nanti dengan menggunakan fitur ini.</p>
    </li>
    
    <li data-id="income-tab" data-button="Selanjutnya">
        <p>Bagian ini adalah navigasi yang dapat Anda gunakan untuk menambahkan data pendapatan Anda.</p>
    </li>
    <li data-id="income-add" data-button="Selanjutnya">
        <p>Untuk menambahkan data pendapatan, klik tombol ini.</p>
    </li>
    <li data-id="income-category" data-button="Selanjutnya">
        <p>Atur ketegori pengeluaran Anda dengan menggunakan menu ini. Ini akan memudahkan Anda dalam
        mengkategorikan data pendapatan Anda.</p>
    </li>
    <li data-id="account" data-button="Selanjutnya">
        <p>Bagian ini adalah bagian Akun. Pastikan Anda menyimpan data Akun Anda terlebih dahulu sebelum melakukan penambahan data transaksi terbaru Anda.</p>
    </li>
    <li data-id="bill" data-button="Selanjutnya">
        <p>Bagian ini adalah bagian Tagihan. Pastikan Anda menyimpan data Tagihan terbaru Anda.</p>
    </li>
    <li data-id="asset" data-button="Selanjutnya">
        <p>Bagian ini adalah bagian Aset. Pastikan Anda menyimpan data aset terbaru Anda.</p>
    </li>
    
    <li data-button="Selanjutnya">
        <h4>Selesai</h4>
        <p>Demikian. Mari atur keuangan Anda dengan lebih bijaksana bersama Aturdoku. :)</p>
    </li>
</ol>

<script>    
    $(document).foundation('joyride', 'start');
</script>
<?php 
    endif;
?>

<div id="addAccountModal" class="reveal-modal">
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

<div id="transferAccountModal" class="reveal-modal">
    <div class="row">        
        <div class="large-10 large-centered columns">
            <h1 class="special-font">Tambah Data Transfer</h1>
            <p>
                Isi formulir di bawah ini untuk menambahkan data transfer Anda.
            </p>
            <form class="custom" method="POST" action="<?php echo Router::url(array('controller' => 'accounts', 'action' => 'transfer')) ?>">
                <fieldset>
                    <legend>Data Akun</legend>
                    <div class="large-4 column">                        
                        <label>Akun Sumber</label>
                        <select class="medium" name="data[Account][sourceId]">
                            <?php foreach ($accounts as $account) { 
                                if ($account['Account']['bank_name'] == null){
                            ?>                                
                                <option value="<?php echo $account['Account']['id'] ?>"><?php echo $account['Account']['name']?></option>
                            <?php } else {  ?>
                                <option value="<?php echo $account['Account']['id'] ?>"><?php echo $account['Account']['bank_name']." - ".$account['Account']['name']?></option>
                            <?php }                            
                            } ?>                                                        
                        </select>                                                                                          
                    </div>
                    <div class="large-4 columns">
                        <label>Akun Tujuan</label>
                        <select class="large" name="data[Account][destinationId]">
                            <?php foreach ($accounts as $account) { 
                                if ($account['Account']['bank_name'] == null){
                            ?>                                
                                <option value="<?php echo $account['Account']['id'] ?>"><?php echo $account['Account']['name']?></option>
                            <?php } else {  ?>
                                <option value="<?php echo $account['Account']['id'] ?>"><?php echo $account['Account']['bank_name']." - ".$account['Account']['name']?></option>
                            <?php }                            
                            } ?>
                        </select>
                    </div>
                    <div class="large-4 columns">
                       <div class="row collapse">
                            <label>Nominal</label>
                            <div class="large-9 columns">
                                <input type="text" class="validate[required,custom[onlyNumberSp]] text-input" name="data[Account][amount]"/>
                            </div>
                            <div class="large-3 columns">
                                <span class="postfix">Rp</span>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <input type="submit" class="success button" value="Simpan Data"/>
            </form>
        </div>        
    </div>
    <a class="close-reveal-modal">&#215;</a>
</div>

<script>
    $(document).foundation();
</script>