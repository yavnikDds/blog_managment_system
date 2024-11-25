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
    // echo "session are set";      
    // var_dump($_SESSION);

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
    </style>

</head>

<body>
    <div class="row">
        <?php
        require VIEW_LAYOUT . "/header.php";
        ?>
        <div class="col-9 p-3">
            <div class="container">
                The Web Content in detail.
            </div>
            <div class="container">
                <p> The vertical menu can place the left or right side of the web pages. <br> But the default vertical menu placed on the left side. </P>
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