<div class="row">
    
    <?php echo $this->Element('user-navigation'); ?>
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a></li>
            <li><a href="#">Rencana Pengeluaran</a></li>
        </ul>
    </div>
    
    <div class="large-3 columns">
        <h2 class="aturdoku-nav-head aturdoku-bg-red">PENGELUARAN</h2>
        <h3 class="aturdoku-nav-subhead">Aksi Utama</h3>
        <p>
            <?php echo $this->Html->link('Buat Rencana Pengeluaran', array('controller' => 'expenseplans', 'action' => 'add'), array('class' => 'small alert expand button aturdoku-button'))?>
        </p>
    </div>
    <div class="large-9 columns">
        <h2 class="special-font underline">Status Rencana Pengeluaran Bulan Ini</h2>
        
        <table>
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th width="120">Kategori</th>
                    <th width="580">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plans as $plan): ?>
                <tr>
                    <td><?php echo $plan['ExpensePlan']['id'] ?></td>
                    <td><?php echo $plan['Category']['name'] ?></td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td>1</td>
                    <td><em><a href="#">Category Name</a></em></td>
                    <td>
                        <div class="progress">
                            <span class="meter" style="width: 30%; float: left; background-color: red;"></span>
                            <span class="meter" style="width: 70%; float: left; background-color: greenyellow"></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><em><a href="#">Category Name</a></em></td>
                    <td>
                        <div class="progress">
                            <span class="meter" style="width: 40%; float: left; background-color: red;"></span>
                            <span class="meter" style="width: 60%; float: left; background-color: greenyellow"></span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>        
        
        <h2 class="special-font underline">Rencana Pengeluaran Sebelumnya</h2>
    </div>
</div>
<div id="myModal" class="reveal-modal">
    <form class="custom" action="<?php echo Router::url(array('controller' => 'expenses', 'action' => 'add'))?>" method="POST">
        <fieldset>
            <legend>Rentang Waktu</legend>
            <div class="row">
                <div class="large-1 columns">
                    <label class="right inline">Dari</label>                   
                </div>
                <div class="large-3 columns">
                    <input type="text" name="" class="datepicker"/>
                </div>
                <div class="large-1 columns">
                    <label class="right inline">Sampai</label>
                </div>
                <div class="large-3 columns">                   
                    <input type="text" name="" class="datepicker"/>
                </div>
                <div class="large-4 columns">
                    
                </div>
            </div>
        </fieldset>
        <input type="submit" class="success button" value="Simpan Data"/>
    </form>
    <a class="close-reveal-modal">&#215;</a>
</div>
<script>
    $(document).ready(function(){
        $(document).foundation();
        $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>