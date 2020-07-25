<?php



require_once 'db.php';
require_once 'shortener.class.php';

$shortener = new Shortener($db);

$shortURL_Prefix = 'http://localhost/URLShortener/'; 

if(Isset($_POST['longUrl'])){
    try{
        $longURL = $_POST['longUrl'];
        $shortCode = $shortener->urlToShortCode($longURL);
        $shortURL = $shortURL_Prefix.$shortCode;
        
        echo json_encode(array(
            'res' => $shortURL,
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
