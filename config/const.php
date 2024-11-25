<?php
session_start();

// db credentials
define("DB_HOST", "localhost");
define("DB_NAME", "blog_managment_system");
define("USER", "root");
define("PASS", "");

$root_url = !empty($_SERVER["HTTPS"])?"https":"http";
$root_url .= "://localhost/yavnik/_code/blog_managment_system";
$root_file_path = $_SERVER["DOCUMENT_ROOT"]."/yavnik/_code/blog_managment_system";

// serverside file path
define("ROOT_FILE_PATH", $root_file_path); // 

// client side url
define("URL", $root_url); // with localhost

// echo $root_url."<br>";
// echo $root_file_path."<br>";die;