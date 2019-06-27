<?php
class User extends Model {

    public function __construct() {
        parent::__construct('appuser');
    }

    public function login($userid = '', $password = '') {
        if (!$userid || !$password) return false;
        $res = $this->find('userid = $1 and password = $2', [$userid, $password], '1');
        return !($res === false);
    }

    public function register($userid = '', $password = '', $email = '') {
        if (!$userid || !$password) return false;
        return $this->create(['userid'=>$userid, 'password'=>$password, 'email'=>$email]);
    }

    public function updateInfo($userid = '', $info = null) {
        if (!$userid || !$info || !is_array($info)) return false;
        return $this->update('userid = $1', [$userid], $info);
    }

    public function deleteUser($userid = '') {
        if (!$userid) return false;
        return $this->delete('userid = $1', [$userid]);
    }
}