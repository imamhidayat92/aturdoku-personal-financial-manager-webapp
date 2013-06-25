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
        <div id="chart3" style="width:720px"></div>
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="120">Kategori</th>
                    <th width="580">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plans as $plan): ?>
                <tr>
                    <td><?php echo $plan['ExpensePlan']['id'] ?></td>
                    <td><?php echo $plan['Category']['name'] ?></td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td>1</td>
                    <td><em><a href="#">Category Name</a></em></td>
                    <td>
                        <div class="progress">
                            <span class="meter" style="width: 30%; float: left; background-color: red;"></span>
                            <span class="meter" style="width: 70%; float: left; background-color: greenyellow"></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><em><a href="#">Category Name</a></em></td>
                    <td>
                        <div class="progress">
                            <span class="meter" style="width: 40%; float: left; background-color: red;"></span>
                            <span class="meter" style="width: 60%; float: left; background-color: greenyellow"></span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>        
        
        <h2 class="special-font underline">Rencana Pengeluaran Sebelumnya</h2>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(document).foundation();
        $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
        
          var s1 = [2, 6, 7, 10];
          var s2 = [7, 5, 3, 4];          
          plot3 = $.jqplot('chart3', [s1, s2], {
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
                    label: 'Rencana',
                    color: 'greenyellow'
                },
                {
                    label: 'Realisasi',
                    color: 'red'
                }
            ],
            axes: {
              xaxis: {
                  renderer: $.jqplot.CategoryAxisRenderer
              },
              yaxis: {
                // Don't pad out the bottom of the data range.  By default,
                // axes scaled as if data extended 10% above and below the
                // actual range to prevent data points right on grid boundaries.
                // Don't want to do that here.
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