<?php
class Frog {
    private $board = null;
    private $status = null;

    public function __construct($board = null, $status = null) {
        if (!$board || !$status) {
            $this->board = [1,1,1,0,-1,-1,-1];
            $this->status = [
                'starttime' => date('Y-m-d H:i:s'),
                'move' => 0,
                'ended' => 0,
                'endtime' => null
            ];
        }
        else {
            $this->board = $board;
            $this->status = [
                'starttime' => $status['starttime'],
                'move' => $status['move'],
                'ended' => $status['ended'],
                'endtime' => $status['endtime']
            ];
        }
    }

    public function getStatus() {
        return $this->status;
    }

    public function getBoard() {
        return $this->board;
    }

    public function empty($index) {
        if ($index < 0 || $index > 6) return false;
        if ($this->board[$index] == 0) return true;
        return false;
    }

    public function movable($index) {
        // 0: Not movable
        // 1/2: right
        // -1/-2: left
        if ($index < 0 || $index > 6 || $this->board[$index] == 0) return 0;
        if ($this->empty($index + $this->board[$index])) return $this->board[$index];
        else if ($this->empty($index + 2 * $this->board[$index])) return 2 * $this->board[$index];
        return 0;
    }

    public function checkWin() {
        if ($this->board[0] == $this->board[1] && 
            $this->board[1] == $this->board[2] && 
            $this->board[0] == -1 &&
            $this->board[4] == $this->board[5] && 
            $this->board[5] == $this->board[6] && 
            $this->board[6] == 1) 
                return true;
        return false;
    }

    public function move($pos) {
        if ($this->status['ended'] === 0 && 0 <= $pos && $pos <= 6) {
            $t = $this->movable($pos);
            if ($t != 0) {
                ++$this->status['move'];
                $this->board[$pos + $t] = $this->board[$pos];
                $this->board[$pos] = 0;
                $ended = -1;
                for ($i = 0; $i <= 6; ++$i) {
                    if ($this->movable($i) != 0) {
                        $ended = 0;
                        break;
                    }
                }
                if ($ended != 0) {
                    if ($this->checkWin()) {
                        $ended = 1;
                        // model
                    }
                    else {
                        // model
                    }
                }
                $this->status['ended'] = $ended;
                if ($ended != 0) {
                    $this->status['endtime'] = date('Y-m-d H:i:s');
                }
            }
        }
    }
}