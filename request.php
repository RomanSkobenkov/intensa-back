<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\{ShortUrl, Redirect};

if (isset($_POST['url'])) {
    $final_url = new ShortUrl($_POST['url']);
} else {
    Redirect::redirect();
}