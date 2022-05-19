<?php


class ShortUrl
{
    public $final_url;

    public function __construct(string $post)
    {
        $this->$final_url = self::result_short_url(htmlspecialchars(trim($post)));
    }

    function __toString()
    {
        return $this->$final_url;
    }

    private static function create_short_url() : string
    {
        $chars = str_split('abcdefghijklmnopqrstuvwxyzABCDFEGHIJKLMNOPRSTUVWXYZ0123456789');
        $short_url = '';

        for ($i = 0; $i < 5; $i++) {
            $short_url .= $chars[ mt_rand(0, sizeof($chars) - 1) ];
        }

        return $short_url;
    }

    private static function get_free_short_url() : string
    {
        while (true) {
            $short_url = self::create_short_url();

            global $pdo;
            $req = $pdo->prepare("SELECT * FROM `short_urls` WHERE `short_url` = :short_url");
            $req->execute(array('short_url' => $short_url));
            $res = $req->fetch(PDO::FETCH_ASSOC);

            if (!$res) { // если такой короткой ссылки нет, то забираем её и выходим из цикла
                return $short_url;
            }
        }
    }

    private static function result_short_url(string $post) : string
    {
        $short_url = self::get_free_short_url();

        global $pdo;
        $ins = $pdo->prepare("INSERT INTO `short_urls` SET `long_url` = :long_url, `short_url` = :short_url");
        $ins->execute(array('long_url' => $post, 'short_url' => $short_url));

        if ($pdo->lastInsertId()) {
            return $_SERVER['SERVER_NAME'].'/'.$short_url;
        }
    }

}