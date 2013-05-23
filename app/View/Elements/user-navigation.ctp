<div class="large-1 columns">
    <?php echo $this->Html->image('black-logo.png'); ?>
</div>
<div class="large-11 columns">
    <div style="text-align: right; height: 35px; line-height: 35px; margin: 0 0 20px 0; line-height: 55px;">Halo <?php echo AuthComponent::user('first_name')?>! | <a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'logout'))?>">Keluar</a></div>
</div>