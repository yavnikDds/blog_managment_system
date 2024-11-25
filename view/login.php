<?php
require $_SERVER["DOCUMENT_ROOT"] . "/yavnik/_code/blog_managment_system/config/const.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <?php
    require VIEW_LAYOUT . "/header.link.php";
    ?>
    <style>
        .error{
            color:red;
            font-weight: 600;
        }
    </style>

</head>

<body>
    <div class="row d-flex justify-content-center">
        <div class="form col-3 p-4 m-5 border border-primary-subtle border-2 rounded-3">
            <h3 class="mb-5">Login</h3>
            <form name="login_form" id="login_form">
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" id="email" name="email" class="form-control" />
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" />
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row px-2 d-flex justify-content-between">
                    <!-- Submit button -->
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-2 col-4">Sign in</button>
                    <div class="col-6">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>


                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="#!">Register</a></p>
                </div>
            </form>
        </div>
    </div>
    <?php
    require VIEW_LAYOUT . "/footer.link.php";
    ?>
    <!-- ajax -->
    <script>
        $("#login_form").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                password: {
                    required: "Please enter the password",
                    minlength: "the password must be 6 char long"
                },
                email: {
                    required: "Please enter email.",
                    email: "email address is not valid"
                }
            },
            submitHandler: function(form) {
                console.log("1");
                // alert("submit is clicked");
                let formData = new FormData($("#login_form")[0]);
                $.ajax({
                    url: "<?= URL_CONTROLLER ?>/login.controller.php?task=login_check",
                    dataType: "JSON",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        if(data["status"] == true){
                            window.location.href = "index.php";
                        }

                    }
                });
            }
        });
    </script>
</body>

</html>