<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Data Aset</a></li>
        </ul>
    </div>
    <div class="large-3 columns">
        <h1 class="aturdoku-nav-head aturdoku-bg-orange">ASET</h1>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Tambah Data', array('controller' => 'assets', 'action' => 'add'), array('class' => 'small secondary expand button aturdoku-button'))?>
        </p>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Data Aset Lengkap</h2>
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="150">Tahun</th>
                    <th width="300">Nama Aset</th>
                    <th width="150">Nilai</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 0; foreach ($assets as $asset) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $asset['Asset']['year']?></td>
                    <td><?php echo $asset['Asset']['name']?></td>
                    <td><?php echo $asset['Asset']['value']?></td>
                    <td>
                        <?php echo $this->Html->link('Edit', array('action' => 'edit', $asset['Asset']['id'])); ?>
                        <?php echo $this->Html->link('Hapus', array('action' => 'delete', $asset['Asset']['id'])); ?>
                    </td>
                    
                </tr>
             <?php } ?>
            </tbody>
        </table>
    </div>
</div>