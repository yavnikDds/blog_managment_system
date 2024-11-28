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
if ($task == "check_slug_availability") {
    if (isset($_POST["slug"]) && isset($_POST["token"]) && !empty($_POST["slug"]) && !empty($_POST["token"])) {
        $does_slug_exist = $ADD_BLOG->check_slug_availability($_POST["slug"], $_POST["token"]);
        if ($does_slug_exist > 0) {
            echo json_encode(["message" => "slug exist, Do you want to change it?", "status" => false]);
        } else {
            echo json_encode(["message" => "slug doesn,t exist", "status" => true]);
        }
    }
}

if ($task == "save_heading_element") {
    if (isset($_POST["token"]) && isset($_POST["slug"]) && isset($_POST["title"]) && isset($_POST["sr_no"]) && isset($_POST["element_name"]) && isset($_POST["element_id"]) && !empty($_POST["token"]) && !empty($_POST["slug"]) && !empty($_POST["title"]) && !empty($_POST["element_name"]) && !empty($_POST["element_id"])) {
        // neccessary
        $token = $_POST["token"];
        $slug = $_POST["slug"];
        $title = $_POST["title"];
        $sr_no = $_POST["sr_no"];
        $element_name = $_POST["element_name"];
        $element_id = $_POST["element_id"];

        // can do without them
        $value = $_POST["value"];
        $h = $_POST["h"];
        $color = $_POST["color"];
        $tag = $_POST["tag"];
        $text_alignment = $_POST["text_alignment"];
        // function to check if the slug exist for the token ?
        $do_slug_needs_to_be_updated = $ADD_BLOG->check_if_token_and_sr_no($sr_no, $token);
        if ($do_slug_needs_to_be_updated > 0) {
            echo "update";
            $add_element_to_the_database = $ADD_BLOG->update_new_blog_element($token, $slug, $title, $sr_no, $element_name, $element_id, $value, $h, $color, $tag, $text_alignment);
        } else {
            echo "create";
            $add_element_to_the_database = $ADD_BLOG->create_new_blog_element($token, $slug, $title, $sr_no, $element_name, $element_id, $value, $h, $color, $tag, $text_alignment);
        }
        // function to add 
        // echo $do_slug_needs_to_be_updated;
        die;

        // var_dump($single_user_data);
        // die;
    } else {
        echo json_encode(["message" => "please enter both email and password.", "status" => false]);
    }
}
