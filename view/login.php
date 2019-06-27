<?php
// So I don't have to deal with unset $_REQUEST['user'] when refilling the form
// You can also take a look at the new ?? operator in PHP7

$_REQUEST['user']=!empty($_REQUEST['user']) ? $_REQUEST['user'] : '';
$_REQUEST['password']=!empty($_REQUEST['password']) ? $_REQUEST['password'] : '';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="slog.css">
	</head>
<body>
	<!-- header -->
	<ul>
		<li>      
		<?=$this->link('<img id="logo" src="logo.png" alt="logo" style="background-color: white;width: 80px;height: 60px;border:0; float: left;">','/user/login')?>
        </li>
        <li class="title">
            Welcome to 404 not found Gaming!
        </li>
    </ul>
            
    <!-- rest -->
    <h2>Login Form</h2>

    <form method="post">

    	<div class="container">
    		<label for="user"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="user" value="<?php echo($_REQUEST['user']); ?>" />
    		<label for="password"><b>Password</b></label>
			<!-- <input type="password" placeholder="Enter Password" name="psw" required> -->
			<input type="password" placeholder="Enter Password" name="password" />
			<div style="color:red; font-size:35"><?php echo(view_errors(@$this->errors)); ?></div>
    		<p><?=$this->link("Don't have a account?", '/user/register')?></p>

    		<button type="submit" name="submit" value="login">Login</button>
    	</div>

    </form>

</body>
</html>

