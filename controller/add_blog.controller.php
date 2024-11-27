<?php
require $_SERVER["DOCUMENT_ROOT"] . "/yavnik/_code/blog_managment_system/config/db.php";
require MODEL . "/add_blog.model.php";
$db = DB::get_instance();
$pdo = $db->get_connection();
$ADD_BLOG = new ADD_BLOG($pdo);
$task = isset($_POST["task"]) ? $_POST["task"] : "";

// echo $task;die;
if ($task == "get_token_id") {
    echo json_encode($ADD_BLOG->get_tokan_id());
}

if ($task == "save_heading_element") {
    if (isset($_POST["element_name"]) && isset($_POST["sr_no"]) && isset($_POST["element_id"]) && !empty($_POST["element_name"]) && !empty($_POST["element_id"])) {
        // if the sr.no = 0 is a title
        if ($_POST["sr_no"] == 0 && $_POST["element_name"] == "heading_element"){
            $check_if_the_title_exist = $ADD_BLOG->check_if_the_title_exist($_POST["sr_no"], $_POST["value"]);
            if($check_if_the_title_exist>0){
                echo json_encode(["message"=>"the title already exist","status"=>false]);
                die;
            }
        }

        // neccessary
        $element_name = $_POST["element_name"];
        $sr_no = $_POST["sr_no"];
        $element_id = $_POST["element_id"];

        // can do without them
        $value = $_POST["value"];
        $tag = $_POST["tag"];
        $h = $_POST["h"];
        $color = $_POST["color"];
        $text_alignment = $_POST["text_alignment"];
        $add_element_to_the_database = $ADD_BLOG->create_new_blog_element($element_name, $sr_no, $element_id, $value, $tag, $h, $color, $text_alignment);
        die;

        // var_dump($single_user_data);
        // die;
    } else {
        echo json_encode(["message" => "please enter both email and password.", "status" => false]);
    }
}
