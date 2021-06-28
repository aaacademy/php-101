<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helper.php';
$connection = getConnection();
$id = @$_GET['id'];
if (!$id) {
    setFlash("Failed for read news", "alert alert-danger");

    header('Location: /');
} else {
    $sql = "SELECT * FROM news where id=?";
    $stmt= $connection->prepare($sql);
    $stmt->execute([$id]);

    $row = $stmt->fetch();
}
?>

<div class="card">
  <div class="card-header">
    <?=$row['title']?>
  </div>
  <div class="card-body">
    <p class="card-text"><?=$row['body']?></p>
  </div>
</div>