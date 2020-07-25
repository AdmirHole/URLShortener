<?php

require_once 'db.php';
require_once 'shortener.class.php';

$shortener = new Shortener($db);


if(Isset($_POST['shortCode'])){
    try{
        $code = $_POST['shortCode'];
        $hits = $shortener->getHits($code);
        echo json_encode(array(
            'res' => $hits
        ));
    }catch (Exception $e) {
        echo json_encode(array(
            'error' => array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode(),
            ),
        ));
    }
}