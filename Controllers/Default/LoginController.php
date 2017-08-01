<?php

require_once __DIR__ . '/../../DMP/Controller.php';

class LoginController extends \DMP\Controller
{
    /**
     * @param \DMP\Request $request
     */
    public function indexAction(\DMP\Request $request) {
        return array('Default/login');
    }

    /**
     * @param \DMP\Request $request
     */
    public function processAction(\DMP\Request $request) {
        $email = $request->post('email');
        $password = $request->post('password');

        if ($email !== "admin@gmail.com" && $password !== "admin") {
            $this->redirect('/login');
            return;
        }

        $_SESSION['is_logged'] = true;
        $this->redirect('/');
    }

    /**
     * @param \DMP\Request $request
     */
    public function logoutAction(\DMP\Request $request) {
        $_SESSION['is_logged'] = false;
        $this->redirect('/');
    }

}