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

if ($task == "save_page_elements") {
    if (isset($_POST["page_elements"]) && !empty($_POST["page_elements"]) && isset($_POST["slug"]) && !empty($_POST["slug"]) && isset($_POST["token"]) && !empty($_POST["token"])) {
        // neccessary
        $token = $_POST["token"];
        $slug = $_POST["slug"];
        $page_elements = $_POST["page_elements"];
        // var_dump($page_elements);
        // echo "<br>";
        // echo $slug;
        // echo "<br>";
        // echo $token;
        $do_page_needs_to_be_updated = $ADD_BLOG->do_page_needs_to_be_updated($token);
        if ($do_page_needs_to_be_updated > 0) {
            echo "update";
            $add_element_to_the_database = $ADD_BLOG->update_new_blog_element($token, $slug, $page_elements);
        } else {
            echo "create";
            $add_element_to_the_database = $ADD_BLOG->create_new_blog_element($token, $slug, $page_elements);
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
