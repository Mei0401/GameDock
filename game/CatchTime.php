<?php
class CatchTime {

    private $status = null;

    public function __construct($status = null) {
        if ($status) {
            $this->status = [
                'startpoint' => $status['startpoint'],
                'starttime' => $status['starttime'],
                'state' => $status['state'],
                'endtime' => $status['endtime'],
                'message' => $status['message'],
                'timeinterval' => $status['timeinterval'],
                'result' => $status['result']
            ];
        }
        else {
            $this->status = [
                'startpoint' => null,
                'starttime' => date('Y-m-d H:i:s'),
                'state' => 0,
                'endtime' => null,
                'message' => [],
                'timeinterval' => $status['timeinterval'],
                'result' => ''
            ];
        }
    }

    public function getStatus() {
        return $this->status;
    }

    public function setTime($timeinterval){
        $this->status['startpoint'] = time();
        $this->status['state'] = 1;
        $this->status['timeinterval'] = $timeinterval;
        return $this->status;
    }

    public function compare() {
        $catchTime = time();
        $timeDiff = $catchTime - $this->status['startpoint'] - $this->status['timeinterval'];
        $offset = $catchTime - $this->status['startpoint'];
        $msg = "";
        if($timeDiff == 1 or $timeDiff == 1){
            $msg = "You are doing good job!! ";
            $this->status['result'] = 'perfect';
        }else if($timeDiff == 0){
            $msg = "Congrats!!!!! You catch the time perfectly. ";
            $this->status['result'] = 'close';
        }else if ($timeDiff < 1){
            $msg = "Toooooo early. ";
            $this->status['result'] = 'too early';
        }else{
            $msg = "Toooooo late. ";
            $this->status['result'] = 'too late';
        }
        $msg .= " Your target is ". $this->status['timeinterval'];
        $msg .= ". Your guess is ". $offset ;
        $this->status['state'] = 2;
        $this->status['endtime'] = date('Y-m-d H:i:s');
        $this->status['message'][] = $msg;
        return $this->status;
    }


}