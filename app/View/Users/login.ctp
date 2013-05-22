<div class="row">
    <div class="large-12 columns">
        <ul class="breadcrumbs">
            <li><a href="<?php echo Router::url('/'); ?>">Home</a></li>
            <li><a href="#">Login</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-4 columns large-offset-4">
        <h1 class="special-font" style="line-height: 1; font-size: 3em;">Login</h1>
        <form method="POST" action="<?php echo Router::url(array('controller' => 'users', 'action' => 'login')) ?>">
            <label>Username</label>
            <input type="text" name="data[User][username]"/>
            <label>Password</label>
            <input type="password" name="data[User][password]"/>
            <input type="submit" class="success button" value="Login"/>
        </form>
    </div>
    <div class="large-4 columns">
        
    </div>
</div>