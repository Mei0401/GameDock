<?php
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	    <link href="https://fonts.googleapis.com/css?family=Neucha" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Frogs</title>
        <style>
        .btn { 
            width: 5rem;
            height: 5rem;
            cursor: pointer;
            display: block;
            font-size: 0;
            line-height: 0;
            text-indent: -9999px;
        }
        .btn--1 {
            background: url(http://www.cs.toronto.edu/~arnold/309/19s/lectures/javascript/frogs/greenFrog.gif) no-repeat center;
            background-size: cover;
        }
        .btn-1 {
            background: url(http://www.cs.toronto.edu/~arnold/309/19s/lectures/javascript/frogs/yellowFrog.gif) no-repeat center;
            background-size: cover;
        }
        </style>
	</head>
	<body>
		<?php include('navbar.php');?>
		<main>
            <h2>The Frog Puzzle</h2>
			<form method="post">
                <p><input type="submit" name="submit" value="Restart"></p>
                <table border="0">
                    <tr>
                    <?php foreach ($this->board as $i => $b) { ?>
                        <td>
                            <input class="btn btn-<?=$b?>"
                                <?php if ($b != 0) { ?>type="submit" name="submit"
                                        value="<?=$i?>"
                                <?php } 
                                    if ($this->status['ended'] != 0) echo 'disabled';
                                ?>>
                        </td>
                    <?php } ?>
                    </tr>
                </table>
                <div>
                <?php if ($this->status['ended'] === 1) echo '<h2>You made it!</h2>'; 
                    else if ($this->status['ended'] === -1) echo '<h2>You are out of moves.</h2>'
                ?>
                </div>
            </form>
		</main>
		<footer>
		</footer>
	</body>
</html>

