<?php
require $_SERVER["DOCUMENT_ROOT"] . "/yavnik/_code/blog_managment_system/config/const.php";
// echo $_SERVER["DOCUMENT_ROOT"]."/yavnik/_code/blog_managment_system/config/const.php";
// die;
if (isset($_SESSION["user_id"]) && isset($_SESSION["user_email"])) {
    // echo "session are not set";
    if (time() - $_SESSION["login_time_stamp"] > 1800) {
        session_unset();
        session_destroy();
        header("location: login.php");
    }
} else {
    header("location: login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <?php
    require VIEW_LAYOUT . "/header.link.php";
    ?>
    <style>
        .element {
            height: 100px;
            /* border: 2px solid #949494; */
            border-radius: 6px;
            margin: 5px;
            width: 46%;
            background-color: #FFFFFF;
            color: black;
        }

        .heading_element_preview {
            /* height: 100px; */
            min-height: 110px;
            border: 1px solid #000000;
            border-radius: 6px;
            margin: 5px;
            width: 100%;
            background-color: #FFFFFF;
            color: black;
        }

        .main-container {
            padding: 20px 30px 20px 30px;
            background-color: #d2d3d4;
        }

        .main-body {
            background-color: #d2d3d4;
        }

        .magenta-color {
            background-color: #9B0A46;
            color: #ffffff;
        }
    </style>

</head>

<body>
    <div class="container-fluid main-container">
        <div class="row">
            <a class="navbar-brand text-light" href="index.php" id="home_page"> <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwm419xJ55U-h8p194LTplMOfDMc7qEdM-FA&s" alt="elementor clone" width="35px" height="35px"> </a>
        </div>
        <div class="row">
            <?php
            // require VIEW_LAYOUT . "/header.php";
            ?>
            <!--section-1 elements -->
            <div class="col-3 p-3 ">
                <div class="row d-flex magenta-color">
                    <h3>Elements</h3>
                </div>
                <div class="row d-flex justify-content-around">
                    <div class="element" id="heading_element">Heading</div>
                    <div class="element" id="text_editor_element">Text Editor</div>
                </div>
                <div class="row d-flex justify-content-around">
                    <div class="element" id="image_element">Image</div>
                    <div class="element" id="video_element">Video</div>
                </div>
            </div>
            <!--section-2 Page Preview -->
            <div class="col-5 p-3 bg-danger" id="page_preview">
                <h3 id="page_preview_start">Page Preview</h3>
                <!-- heading element - id - heading_element_${some_number} -->
                <!-- <div class="preview_elements" id="heading_element_${some_number}">
                    <div class="heading_element_preview d-flex align-items-center justify-content-center" >
                        <h1>Title</h1>
                    </div>
                </div> -->
            </div>
            <!--section-3 Edit Element -->
            <div class="col-4 p-3 bg-primary" id="edit_elements">
                <h3>Edit Element</h3>
                <!-- <div id="edit_element_setting">
                    <h4>Edit Heading</h4>
                    <div class="row">
                        <div class="col">Content</div>
                        <div class="col">style</div>
                        <div class="col">Advance</div>
                    </div>
                    <div class="row">
                        <h6>title</h6>
                        <textarea class="col-12 " style="height:100px;width: 90%;margin:auto" id="" name="" rows="4" cols="50"></textarea>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <?php
    require VIEW_LAYOUT . "/footer.link.php";
    ?>
    <?php
    require VIEW . "/js/add_new_blog_js.php";
    ?>
</body>

</html>