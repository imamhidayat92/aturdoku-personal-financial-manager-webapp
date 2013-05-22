<div class="row">
    
    <?php echo $this->Element('user-navigation'); ?>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">PENGELUARAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data', array('controller' => 'expenses', 'action' => 'add'), array('class' => 'small alert expand button aturdoku-button'))?>
   
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
                    <td><?php echo $expense['Transaction']['amount']?></td>
                    <td>
                        <?php echo $this->Html->link('Edit', array('action' => 'edit', $expense['Transaction']['id'])); ?>
                        <?php echo $this->Html->link('Hapus', array('action' => 'delete', $expense['Transaction']['id'])); ?>
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