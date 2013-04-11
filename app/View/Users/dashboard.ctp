<div class="row">
    
    <?php echo $this->Element('user-navigation'); ?>
    
    <div class="large-5 columns">
        <h1 class="special-font">Selamat datang, User. :)</h1>
        <h3 class="subheader">Anda sedang berada di <em>Dashboard</em>.</h3>
    </div>
    <div class="large-7 columns">
        <h3 class="special-font aturdoku-bg-orange" align="center">Suguhan dari blog.aturdoku.com >></h3>
        <div class="large-6 columns aturdoku-news-box">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
                ultricies leo et erat vulputate ultricies. Phasellus id
                laoreet dolor. </p>
            <a class="small success button">Selengkapnya</a>
        </div>
        <div class="large-6 columns aturdoku-news-box">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
                ultricies leo et erat vulputate ultricies. Phasellus id
                laoreet dolor. </p>
            <a class="small success button">Selengkapnya</a>
        </div>
    </div>
    <div class="separator"></div>
    
    <!-- Pengeluaran -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">PENGELUARAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
        <a href="#" class="small alert expand button aturdoku-button" data-reveal-id="add-expense-data">Tambah Data</a>
        </p>
        <h3 class="aturdoku-nav-subhead">Kategori</h3>
        <p>Klasifikasikan jenis pengeluaran Anda. <a href="#">(Pelajari Selengkapnya)</a></p>
        <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'expense')) ?>" class="small secondary expand button aturdoku-button">Atur Kategori</a>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Fluktuasi Pengeluaran Minggu Ini</h2>
        <p style="margin: 0">Hari ini tanggal: <?php echo date('Y-m-d') ?></p>
        <div class="progress large-6 success" style="width: 100%;"><span class="meter" style="width: 30%"></span></div>
        <div id="plot"></div>
        <p>Rata-rata pengeluaran bulan ini: Rp ###.###,##</p>
        <p>Pengeluaran terbesar pada tanggal 2 April 2013 sejumlah: Rp ###.###,##</p>
        <a href="#" class="secondary expand button aturdoku-button">Lihat Laporan Selengkapnya >></a>
        
        <h2 class="special-font underline">Data Pengeluaran Terkini</h2>
        
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="150">Tanggal</th>
                    <th width="400">Deskripsi Pengeluaran</th>
                    <th width="150">Nominal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>7 April 2013</td>
                    <td>Belanja bulanan</td>
                    <td>Rp ###.###,##</td>
                </tr>
            </tbody>
        </table>  
    </div>
    <div class="separator"></div>
    
    <!-- Pemasukan -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-green">PEMASUKAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <a href="#" class="small success expand button">Tambah Data Pemasukan</a>
        </p>
        <h3 class="aturdoku-nav-subhead">Kategori</h3>
        <p>Klasifikasikan jenis pemasukan Anda. <a href="#">(Pelajari Selengkapnya)</a></p>
        <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'income')) ?>" class="small secondary expand button aturdoku-button">Atur Kategori</a>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Ringkasan Singkat</h2>
        <h3 class="subheader">Isi dompet Anda: Rp ###,###.##</h3>
        <h2 class="special-font underline">Data Pemasukan Terkini</h2>
        
        <table>
        <thead>
            <tr>
                <th width="40">No.</th>
                <th width="150">Tanggal</th>
                <th width="400">Nama Aset</th>
                <th width="150">Nilai</th>
            </tr>
        </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>8 April 2013</td>
                    <td><em>nama aset di sini</em></td>
                    <td>Rp ###.###,##</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="clearfix"></p>
    <div class="separator"></div>
    
    <!-- Aset -->
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-orange">ASET</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <a href="#" class="small secondary expand button" data-reveal-id="add-asset-data">Tambah Data Aset</a>
        </p>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Data Aset Terkini</h2>
        
        <table>
        <thead>
            <tr>
                <th width="40">No.</th>
                <th width="150">Tanggal</th>
                <th width="400">Nama Aset</th>
                <th width="150">Nilai</th>
            </tr>
        </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>8 April 2013</td>
                    <td><em>nama aset di sini</em></td>
                    <td>Rp ###.###,##</td>
                </tr>
            </tbody>
        </table>  
    </div>
    <div class="separator"></div>
</div>

<?php
    echo $this->Html->script("plugins/jqplot.highlighter.min");
    echo $this->Html->script("plugins/jqplot.cursor.min");
    echo $this->Html->script("plugins/jqplot.dateAxisRenderer.min");
    
    echo $this->Html->script('foundation/foundation');
    echo $this->Html->script('foundation/foundation.reveal');
?>

<script>
    $(document).foundation();
    $(document).ready(function(){
        var line1=[
            ['1-April-13', 54000],
            ['2-April-13', 238000],
            ['3-April-13', 70000],
            ['4-April-13', 59871],
            ['5-April-13', 34000],
            ['6-April-13', 120000],
            ['7-April-13', 41000],
        ];
        
        var plot1 = $.jqplot('plot', [line1], {
            animate: true,
            axes:{
                xaxis:{
                    renderer:$.jqplot.DateAxisRenderer,
                    tickOptions:{
                        formatString:'%b&nbsp;%#d'
                    } 
                },
                yaxis:{
                    tickOptions:{
                        formatString:'Rp %.2f'
                    }
                }
            },
            highlighter: {
                show: true,
                sizeAdjust: 7.5
            },
            cursor: {
                show: false
            },
            grid: {
                background: "#FFFFFF"
            }
        });    
    });
</script>

<!-- Modal Forms -->

<div id="add-expense-data" class="reveal-modal">
    <h2 class="special-font">Tambah Data Pengeluaran</h2>
    <p class="lead">Isi formulir di bawah ini untuk menambahkan data pengeluaran Anda.</p>
  
    <form action="" method="">
        <fieldset>
            <legend>Nominal dan Deskripsi</legend>
            <div class="row">
                <div class="large-4 columns">
                    <div class="row collapse">
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="text"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rupiah</span>
                        </div>
                    </div>
                    <label>Kategori</label>
                    <select class="medium">
                        <option value="#">Makanan</option>
                        <option value="#">Bahan Makanan</option>
                        <option value="#">Asuransi/Kesehatan</option>
                        <option value="#">Keperluan 1 Kali</option>
                    </select>
                </div>
                <div class="large-8 columns">
                    <label>Keperluan</label>
                    <textarea></textarea>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Waktu & Tempat</legend>
            <div class="row">
                <div class="large-4 columns">
                    <label>Tanggal (<em>Optional</em>)</label>
                    <input type="text"/>
                </div>
                <div class="large-8 columns">
                    <label>Tempat (<a href="#">Lacak dengan Google Maps</a>)</label>
                    <input type="text"/>
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
  
    <a class="close-reveal-modal">&#215;</a>
</div>

<div id="add-asset-data" class="reveal-modal">
    <h2 class="special-font">Tambah Data Aset</h2>
    <p class="lead">Isi formulir di bawah ini untuk menambahkan data aset Anda.</p>
  
    <form action="" method="">
        <fieldset>
            <legend>Nama dan Nilai</legend>
            <div class="row">
                <div class="large-8 columns">
                    <label>Nama Aset</label>
                    <input type="text"/>
                </div>
                <div class="large-4 columns">
                    <div class="row collapse">
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="text"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rupiah</span>
                        </div>
                    </div>
                    <label>Kategori</label>
                    <select class="medium">
                        <option value="#">Makanan</option>
                        <option value="#">Bahan Makanan</option>
                        <option value="#">Asuransi/Kesehatan</option>
                        <option value="#">Keperluan 1 Kali</option>
                    </select>
                </div>                
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
  
    <a class="close-reveal-modal">&#215;</a>
</div>