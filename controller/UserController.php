<?php
class UserController extends Controller {
    public function callAction($action) {
        if (!$this->checkLogin() && $action != 'login' && $action != 'register') 
            $this->jump('/user/login');

        switch (strtolower($action)) {
            case 'login':
                $this->actionLogin();
                break;
            case 'register':
                $this->actionRegister();
                break;
            case 'profile':
                $this->actionProfile();
                break;
            case 'logout':
                $this->actionLogout();
                break;
            default:
                $this->err404();
                break;
        }
    }

    public function actionLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(empty($_REQUEST['submit']) || $_REQUEST['submit']!="login"){
                die("Invalid Request");
            }
            $user = @$_REQUEST['user'];
            $password = @$_REQUEST['password'];

            if(empty($user))$this->errors[]='user is required';
            if(empty($password))$this->errors[]='password is required';

            if(empty($this->errors)){
                $model = new User();
                $result = $model->login($_REQUEST['user'], $_REQUEST['password']);
                if ($result) {
                    $_SESSION['user'] = $user;
                    $this->jump('/');
                }
                else {
                    $this->errors[] = 'User and password do not match';
                }
            }
        }
        $this->render('login.php');
    }

    public function actionLogout() {
        session_destroy();
        $this->jump('/');
    }

    public function actionRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(empty($_REQUEST['submit']) || $_REQUEST['submit']!="Register"){
                die("Invalid Request");
            }

            $user = @$_REQUEST['user'];
            $password = @$_REQUEST['password'];
            $confirm = @$_REQUEST['confirm'];
            $email = @$_REQUEST['email'];

            if (empty($user)) $this->errors[] = 'User is required';
            if (empty($password)) $this->errors[] = 'Password is required';
            if (empty($confirm)) $this->errors[] = 'Please confirm your password';
            if (empty($email)) $this->errors[] = 'Please provide your email';
            

            if (empty($this->errors)) {
                if ($password != $confirm) $this->errors[] = 'Comfirm and password do not match';
                else{
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $this->errors[] = "Invalid email format"; 
                    }
    
                    // valid form of register
                    else {
                        $model = new User();
                        $result = $model->register($user, $password, $email);
                        if (!$result) $this->errors[] = 'User already exists';
                        else {
                            $this->jump('/user/login',3,'register success, go to login page...');
                            exit();
                        }
                    }    
                }
            }
        }
        $this->render('register.php');
    }

    public function actionProfile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->checkLogin();
            if ($_REQUEST['submit'] == "Change Password") {
                $password = @$_REQUEST['password'];
                $confirm = @$_REQUEST['confirm'];
                if (empty($password)) $this->errors[] = 'Password is required';
                if (empty($confirm)) $this->errors[] = 'Please confirm your password';

                if (empty($this->errors)) {
                    if ($password != $confirm) $this->errors[] = 'password cannot match, try again';
                    else {
                        $model = new User();
                        $result = $model->updateInfo($user, ['password' => $password]);
                        if ($result) {
                            session_destroy();
                            $this->jump('/user/login', 3, 'Password changed. Please login again...');
                        }
                        else {
                            $this->errors[] = 'Unknown Error';
                        }
                    }
                }
            }
            else if ($_REQUEST['submit'] == "Delete Account") {
                $model = new User();
                $res = $model->deleteUser($user);
                if ($res) {
                    $this->jump('/user/login', 3, 'Account deleted. Heading to login page...');
                }
                else {
                    $this->errors[] = 'Unknown Error';
                }
            }
            else {
                die('Invalid Request');
            }
        }
        $this->render('profile.php');
    } 
}