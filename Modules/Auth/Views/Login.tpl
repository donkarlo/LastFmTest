<form action = "<?php echo URL . "Auth/Login/Login" ; ?>" method = "POST">
    <table>

        <tr><td></td><td><?php echo $this->getVars (array("errors" , "wrong")) ; ?></td></tr>
        <tr><td></td><td><?php echo $this->getVars (array("errors" , "email") , 0) ; ?></td></tr>
        <tr><td></td><td></td></tr>
        <tr><td>آدرس الکترونیکی:</td><td><input name="email" type="text" value="<?php echo $this->getVars (array("data" , "email")) ; ?>" /></td></tr>

        <tr><td></td><td><?php echo $this->getVars (array("errors" , "password") , 0) ; ?></td></tr>
        <tr><td>پسورد:</td><td><input name="password" type="password" value="" /></td></tr>

        <tr><td></td><td><input name="submit" type="submit" value="ثبت" /></td></tr>
    </table>
</form>