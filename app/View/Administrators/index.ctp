<div class="row">    
    <?php echo $this->Element('user-navigation'); ?>
</div>
<p>&nbsp;</p>
<div class="row">
    <div class="large-12 columns">
        <h1 class="special-font">Halaman Administrator Aturdoku</h1>
    </div>
    
    <!-- Pengeluaran -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">ANGGOTA</h2>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Daftar Anggota</h2>
        <table>
            <thead>
                <tr>
                    <th width="150">Username</th>
                    <th width="150">Login Terakhir</th>
                    <th width="150">Nama Depan</th>
                    <th width="150">Nama Belakang</th>
                    <th width="100">Aktifkan?</th>
                    <th width="300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 0; foreach ($users as $user) { ?>
                <tr>
                    <?php $nomor++; ?>
                    <td><?php echo $user['User']['username']?></td>
                    <td><?php if ($user['User']['last_login'] == null) echo "<span class='label alert'>Belum Pernah</span>"; else echo $user['User']['last_login'];?></td>        
                    <td><?php echo $user['User']['first_name']; ?></td>
                    <td><?php echo $user['User']['last_name']; ?></td>
                    <td><a href="<?php echo Router::url(array('action' => 'toggleActivateDeactivate', $user['User']['id'])) ?>" class="button <?php if ($user['User']['is_active']) echo "alert"; else echo "success"; ?> small aturdoku-button"><?php if ($user['User']['is_active']) echo "Matikan"; else echo "Aktifkan"; ?></a></td>   
                    <td>
                        <a href="<?php Router::url(array('controller' => 'users', 'action' => 'delete', $user['User']['id'])) ?>" class="button alert small aturdoku-button">Hapus</a>
                    </td>
                </tr>
             <?php } ?>
            </tbody>
        </table>
        
        <p align="center"><?php echo $this->Paginator->numbers(); ?></p>
    </div>
</div>