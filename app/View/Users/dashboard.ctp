<div class="row">
    
    <div class="large-12 columns">
        <nav class="top-bar">
            <ul class="title-area">
                <li class="name">
                    <h1><a href="#">Aturdoku.com</a></h1>
                </li>
            </ul>
            <section class="top-bar-section">
                <ul class="right">
                    <li class="has-dropdown"><a href="#">Halo User!</a>
                        <ul class="dropdown">
                            <li><a href="#">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </section>            
        </nav>
    </div>
    <div class="large-5 columns">
        <h1 class="special-font">Selamat datang, User. :)</h1>
    </div>
    <div class="large-7 columns">
        <div class="large-6 columns aturdoku-news-box">
            <h1>Judul Tulisan #1</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
                ultricies leo et erat vulputate ultricies. Phasellus id
                laoreet dolor. </p>
            <a class="small success button">Selengkapnya</a>
        </div>
    </div>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">PENGELUARAN</h2>
        <p>Aksi:
        <a href="#" class="small alert expand button" data-reveal-id="add-expense-data">Tambah Data</a>
        <a href="#" class="small secondary expand button">Lihat Laporan</a>
        </p>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Fluktuasi Pengeluaran</h2>
        <p style="margin: 0">Hari ini tanggal: <?php echo date('Y-m-d') ?></p>
        <div class="progress large-6 success" style="width: 100%;"><span class="meter" style="width: 30%"></span></div>
        <div id="plot">
            
        </div>
        <h2 class="special-font underline">Ringkasan Singkat</h2>
        <p></p>
    </div>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-green">PEMASUKAN</h2>
        <p>Aksi: <a href="#" class="small secondary expand button">Tambah Data</a></p>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Ringkasan Singkat</h2>
        <p></p>
    </div>
    
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
                    <label>Nominal</label>
                    <input type="text"/>
                    <label>Tags</label>
                    <input type="text"/>
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