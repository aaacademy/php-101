<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helper.php';
$connection = getConnection();
$search = @$_GET['q'] != null ? @$_GET['q'] : '' ;
$sql = "SELECT * FROM news WHERE title LIKE ? OR body LIKE ? ORDER BY id DESC";
$statement= $connection->prepare($sql);
$statement->execute(['%'.$search.'%', '%'.$search.'%']);
$rows = $statement->fetchAll();
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Body</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $number = 1;
    foreach ($rows as $row) : ?>
    <tr>
        <th scope="row"><?= $number; $number++?></th>
        <td><?= $row['title']?></td>
        <td><?= readMore($row['body'], 30)?></td>
        <td>
            <a class="btn btn-info" href="?page=read&id=<?= $row['id']; ?>">Detail</a>
            <a class="btn btn-primary" href="?page=update&id=<?= $row['id']; ?>">Update</a>
            <a class="btn btn-danger" href="?page=delete&id=<?= $row['id']; ?>">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>