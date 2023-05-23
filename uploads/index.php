<?php
$adminPassword = "360photo11";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>360 Photobooth</title>

    <style>
        #login {
            display: none;
        }
    </style>
</head>
<body>
    <div id="adminLogin">
        <h2>Admin Login</h2>
        <input type="password" id="adminPassword" placeholder="Password">
        <button onclick="adminLogin()">Login</button>
    </div>

    <div id="login">
        <form action="create_page.php" method="post" enctype="multipart/form-data">
            <label for="pageName">Page Name:</label>
            <input type="text" name="pageName" id="pageName" required>
            <label for="pagePassword">Page Password:</label>
            <input type="password" name="pagePassword" id="pagePassword" required>
            <label for="pageImages">Images:</label>
            <input type="file" name="pageImages[]" id="pageImages" multiple required>
            <input class="button" style="border: 1px solid #00a2ff;background-color: #00a2ff;color:white;cursor: pointer;" type="submit" value="Create Page">
        </form>
    </div>

    <script>
        function adminLogin() {
            var password = $("#adminPassword").val();

            $.ajax({
                url: "validate_password.php",
                type: "POST",
                data: { password: password },
                success: function(response) {
                    if (response == "success") {
                        $("#adminLogin").hide();
                        $("#login").show();
                    } else {
                        alert("Incorrect password. Please try again.");
                    }
                },
                error: function() {
                    alert("An error occurred. Please try again later.");
                }
            });
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>
