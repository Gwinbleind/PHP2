<?php
//Функции БД
function connectDB() {
    $db = @mysqli_connect('localhost:3306','geek','geek','gb_php') or Die('Ошибка соединения: ' . mysqli_connect_error());
    return $db;
}
function getArray($db, $query) {
    $queryObject = mysqli_query($db, $query);
    $queryArray = [];
    while ($row = mysqli_fetch_assoc($queryObject)) {
        $queryArray[] = $row;
    }
    return $queryArray;
}
function updateRow($db, $table, $condition, $rowData) {
    return mysqli_query($db, "UPDATE {$table} SET {$rowData} WHERE {$condition}");
}
function deleteRow($db, $table, $condition) {
    return mysqli_query($db, "DELETE FROM {$table} WHERE {$condition}");
}

function getFeedback($db, $imgID) {
    return getArray($db, "SELECT * FROM gallery_feedback WHERE img_id={$imgID} ORDER BY id DESC");
}
function getOneFeedback($db, $feedbackID) {
    return getArray($db, "SELECT * FROM gallery_feedback WHERE id={$feedbackID}")[0];
}
function editOneFeedback ($db, $id, $name, $text) {
    return updateRow($db, "gallery_feedback", "id={$id}", "name='{$name}',text='{$text}'");
}
function deleteFeedback ($db, $id) {
    return deleteRow($db,"gallery_feedback","id={$id}");
}

function getGallery($db) {
    return getArray($db, "SELECT * FROM gallery ORDER BY views DESC");
}
function getOneImg($db, $id) {
    return getArray($db, "SELECT `id`, `img`, `name`, `views` FROM `gallery` WHERE `id`={$id}")[0];
}
function viewsIncrement ($db, $id) {
    return updateRow($db, "gallery", "id={$id}", "views=views+1");
}
function insertNewRow($db, $name) {
    return mysqli_query($db, "INSERT INTO gallery (`id`, `img`, `prev`, `name`, `views`) VALUES (NULL, 'gallery/big/{$name}', 'gallery/small/{$name}', '{$name}', '0');");
}
function uploadNewImg($db, $img) {
    $tmp_path = $img["tmp_name"];
    $upload_path = GALLERY_DIR . $img["name"];
    $ext = strtolower(pathinfo($upload_path, PATHINFO_EXTENSION));

    if (in_array($ext, ALLOWED_EXTENSIONS)) {
        insertNewRow($db, $img["name"]);
        $resize_path = MINIATURE_DIR . $img["name"];

        if (move_uploaded_file($tmp_path, $upload_path)) {
            header("Location: /");
        } else {
            echo "Что-то пошло не так!<br>";
        }
        resizeImg($upload_path, $resize_path);
    }
}
function safeData($db, string $data) {
    return mysqli_real_escape_string($db, (string)htmlspecialchars(strip_tags($data)));
}

function getCatalog($db) {
    return getArray($db, "SELECT * FROM `catalog` ORDER BY id");
}
function getProductByID($db, $id) {
    return getArray($db, "SELECT * FROM `catalog` WHERE id={$id}")[0];
}