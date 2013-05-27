<div class="row">
    
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Data Pengeluaran</a></li>
        </ul>
    </div>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">PENGELUARAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data', array('controller' => 'expenses', 'action' => 'add'), array('class' => 'small alert expand button aturdoku-button'))?>
        </p>
        <h3 class="aturdoku-nav-subhead">Laporan Bulanan</h3>
        <form class="custom" action="" method="POST">
            <fieldset style="padding-bottom: 0;">
                <legend>Waktu Pengeluaran</legend>
                <div class="row">
                <div class="small-4 columns">
                    <label class="right inline">Bulan</label>
                </div>
                <div class="small-8 columns">
                    <select style="width: 100px;">
                        <option value="0">Januari</option>
                        <option value="1">Februari</option>
                        <option value="3">Maret</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="small-4 columns">
                    <label class="right inline">Tahun</label>
                </div>
                <div class="small-8 columns">
                    <input type="text" />
                </div>
            </div>
            </fieldset>
            <input type="submit" class="small alert expand button aturdoku-button" value="Lihat Laporan"/>
        </form>
        
        <h3 class="aturdoku-nav-subhead">Laporan Harian</h3>
        <a href="#" data-reveal-id="myModal" class="small success expand button">Lihat Laporan</a>
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