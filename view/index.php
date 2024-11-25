<?php
// echo "index.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>

    </style>
</head>

<body>

    <div id="wpadminbar" class="nojq">
        <div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Toolbar">
            <!-- wp logo -->
            <ul role="menu" id="wp-admin-bar-root-default" class="ab-top-menu">
                <li role="group" id="wp-admin-bar-menu-toggle"><a class="ab-item" role="menuitem" href="#" aria-expanded="false"><span class="ab-icon" aria-hidden="true"></span><span class="screen-reader-text">Menu</span></a></li>
                <div class="dropdown">
                    <button data-mdb-button-init
                        data-mdb-ripple-init data-mdb-dropdown-init class="btn btn-primary dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-mdb-toggle="dropdown"
                        aria-expanded="false">
                        Dropdown button
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
                <!-- go safariz -->
                <li role="group" id="wp-admin-bar-site-name" class="menupop"><a class="ab-item" role="menuitem" aria-expanded="false" href="https://gosafariz.com/">Go Safariz</a>
                    <div class="ab-sub-wrapper">
                        <ul role="menu" aria-label="Go Safariz" id="wp-admin-bar-site-name-default" class="ab-submenu">
                            <li role="group" id="wp-admin-bar-view-site"><a class="ab-item" role="menuitem" href="https://gosafariz.com/">Visit Site</a></li>
                            <li role="group" id="wp-admin-bar-view-docs"><a class="ab-item" role="menuitem" href="https://gosafariz.com/docs/">Visit Documentation</a></li>
                        </ul>
                    </div>
                </li>
                <!-- 7 updates -->
                <li role="group" id="wp-admin-bar-updates"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/update-core.php"><span class="ab-icon" aria-hidden="true"></span><span class="ab-label" aria-hidden="true">7</span><span class="screen-reader-text updates-available-text">7 updates available</span></a></li>
                <!-- 6 message-->
                <li role="group" id="wp-admin-bar-comments"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/edit-comments.php"><span class="ab-icon" aria-hidden="true"></span><span class="ab-label awaiting-mod pending-count count-6" aria-hidden="true">6</span><span class="screen-reader-text comments-in-moderation-text">6 Comments in moderation</span></a></li>
                <!-- new -->
                <li role="group" id="wp-admin-bar-new-content" class="menupop"><a class="ab-item" role="menuitem" aria-expanded="false" href="https://gosafariz.com/wp-admin/post-new.php"><span class="ab-icon" aria-hidden="true"></span><span class="ab-label">New</span></a>
                    <div class="ab-sub-wrapper">
                        <ul role="menu" aria-label="New" id="wp-admin-bar-new-content-default" class="ab-submenu">
                            <li role="group" id="wp-admin-bar-new-post"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/post-new.php">Post</a></li>
                            <li role="group" id="wp-admin-bar-new-media"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/media-new.php">Media</a></li>
                            <li role="group" id="wp-admin-bar-new-page"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/post-new.php?post_type=page">Page</a></li>
                            <li role="group" id="wp-admin-bar-new-e-floating-buttons"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/edit.php?action=elementor_new_post&amp;post_type=e-floating-buttons&amp;template_type=floating-buttons&amp;_wpnonce=007810f97b#library">Floating Element</a></li>
                            <li role="group" id="wp-admin-bar-new-elementor_library"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/post-new.php?post_type=elementor_library">Template</a></li>
                            <li role="group" id="wp-admin-bar-new-tm_portfolio"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/post-new.php?post_type=tm_portfolio">Portfolio</a></li>
                            <li role="group" id="wp-admin-bar-new-tm_service"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/post-new.php?post_type=tm_service">Service</a></li>
                            <li role="group" id="wp-admin-bar-new-tm_team_member"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/post-new.php?post_type=tm_team_member">Team Member</a></li>
                            <li role="group" id="wp-admin-bar-new-tm_testimonial"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/post-new.php?post_type=tm_testimonial">Testimonial</a></li>
                            <li role="group" id="wp-admin-bar-new-tm_client"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/post-new.php?post_type=tm_client">Client</a></li>
                            <li role="group" id="wp-admin-bar-new-tm_tours"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/post-new.php?post_type=tm_tours">Tours</a></li>
                            <li role="group" id="wp-admin-bar-new-user"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/user-new.php">User</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <!-- howdy, admin_123 -->
            <ul role="menu" id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
                <li role="group" id="wp-admin-bar-my-account" class="menupop with-avatar"><a class="ab-item" role="menuitem" aria-expanded="false" href="https://gosafariz.com/wp-admin/profile.php">Howdy, <span class="display-name">admin_123</span><img alt="" src="https://secure.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?s=26&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?s=52&amp;d=mm&amp;r=g 2x" class="avatar avatar-26 photo" height="26" width="26" decoding="async"></a>
                    <div class="ab-sub-wrapper">
                        <ul role="menu" aria-label="Howdy, admin_123" id="wp-admin-bar-user-actions" class="ab-submenu">
                            <li role="group" id="wp-admin-bar-user-info"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-admin/profile.php"><img alt="" src="https://secure.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?s=64&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?s=128&amp;d=mm&amp;r=g 2x" class="avatar avatar-64 photo" height="64" width="64" decoding="async"><span class="display-name">admin_123</span><span class="display-name edit-profile">Edit Profile</span></a></li>
                            <li role="group" id="wp-admin-bar-logout"><a class="ab-item" role="menuitem" href="https://gosafariz.com/wp-login.php?action=logout&amp;_wpnonce=cf199545d1">Log Out</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>