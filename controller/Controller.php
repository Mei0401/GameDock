<?php
class Controller {

    public function render($view = null) {
        if ($view) require_once "view/$view";
    }

    public function callAction($action) {
        $this->err404();
    }

    public function err404() {
        echo '<h1>404</h1>';
    }

    public function link($text = '', $dest = '/', $new_page = false) {
        if (empty($text)) $text = $dest;
        echo "<a href=\"index.php?q={$dest}\"".($new_page?"target=\"_blank\"":"").">{$text}</a>";
    }

    public function jump($dest = '/', $delay = 0, $text = '') {
        // header("Location: /?q={$dest}");
        echo "<html><head><meta http-equiv=\"refresh\" content=\"{$delay}; url=index.php?q={$dest}\"></head><body>{$text}</body></html>";
        exit();
    }

    public function pluralize($number, $s = 's') {
        // s=="words|word" 0+/1
        // s=="words|word|words" 0/1/1+
        // s=="work" any
        $s = explode('|', $s);
        $ret = $number . ' ';
        if (count($s) == 3) {
            if ($number == 0 || $number == 1) $ret .= $s[$number];
            else $ret .= $s[2];
        }
        else if (count($s) == 2) {
            if ($number == 1) $ret .= $s[1];
            else $ret .= $s[0];
        }
        else {
            $ret .= $s[0];
        }
        return $ret;
    }

    public function checkLogin() {
        if (!isset($_SESSION['user']) || !$_SESSION['user']) return false;
        return $_SESSION['user'];
    }
}