<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helper.php';
$connection = getConnection();
$id = @$_GET['id'];
if (!$id) {
    setFlash("Failed for edit news", "alert alert-danger");

    header('Location: /');
} else {
    $sql = "SELECT * FROM news where id=?";
    $stmt= $connection->prepare($sql);
    $stmt->execute([$id]);

    $row = $stmt->fetch();

    if(@$_POST['update']) { 
        $title  = @$_POST['title'];
        $slug   = slugify(@$_POST['title']);
        $body   = @$_POST['body'];

        $sql = <<<SQL
            UPDATE news
            set title=?, slug=?, body=? 
            WHERE id=?;
        SQL;

        $update = $connection->prepare($sql);
        $update->execute([
            $title,
            $slug,
            $body,
            $id,
        ]);

        setFlash("Success for update news", "alert alert-success");
        header('location:/');
    }
}
?>

<form method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" id="title" value="<?= $row['title']?>">
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Content</label>
        <textarea name="body" class="form-control" id="body" rows="3"><?=$row['body']?></textarea>
    </div>
    <input name="update" class="btn btn-success" type="submit" value="Save">
</form>