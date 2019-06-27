<?php
?>
			<ul>
                <li><div style="padding: 0"?=$this->link('<img id="logo" src="logo.png" alt="logo" style="background-color: white;width: 80px;height: 60px;border:0; float: left;">', '/main/index')?></div></li>
                <li><?=$this->link('Main', '/main/index')?></li>
                <li><?=$this->link('Game Stats', '/main/stat')?></li>
                <li><?=$this->link('GuessGame', '/game/guess')?></li>
                <li><?=$this->link('15 Puzzle', '/game/fifteen')?></li>
                <li><?=$this->link('Frogs', '/game/frog')?></li>
                <li><?=$this->link('Catch Time', '/game/catch')?></li>
                <li><?=$this->link('Logout', '/user/logout')?></li>
                <li style="float:right; background-color: #0c0c0c;"><b><?=$this->link('User Profile', '/user/profile')?></b></li>
            </ul>
            <center>
                <h2 style="color:#ED4040" >Welcome! User <?=$this->checkLogin()?></h2>
            </center>
