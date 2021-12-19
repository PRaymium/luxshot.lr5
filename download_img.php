<?php
header('Content-Type: application/json');
require 'db.php';


if (isset($_GET['img']))
{
    $url = 'screenshots-image/' . $_GET['img'];
    if (file_exists($url)){
        header('Content-Description: File Transfer');
        header('Content-Type: image/jpeg');
        header('Content-Disposition: attachment; filename="'.basename($url).'"');
        header('Content-Length: '. filesize($url));
        header('Pragma: public');

        flush();
        readfile($url, true);
    }
    else{
        echo("Файл был удален");
    }
}
else{
    echo("Путь к файлу неверный");
    die();
}


echo json_encode(['success' => true]);
?>