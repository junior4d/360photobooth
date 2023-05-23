<?php
$searchText = $_POST['searchText'];
$folderPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/pages/';

$directories = glob($folderPath . $searchText, GLOB_ONLYDIR);

if (count($directories) > 0) {
    header("Location: https://soomanyviewsphoto.com/uploads/pages/$searchText/");
    exit();
} else {
    header("Location: https://soomanyviewsphoto.com/index.html");
    exit();
}
?>
