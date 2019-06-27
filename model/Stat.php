<?php
class Stat extends Model {
    public function __construct() {
        parent::__construct('appstat');
    }

    public function addStat($game, $user, $start, $end, $result, $ans = null) {
        if (in_array($game, ['frog', 'fifteen', 'guess','catch'])) {
            $arr = [
                'game' => $game,
                'userid' => $user,
                'starttime' => $start,
                'endtime' => $end,
                'result' => $result
            ];
            if ($ans !== null) $arr['ans'] = $ans;
            return $this->create($arr);
        }
        return false;
    }

    public function getStat($user) {
        $res = $this->findAll('userid = $1', [$user]);
        $ret = [
            'guess' => [],
            'fifteen' => [],
            'frog' => [],
            'catch' => []
        ];
        foreach ($res as $r) {
            switch ($r['game']) {
                case 'guess':
                    $ret['guess'][] = $r;
                    break;
                case 'fifteen':
                    $ret['fifteen'][] = $r;
                    break;
                case 'frog':
                    $ret['frog'][] = $r;
                    break;
                case 'catch':
                    $ret['catch'][] = $r;
                    break;
            }
        }
        return $ret;
    }
}