<div class="row">
    
    <?php echo $this->Element('user-navigation'); ?>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">PENGELUARAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <a href="expenses/add" class="small alert expand button aturdoku-button">Tambah Data</a> 
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
                <?php $nomor = 0; foreach ($expenses as $expense) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $expense['Expense']['date']?></td>
                    <td><?php echo $expense['Expense']['description']?></td>
                    <td><?php echo $expense['Expense']['amount']?></td>
                    <td>
                        <?php echo $this->Html->link('Edit', array('action' => 'edit', $expense['Expense']['id'])); ?>
                        <?php echo $this->Html->link('Hapus', array('action' => 'delete', $expense['Expense']['id'])); ?>
                    </td>
                    
                </tr>
             <?php } ?>
            </tbody>
        </table>
    </div>
</div>