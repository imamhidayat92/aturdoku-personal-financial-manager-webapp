<div class="row">
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Atur Kategori</a></li>
        </ul>
    </div>
    <div class="large-3 columns">
        <h1 class="aturdoku-nav-head aturdoku-bg-black">KATEGORI</h1>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <a href="#" class="small success expand button aturdoku-button" data-reveal-id="add-category-data">Tambah Kategori</a>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Daftar Seluruh Kategori Pemasukan</h2>
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="150">Nama</th>
                    <th width="400">Deskripsi</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Pemasukan Tetap</td>
                    <td>Pemasukan tetap (seperti gaji)</td>
                    <td style="text-align: center;">
                        <a href="#" class="small secondary button aturdoku-button">Edit</a>
                        <a href="#" class="small alert button aturdoku-button">Hapus</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Project</td>
                    <td>Pemasukan dari project</td>
                    <td  style="text-align: center;">
                        <a href="#" class="small secondary button aturdoku-button">Edit</a>
                        <a href="#" class="small alert button aturdoku-button">Hapus</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Forms -->
<div id="add-category-data" class="reveal-modal">
    <h2 class="special-font">Tambah Kategori</h2>
    <p class="lead">Isi formulir di bawah ini untuk menambahkan data kategori.</p>
  
    <form action="" method="">
        <fieldset>
            <legend>Detail Kategori</legend>
            <div class="row">
                <div class="large-6 columns">
                    <label>Nama Kategori</label>
                    <input type="text"/>
                    <label>Deskripsi</label>
                    <textarea></textarea>
                </div>              
                <div class="large-6 columnx">
                    <h3>Bantuan</h3>
                    <p>Kategori pengeluaran adalah fitur yang memudahkan Anda untuk mengklasifikasikan jenis pemasukan. Isikan
                    juga deskripsinya untuk menjelaskan detailnya.</p>
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Tambah Kategori"/>
    </form>
  
    <a class="close-reveal-modal">&#215;</a>
</div>

<?php  
    echo $this->Html->script('foundation/foundation');
    echo $this->Html->script('foundation/foundation.reveal');
?>

<script>
    $(document).foundation();
</script>