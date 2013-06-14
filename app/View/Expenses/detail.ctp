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
        <h2 class="special-font underline">Data Pengeluaran Hari Ini</h2>
        
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
                <?php $nomor = 0; foreach ($expenses as $expense) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $expense['Transaction']['date']?></td>
                    <td><?php echo $expense['Transaction']['description']?></td>
                    <td><?php echo $this->Aturdoku->currencyFormat($expense['Transaction']['amount'])?></td>
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
                            <?php echo $this->Html->link('Ubah', array('controller' => 'expenses', 'action' => 'edit', $expense['Transaction']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                            <?php echo $this->Html->link('Hapus', array('controller' => 'expenses', 'action' => 'delete', $expense['Transaction']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>                            
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
        $(document).foundation();

        var dataExpense = [
            <?php
                foreach ($detailExpensesCategoryGraph as $category):
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