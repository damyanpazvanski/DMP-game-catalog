<?php

require_once __DIR__ . '/../../DMP/Controller.php';

class LoadCategories extends \DMP\Controller
{
    public function load()
    {
        $db = $this->getManager('default');

        $sql = 'SELECT * FROM categories';
        $getCategories = $db->query($sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($getCategories)) {
            $data[] = $row;
        }

        return $data;
    }
}