<?php
// echo "index.php/config";
require $_SERVER["DOCUMENT_ROOT"]."/yavnik/_code/blog_managment_system/config/const.php";
echo $root_url."/view/index.php";
header("location: $root_url./view/index.php");
// header("Location: $root_file_path/index.php");
// header("Location: C:/wamp64/www/yavnik/_code/blog_managment_system/config/const.php");