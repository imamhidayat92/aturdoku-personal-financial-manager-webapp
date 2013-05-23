<?php
    $totalExpense = 0;
    $maxExpense = 0;
    $averageExpense = array(
        'Transaction' => array(
            'amount' => 0
        )
    );
?>

<div class="row">    
    <?php echo $this->Element('user-navigation'); ?>    
    <div class="separator"></div>
    
    <!-- Pengeluaran -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">PENGELUARAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data Pengeluaran', array('controller' => 'expenses', 'action' => 'add'), array('class' => 'small alert expand button aturdoku-button'))?>
        </p>
 
        <h3 class="aturdoku-nav-subhead">Kategori</h3>
        <p>Klasifikasikan jenis pengeluaran Anda.</p>
        <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'expense')) ?>" class="small alert expand button">Atur Kategori</a>
        
        <h3 class="aturdoku-nav-subhead">Perencanaan</h3>
        <p>Rencanakan pengeluaran-pengeluaran Anda.</p>
        <a href="<?php echo Router::url(array('controller' => 'expenseplans', 'action' => 'add')) ?>" class="small alert expand button">Buat Rencana</a>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Fluktuasi Pengeluaran Minggu Ini</h2>
        <?php echo $this->Aturdoku->printDateProgress(); ?>
        
    <?php if (count($expenses) > 0): ?>
        
        <?php if (count($dailyExpenses) > 1): ?>
        <div id="plot"></div>
        <?php else: ?>
        <h5 align="center" style="margin-top: 50px;">Data pengeluaran Anda saat ini belum dapat divisualisasikan.</h5>
        <?php endif; ?>
        <p>&nbsp;</p>
        
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
        
        <p>Rata-rata pengeluaran bulan ini: <?php echo $this->Aturdoku->currencyFormat($averageExpense) ?></p>
        <p>Pengeluaran terbesar sejumlah: <?php echo $this->Aturdoku->currencyFormat($maxExpense['Transaction']['amount']); ?></p>
        
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
                    <td><?php echo $expense['Transaction']['description']?></td>
                    <td><?php echo $this->Aturdoku->currencyFormat($expense['Transaction']['amount']);?></td>
                    <td>
                        <?php echo $this->Html->link('Edit', array('controller' => 'expenses','action' => 'edit', $expense['Transaction']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                        <?php echo $this->Html->link('Hapus', array('controller' => 'expenses','action' => 'delete', $expense['Transaction']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
                    </td>                    
                </tr>
             <?php } ?>                
            </tbody>
        </table>
        
        <?php echo $this->Html->link('Lihat Data Pengeluaran Selengkapnya', array('controller' => 'expenses', 'action' => 'index'), array('class' => 'secondary expand button'))?>
    <?php else: ?>
        <h2 style="color: #cccccc; text-align: center; line-height: 1;">Anda belum menyimpan data pengeluaran apapun.</h2>
    <?php endif; ?>
    </div>
    <div class="separator"></div>
    
    <!-- Pemasukan -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-green">PENDAPATAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data Pendapatan', array('controller' => 'incomes', 'action' => 'add'), array('class' => 'small success expand button'))?>
        </p>
        <h3 class="aturdoku-nav-subhead">Kategori</h3>
        <p>Klasifikasikan jenis pendapatan Anda.</p>
        <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'income')) ?>" class="small success expand button">Atur Kategori</a>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Ringkasan Singkat</h2>
        <h3 class="subheader">Isi kas Anda: <?php echo $this->Aturdoku->currencyFormat($totalIncomes - $totalExpenses); ?></h3>
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
                        <?php echo $this->Html->link('Edit', array('controller' => 'incomes','action' => 'edit', $income['Transaction']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                        <?php echo $this->Html->link('Hapus', array('controller' => 'incomes','action' => 'delete', $income['Transaction']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
                    </td>
                    
                </tr>
             <?php } ?>
            </tbody>
        </table>
        
                <a href="<?php echo Router::url(array('controller' => 'incomes', 'action' => 'index')) ?>" class="secondary expand button">Lihat Data Pendapatan Selengkapnya</a>
    </div>
    <p class="clearfix"></p>
    <div class="separator"></div>
    
    <!-- Aset -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-orange">ASET</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data Aset', array('controller' => 'assets', 'action' => 'add'), array('class' => 'small expand button'))?>
            <?php echo $this->Html->link('Export Data Aset', array('controller' => 'assets', 'action' => 'outputtopdf'), array('class' => 'secondary small expand button'))?>
        </p>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Data Aset Terkini</h2>
        
        <table>
        <thead>
            <tr>
                <th width="40">No.</th>
                <th width="150">Tahun</th>
                <th width="300">Nama Aset</th>
                <th width="150">Nilai</th>
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
                    <td>
                        <?php echo $this->Html->link('Edit', array('controller' => 'assets','action' => 'edit', $asset['Asset']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                        <?php echo $this->Html->link('Hapus', array('controller' => 'assets','action' => 'delete', $asset['Asset']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
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
        var line1=[
            <?php
                foreach ($dailyExpenses as $expense):
            ?>
                ['<?php echo $expense['transactions']['date'] ?>', <?php echo $expense[0]['total'] ?>],
            <?php
                endforeach;
            ?>
            
        ];
        
        var plot1 = $.jqplot('plot', [line1], {
            animate: true,
            axes:{
                xaxis:{
                    renderer:$.jqplot.DateAxisRenderer,
                    tickOptions:{
                        formatString:'%b&nbsp;%#d'
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
                background: "#FFFFFF"
            }
        });    
    });
</script>
