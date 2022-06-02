<?php


class ShortUrl
{
    public $shortUrl;

    /**
     * ShortUrl constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $shortUrl = self::resultShortUrl($url);
        $pdo = new DB();
        $req = $pdo->prepare("SELECT * FROM `short_urls` WHERE `short_url` = :short_url");
        $req->execute(array('short_url' => $shortUrl));
        $res = $req->fetch(PDO::FETCH_ASSOC);

        if (!$res) { // если такой короткой ссылки нет, то забираем её и выходим из цикла
            $ins = $pdo->prepare("INSERT INTO `short_urls` SET `long_url` = :long_url, `short_url` = :short_url");
            $ins->execute(array('long_url' => $url, 'short_url' => $shortUrl));

            if ($pdo->lastInsertId()) {
                $this->shortUrl = $_SERVER['SERVER_NAME'] . '/' . $shortUrl;
            }
        } else {
            $this->shortUrl = $_SERVER['SERVER_NAME'] . '/' . $res['short_url'];
        }
    }

    /**
     * @param string $url
     * @return string
     */
    private static function resultShortUrl(string $url): string
    {
        $shortUrl = md5(htmlspecialchars(trim($url)));
        return substr($shortUrl, 0, 6);
    }

}