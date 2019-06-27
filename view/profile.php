<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	    <link href="https://fonts.googleapis.com/css?family=Neucha" rel="stylesheet">   
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Profile</title>
	</head>
	<body>
		<?php include('navbar.php');?>
		<main>
			<h1>Profile</h1>
            <div><form method="post">
                <table>
					<!-- Trick below to re-fill the user form field -->
					<tr>
                        <th>
                            <label for="user">User</label>
                        </th>
                        <td>
                            <input disabled type="text" name="user" value="<?=$this->checkLogin()?>" />
                        </td>
                    </tr>
					<tr>
                        <th>
                            <label for="password">New Password</label>
                        </th>
                        <td> 
                            <input type="password" name="password" />
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="password">Confirm Password</label>
                        </th>
                        <td> 
                            <input type="password" name="confirm" />
                        </td>
                    </tr>
					<tr>
                        <th>&nbsp;</th>
                        <td>
                            <input type="submit" name="submit" value="Change Password" />
                            <input type="submit" name="submit" value="Delete Account" />
                        </td>
                    </tr>
					<tr>
                        <th>&nbsp;</th>
                        <td><?php echo(view_errors(@$this->errors)); ?></td>
                    </tr>
				</table>
                </form>
            </div>
		</main>
		<footer>
		</footer>
	</body>
</html>

