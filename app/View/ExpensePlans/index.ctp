<script>
    var categories = new Array();
    var plans = new Array();
    var realization = new Array();          
</script>
<div class="row">
    
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Rencana Pengeluaran</a></li>
        </ul>
    </div>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">PENGELUARAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Buat Rencana Pengeluaran', array('controller' => 'expenseplans', 'action' => 'add'), array('class' => 'small alert expand button aturdoku-button'))?>
        </p>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Status Rencana Pengeluaran Bulan Ini</h2>
        <div id="chart3" style="width:600px"></div>
        <p>&nbsp;</p>
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="120">Kategori</th>
                    <th width="190">Rencana</th>
                    <th width="190">Realisasi</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plans as $plan): 
                          $amount = 0;
                          $planAmount = $plan['ExpensePlan']['amount'];
                ?>
                <tr>
                    <td><?php echo $plan['ExpensePlan']['id'] ?></td>
                    <td><?php echo $plan['Category']['name'] ?></td>
                    <td><?php echo $this->Aturdoku->currencyFormat($plan['ExpensePlan']['amount']) ?></td>
                    <td>
                        <?php 
                            foreach ($expenseCategories as $expenseCategory):
                                if ($plan['ExpensePlan']['category_id'] == $expenseCategory['categories']['id']):
                                    echo $this->Aturdoku->currencyFormat($expenseCategory[0]['total']);
                                    $amount = $expenseCategory[0]['total'];
                                endif;
                            endforeach;
                        ?>
                        <script>
                            categories.push('<?php echo $plan['Category']['name'] ?>');
                            realization.push(<?php echo $amount ?>);
                            plans.push(<?php echo $planAmount - $amount ?>);
                        </script>
                    </td>
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
                            <?php echo $this->Html->link('Ubah', array('controller' => 'expenseplans','action' => 'edit', $plan['ExpensePlan']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                            <?php echo $this->Html->link('Hapus', array('controller' => 'expenseplans','action' => 'delete', $plan['ExpensePlan']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
                        </p>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>        
        
        <h2 class="special-font underline">Rencana Pengeluaran Sebelumnya</h2>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(document).foundation();
        $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
          
          plot3 = $.jqplot('chart3', [realization, plans ], {
            // Tell the plot to stack the bars.
            stackSeries: true,
            captureRightClick: true,
            seriesDefaults:{
              renderer:$.jqplot.BarRenderer,
              rendererOptions: {
                  // Put a 30 pixel margin between bars.
                  barMargin: 30,
                  // Highlight bars when mouse button pressed.
                  // Disables default highlighting on mouse over.
                  highlightMouseDown: true   
              },
              pointLabels: {show: true}
            },
            series: [                
                {
                    label: 'Realisasi',
                    color: 'red'
                },
                {
                    label: 'Rencana',
                    color: 'greenyellow'
                }
            ],
            axes: {
              xaxis: {
                  renderer: $.jqplot.CategoryAxisRenderer,
                  ticks: categories
              },
              yaxis: {
                // Don't pad out the bottom of the data range.  By default,
                // axes scaled as if data extended 10% above and below the
                // actual range to prevent data points right on grid boundaries.
                // Don't want to do that here.
                min: 0,
                padMin: 0
              }
            },
            legend: {
              show: true,
              location: 'e',
              placement: 'outside'
            }      
          });
          // Bind a listener to the "jqplotDataClick" event.  Here, simply change
          // the text of the info3 element to show what series and ponit were
          // clicked along with the data for that point.
          $('#chart3').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
              $('#info3').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
          );
        
    });
</script>