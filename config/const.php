<?php
session_start();

// db credentials
define("DB_HOST", "localhost");
define("DB_NAME", "blog_managment_system");
define("USER", "root");
define("PASS", "");

$root_file_path = $_SERVER["DOCUMENT_ROOT"]."/yavnik/_code/blog_managment_system";
$root_url = !empty($_SERVER["HTTPS"])?"https":"http";
$root_url .= "://localhost/yavnik/_code/blog_managment_system";

// serverside file path
define("ROOT_FILE_PATH", $root_file_path); // 
define("CONFIG",ROOT_FILE_PATH."/config");
define("VIEW",ROOT_FILE_PATH."/view");
define("PLUGIN",ROOT_FILE_PATH."/plugin ");
define("VIEW_LAYOUT",ROOT_FILE_PATH."/view/layout");
define("MODEL",ROOT_FILE_PATH."/model");

// client side url
define("URL", $root_url); // with localhost
define("URL_CONTROLLER", URL."/controller"); // with localhost
define("URL_VIEW", URL."/view"); // with localhost
define("URL_PLUGIN", URL."/plugin"); // with localhost

// echo $root_url."<br>";
// echo $root_file_path."<br>";die;
// echo "const"; die;