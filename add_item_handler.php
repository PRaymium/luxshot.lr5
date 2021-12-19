<?php
require 'db.php';
session_start();

// var_dump($_POST);
// var_dump($_FILES);
$errors = [];

$max_file_size = 3145728;

if ($_FILES == null){
    array_push($errors, "file");
    echo json_encode(['errors' => $errors]);
    die();
}
if ($_FILES['file']['type'] != "image/jpeg"){
    array_push($errors, "file_type");
    echo json_encode(['errors' => $errors]);
    die();
}
if ((pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) != "jpg") && (pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) != "jpeg")){
    array_push($errors, "file_type");
    echo json_encode(['errors' => $errors]);
    die();
}
if ($_FILES['file']['size'] > $max_file_size){
    array_push($errors, "file_size");
    echo json_encode(['errors' => $errors]);
    die();
}
if ($_FILES['file']['error'] != null){
    array_push($errors, "file_error");
    echo json_encode(['errors' => $errors]);
    echo json_encode(['file_error_message' => $_FILES['file']['error']]);
    die();
}

$file_extansion = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$img_name = uniqid() . '.' . $file_extansion;
$new_file_path = 'screenshots-image' . '/' . $img_name;

if (!(move_uploaded_file($_FILES['file']['tmp_name'], $new_file_path))){
    array_push($errors, "file_move");
    echo json_encode(['errors' => $errors]);
    die();
}

if ($_POST['checkbox'] == null)
{
    $checkbox_state = 1;
}
else{
    $checkbox_state = 0;
}

$current_date = date('Y-m-d');

$post = $connection->prepare("INSERT INTO screenshots (user_id, date, img, public) VALUES (?, ?, ?, ?)");
$post->execute([$_SESSION['user']['user_id'], $current_date, $img_name, $checkbox_state]);
$post = $connection->prepare("SELECT img FROM screenshots WHERE img=?");
$post->execute([$img_name]);
$post = $post->fetch();

$post_url = 'screenshot.php?img=' . $post['img'];
echo json_encode(['success' => true, 'post_url' => $post_url]);
?>