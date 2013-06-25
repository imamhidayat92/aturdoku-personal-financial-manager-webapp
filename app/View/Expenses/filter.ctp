<div class="row">    
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'expenses', 'action' => 'index')) ?>">Pengeluaran</a></li>
            <li><a href="#">Detail Pengeluaran</a></li>
        </ul>
    </div>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">PENGELUARAN</h2>                                        
    </div>
    <div class="large-9 columns">    
        <div id="filterGraph"></div>
        <h2 class="special-font underline">Data Pengeluaran <?php echo $number?> Bulan Ini</h2>
        
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
                <?php $nomor = 0; foreach ($filteredExpenses as $expense) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $this->Aturdoku->printBarGraphDateInfo($expense[0]['time'])?></td>                    
                    <td><?php echo $this->Aturdoku->currencyFormat($expense[0]['total'])?></td>
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
                            <?php
                                $n = explode("-", $expense[0]['time']);
                                echo $this->Html->link('Lihat Detail', array('controller' => 'expenses', 'action' => 'daily', $n[1], $n[0] ), array('class' => 'tiny button secondary expand aturdoku-button')); 
                            ?>                            
                        </p>
                    </td>
                    
                </tr>
             <?php } ?>                
            </tbody>
        </table>
        <h2 class="special-font underline">Pengeluaran Berdasarkan Kategori</h2>
        <div class="row">
            <div class="large-8 columns">
                <div id="expenseCategory"></div>
            </div>             
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var barValue = [
            <?php 
                $currentYear = date('Y');
                $currentMonth = date('m');
                
                $startYear = $currentYear;
                $startMonth = $currentMonth - $number + 1;
                if ($startMonth <= 0) {
                    $startYear--;
                    $startMonth += 12;
                }
                
                for ($i = 0; $i < $number; $i++) {
                    $currentTime = "";
                    if ($startMonth + $i > 12) {
                        $tmp = ($startMonth + $i) % 12;
                        $currentTime = $tmp . "-" . ($startYear + 1);
                    }
                    else {
                        $currentTime = ($startMonth + $i) . "-" . $startYear;
                    }
                                        
                    $found = false;
                    foreach ($filteredExpenses as $expense) {
                        if (strcmp($expense[0]['time'], $currentTime) == 0) {
                            $found = true;
                            echo $expense[0]['total'] . ", ";
                        }
                    }                   
                    
                    if (!$found) echo "0, ";
                }
                    
            ?>
        ];
        var barInfo = [
            <?php 
                for ($i = 0; $i < $number; $i++):
                    $currentTime = "";
                    if ($startMonth + $i > 12) {
                        $tmp = ($startMonth + $i) % 12;
                        $currentTime = $tmp . "-" . ($startYear + 1);
                    }
                    else {
                        $currentTime = ($startMonth + $i) . "-" . $startYear;
                    }
                    echo "'" . $currentTime . "', ";
                endfor;
            ?>
        ];
        
        var plot1 = $.jqplot('filterGraph', [barValue], {
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
        
        var dataExpense = [
            <?php
                foreach ($expensesCategoryGraph as $category):
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
        
    });
</script>