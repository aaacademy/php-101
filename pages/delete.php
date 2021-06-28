<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helper.php';
$connection = getConnection();
$id = @$_GET['id'];
if (!$id) {
    setFlash("Failed for delete news", "alert alert-danger");
    header('Location: /');
} else ($id) { 
    $sql = "DELETE FROM news WHERE id=?";
    $stmt= $connection->prepare($sql);
    $stmt->execute([$id]);
    setFlash("Success for delete news with id $id", "alert alert-success");
    header('location:/');
}
?>