<?php
require $_SERVER["DOCUMENT_ROOT"] . "/yavnik/_code/blog_managment_system/config/db.php";
require MODEL . "/login.model.php";
$db = DB::get_instance();
$pdo = $db->get_connection();
$LOGIN = new LOGIN($pdo);
$task = isset($_GET["task"]) ? $_GET["task"] : "";

// echo $task;die;
if ($task == "login_check") {
    if (isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $single_user_data = $LOGIN->read_single_user_data($email, $password);
        if (isset($single_user_data["email"]) && !empty($single_user_data["email"])) {
            if (password_verify($password, $single_user_data["password"])) {
                $_SESSION["user_id"] = $single_user_data["id"];
                $_SESSION["user_email"] = $single_user_data["email"];
                $_SESSION["login_time_stamp"] = time();
                echo json_encode(["message" => "User email and password are matched", "status" => true]);
            } else {
                echo json_encode(["message" => "Email or Password did not match.", "status" => false]);
            }
        } else {
            echo json_encode(["message" => "Email or Password did not match.", "status" => false]);
        }
        // var_dump($single_user_data);
        // die;
    } else {
        echo json_encode(["message" => "please enter both email and password.", "status" => false]);
    }
}
