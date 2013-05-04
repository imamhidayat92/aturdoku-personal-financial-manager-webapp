<div class="row">
    
    <div class="large-8 large-offset-2 columns">
        <h2 class="special-font">Tambah Data Pengeluaran</h2>
        <p class="lead">Isi formulir di bawah ini untuk menambahkan data pengeluaran Anda.</p>
        
        <!-- Form Tambah -->
        
        <form action="<?php echo Router::url(array('controller' => 'expenses', 'action' => 'add'))?>" method="POST">
        <fieldset>
            <legend>Nominal dan Deskripsi</legend>
            <div class="row">
                <div class="large-4 columns">
                    <div class="row collapse">
                        <label>Nominal</label>
                        <div class="large-9 columns">
                            <input type="text" name="data[Transaction][amount]"/>
                        </div>
                        <div class="large-3 columns">
                            <span class="postfix">Rupiah</span>
                        </div>
                    </div>
                    <label>Kategori</label>
                    <select class="medium">
                        <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $data['Category']['id']?>"><?php echo $data['Category']['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="large-8 columns">
                    <label>Keperluan</label>
                    <textarea name="data[Transaction][description]"></textarea>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Waktu & Tempat</legend>
            <div class="row">
                <div class="large-4 columns">
                    <label>Tanggal (<em>Optional</em>)</label>
                    <input type="text" name="data[Transaction][date]" id="datepicker"/>
                </div>
                <div class="large-8 columns">
                    <label>Tempat (<a href="#">Lacak dengan Google Maps</a>)</label>
                    <input type="text" name="data[Transaction][place]"/>
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
        
    </div>
    
</div>

<script>
    $(function() {
        $('#datepicker').datepicker();
    });
</script>