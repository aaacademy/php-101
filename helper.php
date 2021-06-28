<?php
session_start();

function getConnection() {
    $host = "localhost";
    $port = 3306;
    $database = "phpku";
    $username = "root";
    $password = "";

    return new PDO("mysql:host=$host:$port;dbname=$database", $username, $password);
}

function readFlash() {
    if(@$_SESSION['message']):
        $result = <<<FLASH
            <div class="alert position-absolute mx-auto" style="right: 0">
                <div class="$_SESSION[class]">
                    $_SESSION[message]
                </div>
            </div>
            FLASH;
        echo $result;
        unset($_SESSION['message']);
        unset($_SESSION['class']);
    endif;
}

function setFlash($message = "", $class = "alert alert-success") {
    $_SESSION['message']    = $message;
    $_SESSION['class']      = $class;
}

function slugify($text, string $divider = '-') {
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, $divider);
  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);
  // lowercase
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}

function readMore($string = "", $max = 30) {
    $text = strip_tags($string);
    if (strlen($text) > $max) {
        // truncate text
        $textCut = substr($text, 0, $max);
        $endPoint = strrpos($textCut, ' ');
        $text = $endPoint? substr($textCut, 0, $endPoint) : substr($textCut, 0);
        $text .= '...';
    }
    echo $text;
}