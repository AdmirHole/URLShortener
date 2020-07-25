<?php

class Shortener
{
    protected static $table = "short_urls";
    protected static $checkUrlExists = false;
    protected static $codeLength = 5;

    protected $pdo;
    protected $timestamp;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
        $this->timestamp = date("Y.m.d H:i:s");
    }

    public function urlToShortCode($url){
        if(empty($url)){
            throw new Exception("No URL was supplied.");
        }

        if($this->validateUrlFormat($url) == false){
            throw new Exception("URL does not have a valid format.");
        }

        if(self::$checkUrlExists){
            if (!$this->verifyUrlExists($url)){
                throw new Exception("URL does not appear to exist.");
            }
        }

        $shortCode = $this->urlExistsInDB($url);
        if($shortCode == false){
            $shortCode = $this->createShortCode($url);
        }

        return $shortCode;
    }

    protected function validateUrlFormat($url){
        return filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);
    }

    protected function urlExistsInDB($url){
        $query = "SELECT short_code FROM ".self::$table." WHERE url = :url LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $params = array(
            "url" => $url
        );
        $stmt->execute($params);

        $result = $stmt->fetch();
        return (empty($result)) ? false : $result["short_code"];
    }

    protected function createShortCode($url){
        $shortCode = $this->generateRandomString(self::$codeLength);
        $id = $this->insertUrlInDB($url, $shortCode);
        return $shortCode;
    }
    
    protected function generateRandomString($codeLength){
        $chars = str_split('abcdefghijklmnopqrstuvwxyz'
                        .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                        .'0123456789');
        shuffle($chars); 
        $rand = '';
        foreach (array_rand($chars, $codeLength) as $k) $rand .= $chars[$k];
        
        return $rand;
    }

    protected function insertUrlInDB($url, $code){
        $query = "INSERT INTO ".self::$table." (url, short_code, created) VALUES (:url, :short_code, :timestamp)";
        $stmnt = $this->pdo->prepare($query);
        $params = array(
            "url" => $url,
            "short_code" => $code,
            "timestamp" => $this->timestamp
        );
        $stmnt->execute($params);

        return $this->pdo->lastInsertId();
    }
    
    public function shortCodeToUrl($code, $increment = true){
        if(empty($code)) {
            throw new Exception("No short code was supplied.");
        }

        $urlRow = $this->getUrlFromDB($code);
        if(empty($urlRow)){
            throw new Exception("Short code does not appear to exist.");
        }

        if($increment == true){
            $this->incrementCounter($urlRow["id"]);
        }

        return $urlRow["url"];
    }

    

    protected function getUrlFromDB($code){
        $query = "SELECT id, url FROM ".self::$table." WHERE short_code = :short_code LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $params=array(
            "short_code" => $code
        );
        $stmt->execute($params);

        $result = $stmt->fetch();
        return (empty($result)) ? false : $result;
    }

    protected function incrementCounter($id){
        $query = "UPDATE ".self::$table." SET hits = hits + 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $params = array(
            "id" => $id
        );
        $stmt->execute($params);
    }

    public function getHits($code){
        $query = "SELECT hits FROM ". self::$table ." WHERE short_code = :short_code LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $params = array(
            "short_code" => $code
        );
        $stmt->execute($params);

        $result = $stmt->fetchColumn();

        return $result;
    }
}
