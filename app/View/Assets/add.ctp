<div class="row">
    
    <div class="large-8 large-offset-2 columns">
        <h2 class="special-font">Tambah Data Aset</h2>
        <p class="lead">Isi formulir di bawah ini untuk menambahkan data aset Anda.</p>
        
        <!-- Form Tambah -->
        
        <form action="<?php echo Router::url(array('controller' => 'assets', 'action' => 'add'))?>" method="POST">
        <fieldset>
            <legend>Data Aset</legend>
            <div class="row">
                <div class="large-4 columns">
                    <div class="row collapse">
                        <label>Nilai</label>
                        <div class="large-9 columns">
                            <input type="text" name="data[Asset][value]"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rupiah</span>
                        </div>
                    </div>
                  <label>Tahun</label>
                    <input type="text" name="data[Asset][year]"/>
                </div>
                <div class="large-8 columns">
                    <label>Nama Aset</label>
                    <input type="text" name="data[Asset][name]" />
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
    </div>
   
</div>