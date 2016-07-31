<form action = "<?php echo URL . "Auth/Signup/Modify" ; ?>" method = "POST">
    <table>
        <tr><td></td><td><?php echo $this->getVars (array("errors" , "fname") , 0) ; ?></td></tr>
        <tr><td>نام:</td><td><input name = "fname" type = "text" value = "<?php echo $this->getVars (array("data" , "fname")) ; ?>" /></td></tr>

        <tr><td></td><td><?php echo $this->getVars (array("errors" , "lname") , 0) ; ?></td></tr>
        <tr><td>نام خانوادگی:</td><td><input name = "lname" type = "text" value = "<?php echo $this->getVars (array("data" , "lname")) ; ?>" /></td></tr>

        <tr><td></td><td><?php echo $this->getVars (array("errors" , "email") , 0) ; ?></td></tr>
        <tr><td></td><td></td></tr>
        <tr><td>آدرس الکترونیکی:</td><td><input name="email" type="text" value="<?php echo $this->getVars (array("data" , "email")) ; ?>" /></td></tr>

        <tr><td></td><td><?php echo $this->getVars (array("errors" , "password") , 0) ; ?></td></tr>
        <tr><td>پسورد:</td><td><input name="password" type="password" value="" /></td></tr>

        <tr><td></td><td><?php echo $this->getVars (array("errors" , "rPassword") , 0) ; ?></td></tr>
        <tr><td>پسورد-مجدد:</td><td><input name="rPassword" type="password" value="" /></td></tr>

        <tr><td></td><td><input name="submit" type="submit" value="ثبت" /></td></tr>
    </table>
</form>