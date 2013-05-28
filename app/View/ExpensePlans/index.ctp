<div class="row">
    
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Rencana Pengeluaran</a></li>
        </ul>
    </div>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">RENCANA PENGELUARAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Buat Rencana', array('controller' => 'expenses', 'action' => 'add'), array('class' => 'small alert expand button aturdoku-button'))?>
        </p>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Data Pengeluaran Terkini</h2>
        
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="120">Tanggal</th>
                    <th width="300">Deskripsi Pendapatan</th>
                    <th width="150">Nominal</th>
                    <th width="130">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = ($this->Paginator->current($model = null)-1)*$itemPerPage; foreach ($expenses as $expense) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $expense['Transaction']['date']?></td>
                    <td><?php echo $expense['Transaction']['description']?></td>
                    <td><?php echo $this->Aturdoku->currencyFormat($expense['Transaction']['amount'])?></td>
                    <td>
                        <p align="center" style="margin: 0; padding: 0;">
                            <?php echo $this->Html->link('Ubah', array('controller' => 'expenses','action' => 'edit', $expense['Transaction']['id']), array('class' => 'tiny button secondary aturdoku-button')); ?>
                            <?php echo $this->Html->link('Hapus', array('controller' => 'expenses','action' => 'delete', $expense['Transaction']['id']), array('class' => 'tiny button alert aturdoku-button')); ?>
                        </p>
                    </td>
                    
                </tr>
             <?php } ?>
                <tr>
                    <td colspan="3"><strong>Total Pengeluaran:</strong></td>
                    <td>Rp Sekian</td>
                    <td></td>
                </tr>
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
    });
</script>