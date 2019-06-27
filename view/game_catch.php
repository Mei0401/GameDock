<?php
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	    <link href="https://fonts.googleapis.com/css?family=Neucha" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Catch Time</title>
	</head>
	<body>
		<?php include('navbar.php');?>
		<main>
            <h2>Catch Time</h2>

                <form method="post">
                <?php if ($_SESSION['catch']['state'] === 0) { ?>
                    <!-- number setting -->
                    <div>
                        <label for="guess">How many seconds do you want to try to catch?</label>
                        <input type="number" id="timeInterval" name="timeInterval">
                        <input type="submit" name="submit" value="Set Time">
                    </div>
                    
                <?php } else { ?>
                    <?php if ($_SESSION['catch']['state'] === 2) { ?>
                        <!-- result and restart -->
                        <div><input type="submit" name="submit" value="Start a new game"></div>
                        <?php } else { ?>
                            <!-- game pannel -->
                            <div><input type="submit" name="submit" value="This is the time!!"></div>
                <?php } }?>

                <div id="messages">
                    <?php
                        echo(view_errors(@$this->errors));
                        echo view_errors(@$this->message);
                    ?>
                </div>

            </form>
		</main>
		<footer>
		</footer>
	</body>
</html>

