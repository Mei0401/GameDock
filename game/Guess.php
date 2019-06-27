<?php
class Guess {

    private $status = null;

    public function __construct($status = null) {
        if ($status) {
            $this->status = [
                'number' => $status['number'],
                'starttime' => $status['starttime'],
                'guesstime' => $status['guesstime'],
                'ended' => $status['ended'],
                'endtime' => $status['endtime'],
                'message' => $status['message']
            ];
        }
        else {
            $this->status = [
                'number' => random_int(1, 10),
                'starttime' => date('Y-m-d H:i:s'),
                'guesstime' => 0,
                'ended' => 0,
                'endtime' => null,
                'message' => []
            ];
        }
    }

    public function getStatus() {
        return $this->status;
    }

    public function guess($num) {
        ++$this->status['guesstime'];
        $msg = "Guess #{$this->status['guesstime']} was {$num} and was ";
        if ($num > $this->status['number']) {
            $msg .= "higher.";
        }
        else if ($num < $this->status['number']) {
            $msg .= "lower.";
        }
        else {
            $msg .= "correct.";
            $this->status['ended'] = 1;
            $this->status['endtime'] = date('Y-m-d H:i:s');
        }
        $this->status['message'][] = $msg;
        return $this->status;
    }


}