<?php
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	    <link href="https://fonts.googleapis.com/css?family=Neucha" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>The 15 Puzzle</title>
        <style>
        .btn-board {
            width: 2em;
            height: 2em;
            font-size: 2em;
            font-weight: bold;
        }
        </style>
	</head>
	<body>
		<?php include('navbar.php');?>
		<main>
            <h2>The 15 Puzzle</h2>
			<form method="post">
                <p><input type="submit" name="submit" value="Restart"></p>
                <table border="1">
                <?php for ($i = 0; $i < 4; ++$i) { ?>
                    <tr>
                    <?php for ($j = 0; $j < 4; ++$j) { ?>
                        <td>
                        <?php if ($this->board[$i*4+$j] != 0) { ?>
                            <input class="btn-board" 
                                    type="submit" name="submit" 
                                    value="<?=$this->board[$i*4+$j]?>"
                                    <?php if ($this->status['ended']) echo 'disabled';?>
                                    >
                            </td>
                        <?php } else echo '&nbsp;'; ?>
                    <?php } ?>
                    </tr>
                <?php } ?>
                </table>
                <div><?php if ($this->status['ended']) echo '<h2>You win!</h2>'; ?></div>
            </form>
		</main>
		<footer>
		</footer>
	</body>
</html>

