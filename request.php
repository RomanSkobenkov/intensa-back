<?php
include 'dbcon.php';
include 'ShortUrl.php';
include 'Redirect.php';

if (isset($_POST['url'])) {
    $final_url = new ShortUrl($_POST['url']);
} else {
    Redirect::redirect();
}