<?php
class MainController extends Controller {
    public function callAction($action) {
        if (!$this->checkLogin()) $this->jump('/user/login');
        switch (strtolower($action)) {
            case 'index':
                $this->actionIndex();
                break;
            case 'stat':
                $this->actionStat();
                break;
            default:
                $this->err404();
        }
    }

    public function actionIndex() {
        $this->render('main.php');
    }

    public function actionStat() {
        $model = new Stat();
        $this->stat = $model->getStat($this->checkLogin());
        $this->render('stat.php');
    }
}