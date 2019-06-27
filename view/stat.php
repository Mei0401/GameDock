<?php
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	    <link href="https://fonts.googleapis.com/css?family=Neucha" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Game Stats</title>
	</head>
	<body>
		<?php include('navbar.php');?>
		<main>
			<h1>Game Stats</h1>
            <div>
                <h2>Guess Game</h2>
                <?php if (empty($this->stat['guess'])) echo '<div>No records</div>'; ?>
                <!-- <ol> -->
                <?php foreach ($this->stat['guess'] as $r) { ?>
                    <!-- <li> -->
                        <div>
                            Start Time: <?=$r['starttime']?><br/>
                            Time Used: <?=$this->pluralize(strtotime($r['endtime'])-strtotime($r['starttime']), 'seconds|second')?> 
                            <br/>
                            You have guessed <?=$this->pluralize($r['result'], 'times|time')?> and the answer was <?=$r['ans']?>.<br/>
                        <br/>
                        </div>
                    <!-- </li> -->
                <?php } ?>
                <!-- </ol> -->
            </div>
            <div>
                <h2>The 15 Puzzle</h2>
                <?php if (empty($this->stat['fifteen'])) echo '<div>No records</div>'; ?>
                <!-- <ol> -->
                <?php foreach ($this->stat['fifteen'] as $r) { ?>
                    <!-- <li> -->
                        <div>
                            Start Time: <?=$r['starttime']?><br/>
                            Time Used: <?=$this->pluralize(strtotime($r['endtime'])-strtotime($r['starttime']), 'seconds|second')?> 
                            <br/>
                            You have made <?=$this->pluralize($r['result'], 'moves|move')?> to solve The 15 Puzzle.<br/>
                            <br/>
                        </div>
                    <!-- </li> -->
                <?php } ?>
                <!-- </ol> -->
            </div>
            <div>
                <h2>Frog Puzzle</h2>
                <?php if (empty($this->stat['frog'])) echo '<div>No records</div>'; ?>
                <!-- <ol> -->
                <?php foreach ($this->stat['frog'] as $r) { ?>
                    <!-- <li> -->
                        <div>
                            Start Time: <?=$r['starttime']?><br/>
                            Time Used: <?=$this->pluralize(strtotime($r['endtime'])-strtotime($r['starttime']), 'seconds|second')?> 
                            <br/>
                            You have made <?=$this->pluralize(abs($r['result']), 'moves|move')?> 
                            <?=($r['result']>0?'to <strong>solve</strong>':'and <strong>failed</strong>')?> The Frog Puzzle.<br/>
                            <br/>
                        </div>
                    <!-- </li> -->
                <?php } ?>

                <!-- </ol> -->
            </div>
            <div>
                <h2>Catch Time</h2>
                <?php if (empty($this->stat['catch'])) echo '<div>No records</div>'; ?>
                <!-- <ol> -->
                <?php foreach ($this->stat['catch'] as $r) { ?>
                    <!-- <li> -->
                        <div>
                            Start Time: <?=$r['starttime']?><br/>
                            <!-- in this case, result is the time since db constraints -->
                            The time you try to catch is <?=$r['result']?>
                            <br/>
                            This time your timming is <?=$r['ans']?>.<br/>
                            <br/>
                        </div>
                    <!-- </li> -->
                <?php } ?>

                <!-- </ol> -->
            </div>
		</main>
		<footer>
		</footer>
	</body>
</html>

