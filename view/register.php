<?php
// So I don't have to deal with unset $_REQUEST['user'] when refilling the form
// You can also take a look at the new ?? operator in PHP7

$_REQUEST['user']=!empty($_REQUEST['user']) ? $_REQUEST['user'] : '';
$_REQUEST['password']=!empty($_REQUEST['password']) ? $_REQUEST['password'] : '';
$_REQUEST['email']=!empty($_REQUEST['email']) ? $_REQUEST['email'] : '';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="slogin.css">
    </head>

<body>
    <!-- header -->
    <ul>
        <li>
        <?=$this->link('<img id="logo" src="logo.png" alt="logo" style="background-color: white;width: 80px;height: 60px;border:0; float: left;">','/user/login')?>
        </li>
        <li class="title">
            Create your game ID to start the new Adventure!
        </li>
    </ul>

    <!-- form -->
    <div align="center">
        <form method="post">
            <input type="text" name="user" placeholder="User ID" value="<?php echo($_REQUEST['user']); ?>" /><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="password" name="confirm" placeholder="Comfirm Password"><br>
            <input type="text" name="email" placeholder="E-mail Address" value="<?php echo($_REQUEST['email']); ?>" /><br>
            <div style="color:honeydew; font-size:25px"><?php echo(view_errors(@$this->errors)); ?></div><br>
            <input type="submit" name="submit" value="Register" style="padding: 10px 15px; background-color: #e3e3e3; color: black; font-weight: 500; font-size: 20px; margin-top: 20px; border-radius: 6px;"/>
        </form>
    </div>
	</body>
</html>

