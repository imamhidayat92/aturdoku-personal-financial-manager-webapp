<div class="row">
    <div class="large-4 columns large-offset-2">
        <?php echo $this->Form->create('User', array('id' => 'formID')); ?>
            <?php
                echo $this->Form->input('username', array('label' => 'Username', 'class' => 'validate[required] text-input'));
                echo $this->Form->input('password', array('label' => 'Password', 'class' => 'validate[required] text-input'));
                echo $this->Form->input('first_name', array('label' => 'Nama Depan', 'class' => 'validate[required] text-input'));
                echo $this->Form->input('last_name', array('label' => 'Nama Belakang', 'class' => 'validate[required] text-input'));
                echo $this->Form->input('email', array('label' => 'E-mail', 'class' => 'validate[required,custom[email]] text-input'));
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
<script>
    $(function(){
            // binds form submission and fields to the validation engine
        $('#formID').validationEngine();
    });
</script>