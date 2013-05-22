<div class="row">
    <div class="large-4 columns large-offset-2">
        <?php echo $this->Form->create('User'); ?>
            <?php
                echo $this->Form->input('username', array('label' => 'Username'));
                echo $this->Form->input('password', array('label' => 'Password'));
                echo $this->Form->input('first_name', array('label' => 'Nama Depan'));
                echo $this->Form->input('last_name', array('label' => 'Nama Belakang'));
                echo $this->Form->input('email', array('label' => 'E-mail'));
            ?>
        <input type="submit" class="button success" value="Daftar"/>
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="large-4 columns">
        <h1 class="special-font" style="line-height: 1; font-size: 3em;"><span style="color: blue;">Aturdoku</span> membantu mengelola keuangan pribadi Anda.</h1>
        <p>Mulai gunakan aplikasi Aturdoku dengan mendaftarkan diri Anda di halaman ini.</p>
    </div>
    <div class="large-2 columns">
        
    </div>
</div>
