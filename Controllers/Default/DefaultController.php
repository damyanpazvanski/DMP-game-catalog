<?php

require_once __DIR__ . '/../../DMP/Controller.php';

class DefaultController extends \DMP\Controller
{
    /**
     * @param \DMP\Request $request
     *
     * @return array
     */
    public function indexAction(\DMP\Request $request) {
        return array(
            'default/default', [
                'damyan' => 'Pazvanski'
            ]
        );
    }
}