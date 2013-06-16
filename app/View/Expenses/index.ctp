<div class="row">
    <?php //echo $this->Aturdoku->printArray($monthlyExpense);?>
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Pengeluaran</a></li>
        </ul>
    </div>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">PENGELUARAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data', array('controller' => 'expenses', 'action' => 'add'), array('class' => 'small alert expand button aturdoku-button'))?>
        </p>
        <h3 class="aturdoku-nav-subhead">Laporan 3 Bulan Terakhir</h3>
        <p>
            <?php echo $this->Html->link('Lihat Laporan', array('controller' => 'expenses', 'action' => 'filter', 'month', '3'), array('class' => 'small success expand button aturdoku-button'))?>
        </p>
        <h3 class="aturdoku-nav-subhead">Laporan 6 Bulan Terakhir</h3>
        <p>
            <?php echo $this->Html->link('Lihat Laporan', array('controller' => 'expenses', 'action' => 'filter', 'month', '6'), array('class' => 'small success expand button aturdoku-button'))?>
        </p>
        <h3 class="aturdoku-nav-subhead">Laporan 1 Tahun Terakhir</h3>
        <p>
            <?php echo $this->Html->link('Lihat Laporan', array('controller' => 'expenses', 'action' => 'filter', 'month', '12'), array('class' => 'small success expand button aturdoku-button'))?>
        </p>
        <h3 class="aturdoku-nav-subhead">Laporan Harian</h3>
        <a href="#" data-reveal-id="myModal" class="small success expand button">Lihat Laporan</a>
    </div>
    <div class="large-9 columns">
        <div id="expense"></div>
        <h2 class="special-font underline">Data Pengeluaran Bulan Ini</h2>
        
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="200">Tanggal</th>
                    <th width="300">Total Pengeluaran</th>
                    <th width="200">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = ($this->Paginator->current($model = null)-1)*$itemPerPage; foreach ($dailyExpenses as $expense) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $expense['transactions']['date']?></td>                    
                    <td><?php echo $this->Aturdoku->currencyFormat($expense[0]['total'])?></td>
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
                            <?php 
                                $n = explode("-", $expense['transactions']['date']);
                            echo $this->Html->link('Lihat Detail', array('controller' => 'expenses', 'action' => 'detail', $n[0], $n[1], $n[2]), array('class' => 'tiny button secondary expand aturdoku-button')); ?>                            
                        </p>
                    </td>
                    
                </tr>
             <?php } ?>                
            </tbody>
        </table>
        
        <h2 class="special-font underline">Data Pengeluaran Lawas</h2>
        
        <form class="custom" action="<?php Router::url(array('controller' => 'expenses', 'action' => 'index'))?>" method="POST">
            <fieldset style="padding-bottom: 0;">
                <legend>Waktu Pengeluaran</legend>
                <div class="row">
                <div class="large-4 columns">
                    <div class="small-4 columns">
                        <label class="right inline">Bulan</label>
                    </div>
                    <div class="small-8 columns">
                        <select name="data[Transaction][month]" style="width: 100px;">

                            <?php 
                            $index = 1;
                            foreach ($this->Aturdoku->months as $month): ?>
                            <option value="<?php echo $index; $index++; ?>"><?php echo $month; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="large-4 columns">
                    <div class="small-4 columns">
                        <label class="right inline">Tahun</label>
                    </div>
                    <div class="small-8 columns">
                        <select name="data[Transaction][year]" style="width: 100px;">

                            <?php                             
                            foreach ($years as $year): ?>
                            <option value="<?php echo $year[0]['year']; ?>"><?php echo $year[0]['year']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="large-4 columns">
                    <input type="submit" class="small alert expand button aturdoku-button" value="Lihat Laporan"/>
                </div>
            </div>                                     
            </fieldset>            
        </form>
        
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="200">Bulan dan Tahun</th>                    
                    <th width="300">Total Pengeluaran</th>
                    <th width="200">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = ($this->Paginator->current($model = null)-1)*$itemPerPage; foreach ($monthlyExpense as $expense) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $this->Aturdoku->printBarGraphDateInfo($expense[0]['time'])?></td>                    
                    <td><?php echo $this->Aturdoku->currencyFormat($expense[0]['total'])?></td>
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
                            <?php echo $this->Html->link('Lihat Detail', array('controller' => 'expenses', 'action' => 'daily', $expense[0]['year'], $expense[0]['month'] ), array('class' => 'tiny button secondary expand aturdoku-button')); ?>                            
                        </p>
                    </td>
                    
                </tr>
             <?php } ?>                
            </tbody>
        </table>
        
        <p align="center"><?php echo $this->Paginator->numbers(); ?></p>
        
    </div>
</div>
<div id="myModal" class="reveal-modal">
    <form class="custom" action="<?php echo Router::url(array('controller' => 'expenses', 'action' => 'add'))?>" method="POST">
        <fieldset>
            <legend>Rentang Waktu</legend>
            <div class="row">
                <div class="large-1 columns">
                    <label class="right inline">Dari</label>                   
                </div>
                <div class="large-3 columns">
                    <input type="text" name="" class="datepicker"/>
                </div>
                <div class="large-1 columns">
                    <label class="right inline">Sampai</label>
                </div>
                <div class="large-3 columns">                   
                    <input type="text" name="" class="datepicker"/>
                </div>
                <div class="large-4 columns">
                    
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
    <a class="close-reveal-modal">&#215;</a>
</div>
<script>
    $(document).ready(function(){
        $(document).foundation();
        $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
        
        var barValue = [
            <?php 
                foreach ($monthlyExpenseGraph as $expense):
                    echo $expense[0]['total']." ,";
                endforeach;
            ?>
        ];
        var barInfo = [
            <?php 
                foreach ($monthlyExpenseGraph as $expense):
                    echo "'".$this->Aturdoku->printBarGraphDateInfo($expense[0]['time'])."',";
                endforeach;
            ?>
        ];
        
        var plot1 = $.jqplot('expense', [barValue], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: false },
                color: 'red'
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
        
    });
</script>