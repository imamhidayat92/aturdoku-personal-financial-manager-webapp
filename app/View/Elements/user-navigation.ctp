<div class="large-2 columns">
    <?php echo $this->Html->image('logo.png'); ?>
</div>
<div class="large-10 columns">
    <div style="text-align: right; height: 35px; line-height: 35px; margin: 0 0 20px 0; line-height: 77px;">Halo <?php echo AuthComponent::user('first_name')?>! | <a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'logout'))?>">Keluar</a></div>
</div>
<div class="separator"></div>