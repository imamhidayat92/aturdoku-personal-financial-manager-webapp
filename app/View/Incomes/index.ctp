<div class="row">
    
    <?php echo $this->Element('user-navigation'); ?>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-green">PENDAPATAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <a href="#" class="small success expand button">Tambah Data</a> 
        </p>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Data Pendapatan Terkini</h2>
        
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="150">Tanggal</th>
                    <th width="400">Deskripsi Pendapatan</th>
                    <th width="150">Nominal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 0; foreach ($incomes as $income) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $income['Income']['date']?></td>
                    <td><?php echo $income['Income']['description']?></td>
                    <td><?php echo $income['Income']['amount']?></td>
                    <td>
                        <?php echo $this->Html->link('Edit', array('action' => 'edit', $income['Income']['id'])); ?>
                    </td>
                    
                </tr>
             <?php } ?>
            </tbody>
        </table>
    </div>
</div>