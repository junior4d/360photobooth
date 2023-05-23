<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}

$pageName = $_POST['pageName'];
$pagePassword = $_POST['pagePassword'];
$pageImages = $_FILES['pageImages'];

$pageDir = dirname(__FILE__) . "/pages/$pageName";
if (!mkdir($pageDir)) {
    exit();
}

$html .= "<!DOCTYPE html>\n";
$html .= "<html>\n";
$html .= "<head>\n";
$html .= "<link rel=\"stylesheet\" href=\"https://soomanyviewsphoto.com/styles.css\">\n";
$html .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
$html .= "<title>$pageName</title>\n";
$html .= "</head>\n";
$html .= "<body>\n";
$html .= "<div id=\"login\">\n";
$html .= "<h2>Enter password to view this page:</h2>\n";
$html .= "<input type=\"password\" id=\"password\" name=\"password\">\n";
$html .= "<button type=\"submit\" id=\"btnLogin\">Enter</button>\n";
$html .= "</div>\n";
$html .= "<div style=\"display: none;\" id=\"content\">\n";
$html .= $pagePassword;
$html .= "</div>\n";

$html .= "<div id=\"images\" style=\"display: none;\">\n";
foreach ($pageImages['error'] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmpName = $pageImages['tmp_name'][$key];
        $fileName = basename($pageImages['name'][$key]);
        move_uploaded_file($tmpName, "$pageDir/$fileName");
        $html .= "<img src=\"https://soomanyviewsphoto.com/uploads/pages/$pageName/$fileName\" width=\"250px\" height=\"250px\">\n";
    }
}
$html .= "</div>\n";

// Wrap your JavaScript code inside the load event listener block
$html .= "<script>\n";
$html .= "window.addEventListener('load', function() {\n";
$html .= "  document.getElementById('images').style.display = 'none';\n";
$html .= "  document.getElementById('login').style.visibility = 'block';\n";
$html .= "  document.getElementById('btnLogin').onclick = function() {\n";
$html .= "    var password = document.getElementById('password').value;\n";
$html .= "    if (password === document.getElementById('content').innerHTML.trim()) {\n";
$html .= "      document.getElementById('login').style.display = 'none';\n";
$html .= "      document.getElementById('images').style.display = 'block';\n";
$html .= "    }\n";
$html .= "    else {\n";
$html .= "      alert('Invalid password!');\n";
$html .= "    }\n";
$html .= "  }\n";
$html .= "});\n";
$html .= "</script>\n";

$html .= "</body>\n";
$html .= "</html>\n";


$file = fopen("$pageDir/index.html", "w");
fwrite($file, $html);
fclose($file);

header("Location:https://soomanyviewsphoto.com/uploads/pages/$pageName/");
exit();
?>