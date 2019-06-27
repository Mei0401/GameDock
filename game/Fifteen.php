<?php
class Fifteen {
    private $board = null;
    private $status = null;
    
    public function __construct($board = null, $status = null) {

        if ($board === null || $status === null) {
            // Create new board
            $this->board = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 0, 15];
            shuffle($this->board);
            $this->status = [
                'starttime' => date('Y-m-d H:i:s'),
                'move' => 0,
                'ended' => false,
                'endtime' => null,
            ];
        }
        else {
            $this->board = $board;
            $this->status = [
                'starttime' => $status['starttime'],
                'move' => $status['move'],
                'ended' => $status['ended'],
                'endtime' => $status['endtime'],
            ];
        }
    }

    public function getBoard() {
        return $this->board;
    }

    public function getStatus() {
        return $this->status;
    }

    public function checkWin() {
        if ($this->board[15] != 0) return false;
        for ($i = 0; $i < 15; ++$i) {
            if ($this->board[$i] != $i + 1) return false;
            // when b[0] = 1, b[1] = 2, ... , b[14] = 15, b[15] = 0
        }
        return true;
    }

    public function move($position = -1) {
        if (0 <= $position && $position < 16) {
            if ($this->status['ended']) return;
            $curRow = $this->getRow($position);
            $curCol = $this->getCol($position);
            // echo "<h2>Click on ($curRow, $curCol)</h2>";
            ++$this->status['move'];
            if ($this->getCell($curRow, $curCol - 1) == 0) {
                // Move left
                // echo '<h3>Moving left</h3>';
                $target = $this->getIndex($curRow, $curCol - 1);
                $this->board[$target] = $this->board[$position];
                $this->board[$position] = 0;
            }
            else if ($this->getCell($curRow, $curCol + 1) == 0) {
                // Move right
                // echo '<h3>Moving right</h3>';
                $target = $this->getIndex($curRow, $curCol + 1);
                $this->board[$target] = $this->board[$position];
                $this->board[$position] = 0;
            }
            else if ($this->getCell($curRow - 1, $curCol) == 0) {
                // Move up
                // echo '<h3>Moving up</h3>';
                $target = $this->getIndex($curRow - 1, $curCol);
                $this->board[$target] = $this->board[$position];
                $this->board[$position] = 0;
            }
            else if ($this->getCell($curRow + 1, $curCol) == 0) {
                // Move down
                // echo '<h3>Moving down</h3>';
                $target = $this->getIndex($curRow + 1, $curCol);
                $this->board[$target] = $this->board[$position];
                $this->board[$position] = 0;
            }
            else {
                // echo '<h3>Not Moving</h3>';
                --$this->status['move'];
            }
            if ($this->checkWin()) {
                $this->status['ended'] = true;
                $this->status['endtime'] = date('Y-m-d H:i:s');
            }
        }
    }

    public function getIndex($row, $col) {
        return $row * 4 + $col;
    }

    public function getRow($index) {
        return (int)($index / 4);
    }

    public function getCol($index) {
        return $index % 4;
    }

    public function getCell($row, $col) {
        if ($row < 0 || $col < 0 || $row >= 4 || $col >= 4 || $row * 4 + $col > 15) return -1;
        // echo "<h3>Cell at ($row, $col) is {$this->board[$this->getIndex($row, $col)]}</h3>";
        return $this->board[$this->getIndex($row, $col)];
    }
}