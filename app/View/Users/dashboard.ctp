<pre>
<?php //print_r($totalIncomes) ?>
</pre>

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
    
    <div class="large-5 columns">
        <h1 class="special-font">Selamat datang, User. :)</h1>
        <h3 class="subheader">Anda sedang berada di <em>Dashboard</em>.</h3>
    </div>
    <div class="large-7 columns">
        <h3 class="special-font aturdoku-bg-orange" align="center">Suguhan dari blog.aturdoku.com >></h3>
        <div class="large-6 columns aturdoku-news-box">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
                ultricies leo et erat vulputate ultricies. Phasellus id
                laoreet dolor. </p>
            <a class="small success button">Selengkapnya</a>
        </div>
        <div class="large-6 columns aturdoku-news-box">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
                ultricies leo et erat vulputate ultricies. Phasellus id
                laoreet dolor. </p>
            <a class="small success button">Selengkapnya</a>
        </div>
    </div>
    <div class="separator"></div>
    
    <!-- Pengeluaran -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">PENGELUARAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data Pengeluaran', array('controller' => 'expenses', 'action' => 'add'), array('class' => 'small alert expand button aturdoku-button'))?>
        </p>
        <h3 class="aturdoku-nav-subhead">Kategori</h3>
        <p>Klasifikasikan jenis pengeluaran Anda. <a href="#">(Pelajari Selengkapnya)</a></p>
        <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'expense')) ?>" class="small secondary expand button aturdoku-button">Atur Kategori</a>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Fluktuasi Pengeluaran Minggu Ini</h2>
        <?php echo $this->Aturdoku->print_date_progress(); ?>
        <div id="plot"></div>
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
        <p>Pengeluaran terbesar pada tanggal <?php echo $this->Aturdoku->getGraphDateFormat($maxExpense['Transaction']['date']) ?> sejumlah: <?php echo $this->Aturdoku->currencyFormat($maxExpense['Transaction']['amount']); ?></p>
        <?php echo $this->Html->link('Lihat Laporan Pengeluaran Selengkapnya', array('controller' => 'expenses', 'action' => 'index'), array('class' => 'secondary expand button aturdoku-button'))?>
        
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
    </div>
    <div class="separator"></div>
    
    <!-- Pemasukan -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-green">PENDAPATAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data Pemasukan', array('controller' => 'incomes', 'action' => 'add'), array('class' => 'small success expand button'))?>
        </p>
        <h3 class="aturdoku-nav-subhead">Kategori</h3>
        <p>Klasifikasikan jenis pemasukan Anda. <a href="#">(Pelajari Selengkapnya)</a></p>
        <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'income')) ?>" class="small secondary expand button">Atur Kategori</a>
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
    </div>
    <p class="clearfix"></p>
    <div class="separator"></div>
    
    <!-- Aset -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-orange">ASET</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data Aset', array('controller' => 'assets', 'action' => 'add'), array('class' => 'small secondary expand button'))?>
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
                ['<?php echo $this->Aturdoku->getGraphDateFormat($expense['transactions']['date']) ?>', <?php echo $expense[0]['total'] ?>],
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

<!-- Modal Forms -->

<div id="add-expense-data" class="reveal-modal">
    <h2 class="special-font">Tambah Data Pengeluaran</h2>
    <p class="lead">Isi formulir di bawah ini untuk menambahkan data pengeluaran Anda.</p>
  
    <form action="" method="">
        <fieldset>
            <legend>Nominal dan Deskripsi</legend>
            <div class="row">
                <div class="large-4 columns">
                    <div class="row collapse">
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="text"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rupiah</span>
                        </div>
                    </div>
                    <label>Kategori</label>
                    <select class="medium">
                        <option value="#">Makanan</option>
                        <option value="#">Bahan Makanan</option>
                        <option value="#">Asuransi/Kesehatan</option>
                        <option value="#">Keperluan 1 Kali</option>
                    </select>
                </div>
                <div class="large-8 columns">
                    <label>Keperluan</label>
                    <textarea></textarea>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Waktu & Tempat</legend>
            <div class="row">
                <div class="large-4 columns">
                    <label>Tanggal (<em>Optional</em>)</label>
                    <input type="text"/>
                </div>
                <div class="large-8 columns">
                    <label>Tempat (<a href="#">Lacak dengan Google Maps</a>)</label>
                    <input type="text"/>
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
  
    <a class="close-reveal-modal">&#215;</a>
</div>

<div id="add-asset-data" class="reveal-modal">
    <h2 class="special-font">Tambah Data Aset</h2>
    <p class="lead">Isi formulir di bawah ini untuk menambahkan data aset Anda.</p>
  
    <form action="" method="">
        <fieldset>
            <legend>Nama dan Nilai</legend>
            <div class="row">
                <div class="large-8 columns">
                    <label>Nama Aset</label>
                    <input type="text"/>
                </div>
                <div class="large-4 columns">
                    <div class="row collapse">
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="text"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rupiah</span>
                        </div>
                    </div>
                    <label>Kategori</label>
                    <select class="medium">
                        <option value="#">Makanan</option>
                        <option value="#">Bahan Makanan</option>
                        <option value="#">Asuransi/Kesehatan</option>
                        <option value="#">Keperluan 1 Kali</option>
                    </select>
                </div>                
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
  
    <a class="close-reveal-modal">&#215;</a>
</div>