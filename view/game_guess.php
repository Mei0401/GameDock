<?php
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	    <link href="https://fonts.googleapis.com/css?family=Neucha" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Guess Game</title>
	</head>
	<body>
		<?php include('navbar.php');?>
		<main>
            <h2>Guess Game</h2>
			<form method="post">
                <div>Guess a number between 1 and 10.</div>
                
                <?php if ($_SESSION['guess']['ended'] === 0) { ?>
                <div>
                    <label for="guess">Your guess: </label>
                    <input type="number" id="guess" name="guess">
                    <input type="submit" name="submit" value="Guess!">
                </div>
                <?php } else { ?>
                    <div><input type="submit" name="submit" value="Start a new game"></div>
                <?php } ?>

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

