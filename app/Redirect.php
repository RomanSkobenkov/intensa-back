<?php

namespace app;

class Redirect
{

    public function __construct()
    {
    }

    public static function redirect()
    {
        $shortUrl = substr($_SERVER['REQUEST_URI'], 1);

        if (iconv_strlen($shortUrl)) {
            $pdo = new DB();
            $req = $pdo->prepare("SELECT * FROM `short_urls` WHERE `short_url` = :short_url");
            $req->execute(['short_url' => $shortUrl]);
            $res = $req->fetch(\PDO::FETCH_ASSOC);

            try {
                if ($res) {
                    header("Location: " . $res['long_url']);
                } else {
                    throw new \Exception("Такой короткой ссылки не существует");
                }
            } catch (\Exception $e){
                echo "Такой короткой ссылки не существует <br>";
            }
        }
    }
}
