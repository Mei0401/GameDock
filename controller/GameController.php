<?php
class GameController extends Controller {
    public function callAction($action) {
        if (!$this->checkLogin()) $this->jump('/user/login');
        switch (strtolower($action)) {
            case 'guess':
                $this->guessAction();
                break;
            case 'fifteen':
                $this->fifteenAction();
                break;
            case 'frog':
                $this->frogAction();
                break;
            case 'catch':
                $this->catchAction();
                break;
            default:
                $this->err404();
                break;
        }
    }


    public function frogAction() {
        $game = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['frog_status']) || @$_POST['submit'] == 'Restart') {
                $game = new Frog();
            }
            else if (0 <= $_POST['submit'] && $_POST['submit'] < 7) {
                $game = new Frog($_SESSION['frog_board'], $_SESSION['frog_status']);
                $game->move($_POST['submit']);
                if ($game->getStatus()['ended'] != 0) {
                    // Model
                    $model = new Stat();
                    $model->addStat(
                        'frog',
                        $this->checkLogin(),
                        $game->getStatus()['starttime'],
                        $game->getStatus()['endtime'],
                        $game->getStatus()['move'] * $game->getStatus()['ended']
                    );
                } 
            }
            else {
                die('Invalid Request');
            }
        }
        else {
            $game = new Frog();
        }
        
        $_SESSION['frog_status'] = $game->getStatus();
        $_SESSION['frog_board'] = $game->getBoard();
        $this->board = $game->getBoard();
        $this->status = $game->getStatus();
        $this->render('game_frog.php');
    }

    public function fifteenAction() {
        $game = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['fifteen_status']) || @$_POST['submit'] == 'Restart') {
                $game = new Fifteen();
            }
            else if (1 <= $_POST['submit'] && $_POST['submit'] < 16) {
                $game = new Fifteen($_SESSION['fifteen_board'], $_SESSION['fifteen_status']);
                $pos = array_search($_POST['submit'], $game->getBoard());
                $game->move($pos);
                if ($game->getStatus()['ended']) {
                    // for models
                    $model = new Stat();
                    $model->addStat(
                        'fifteen',
                        $this->checkLogin(),
                        $game->getStatus()['starttime'],
                        $game->getStatus()['endtime'],
                        $game->getStatus()['move']
                    );
                }
            }
            else {
                die('Invalid Request');
            }
        }
        else {
            $game = new Fifteen();
        }
        
        $_SESSION['fifteen_status'] = $game->getStatus();
        $_SESSION['fifteen_board'] = $game->getBoard();
        $this->board = $game->getBoard();
        $this->status = $game->getStatus();
        $this->render('game_fifteen.php');
    }

    public function guessAction() {
        $game = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['guess']) || @$_POST['submit'] == 'Start a new game') {
                $game = new Guess();
                $_SESSION['guess'] = $game->getStatus();
            }
            else if (@$_POST['submit'] == 'Guess!') {
                $gnum = @$_POST['guess'];
                if (empty($gnum)) {
                    $this->errors[] = 'A numeric guess is required.';
                }
                else if (!is_numeric($gnum)) {
                    $this->errors[] = 'Guess must be an integer.';
                }
                else {
                    $game = new Guess($_SESSION['guess']);
                    $_SESSION['guess'] = $game->guess($gnum);
                    if ($game->getStatus()['ended'] == 1) {
                        // Model codes
                        $model = new Stat();
                        $model->addStat(
                            "guess", 
                            $this->checkLogin(), 
                            $game->getStatus()['starttime'],
                            $game->getStatus()['endtime'],
                            $game->getStatus()['guesstime'],
                            $game->getStatus()['number']
                        );
                    }
                }
            }
            else {
                die('Invalid Request');
            }
        }
        else {
            // No guess is submitted then start a new game
            $game = new Guess();
            $_SESSION['guess'] = $game->getStatus();
        }
        
        $this->message = $_SESSION['guess']['message'];
        $this->render('game_guess.php');
    }

    public function catchAction(){
        $game = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['catch']) || @$_POST['submit'] == 'Start a new game') {
                $game = new CatchTime();
                $_SESSION['catch'] = $game->getStatus();
            }
            else if (@$_POST['submit'] == 'Set Time') {
                $targetime = @$_POST['timeInterval'];
                if (empty($targetime) or $targetime > 20 or $targetime < 1) {
                    $this->errors[] = 'Need a valid time number, should be greater than 1 and less than 20';
                }
                else if (!is_numeric($targetime)) {
                    $this->errors[] = 'Time must be an integer.';
                }
                else {
                    $game = new CatchTime($_SESSION['catch']);
                    $_SESSION['catch'] = $game->setTime($targetime);
                }
            }
            else if (@$_POST['submit'] == "This is the time!!"){
                $game = new CatchTime($_SESSION['catch']);
                $_SESSION['catch'] = $game->compare();
                // Model codes
                $model = new Stat();
                $model->addStat(
                    "catch", 
                    $this->checkLogin(), 
                    $game->getStatus()['starttime'],
                    $game->getStatus()['endtime'],
                    $game->getStatus()['timeinterval'],
                    $game->getStatus()['result']
                );
            }
            else {
                die('Invalid Request');
            }
        }

        else {
            $game = new CatchTime();
            $_SESSION['catch'] = $game->getStatus();
        }
        
        $this->message = $_SESSION['catch']['message'];
        $this->render('game_catch.php');
    }
}