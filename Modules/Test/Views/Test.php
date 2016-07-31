< ! DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8" />
        <title>فرم ثبت نام</title>
    </head>
    <body>
        <form action = "../Controllers/Signup.php" method = "POST">
            <table>
                <tr><td>نام:</td><td><input name = "fname" type = "text" value = "<?php echo $this->getFormFieldsDfltValsMappedOnNames ("fname") ; ?>" /></td></tr>
                <tr><td>نام خانوادگی:</td><td><input name = "lname" type = "text" value = "<?php echo $this->getFormFieldsDfltValsMappedOnNames ("lname") ; ?>" /></td></tr>

                <tr><td></td><td style = "color: red;"><?php echo $this->getErrStrByFieldNameAndErrName ("email" , "notValid") ;
?></td></tr>
                <tr><td></td><td style="color: red;"><?php echo $this->getErrStrByFieldNameAndErrName ("email" , "alreadyExists") ; ?></td></tr>
                <tr><td>آدرس الکترونیکی:</td><td><input name="email" type="text" value="<?php echo $this->getFormFieldsDfltValsMappedOnNames ("email") ; ?>" /></td></tr>

                <tr><td></td><td style="color: red;"><?php echo $this->getErrStrByFieldNameAndErrName ("password" , "length") ; ?></td></tr>
                <tr><td>پسورد:</td><td><input name="password" type="password" value="" /></td></tr>

                <tr><td></td><td style="color: red;"><?php echo $this->getErrStrByFieldNameAndErrName ("rpassword" , "notEqual") ; ?></td></tr>
                <tr><td>پسورد-مجدد:</td><td><input name="rpassword" type="password" value="" /></td></tr>

                <tr><td></td><td><input name="submit" type="submit" value="ثبت" /></td></tr>
            </table>
        </form>
    </body>
</html>