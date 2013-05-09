<div class="row">
    <div class="large-6 large-offset-3 columns">
        <form method="POST" action="<?php echo Router::url(array('controller' => 'users', 'action' => 'login')) ?>">
            <label>Username</label>
            <input type="text" name="data[User][username]"/>
            <label>Password</label>
            <input type="password" name="data[User][password]"/>
            <input type="submit" class="success button" value="Login"/>
        </form>
    </div>
</div>