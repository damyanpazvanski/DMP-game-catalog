<?php

require_once __DIR__ . '/../../DMP/Controller.php';

class ExceptionsController extends \DMP\Controller
{
    public function indexAction()
    {
        return array('Default/404');
    }
}