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
            <?php
            // require VIEW_LAYOUT . "/header.php";
            ?>
            <div class="col-3 p-3 ">
                <div class="row d-flex magenta-color">
                    <h3>Elements</h3>
                </div>
                <div class="row d-flex justify-content-around">
                    <div class="element">Heading</div>
                    <div class="element">Text Editor</div>
                </div>
                <div class="row d-flex justify-content-around">
                    <div class="element">Image</div>
                    <div class="element">Video</div>
                </div>
            </div>
            <div class="col-5 p-3 bg-success">
                <h3>Page Preview</h3>
            </div>
            <div class="col-4 p-3 bg-primary">
                <h3>Edit Element</h3>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <?php
    require VIEW_LAYOUT . "/footer.link.php";
    ?>

</body>

</html>