<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helper.php';
$connection = getConnection();

if(@$_POST['create']) { 
    $title  = @$_POST['title'];
    $slug   = slugify(@$_POST['title']);
    $body   = @$_POST['body'];
    $sql = <<<SQL
        INSERT into news(title, slug, body) 
        VALUES (?, ?, ?);
    SQL;
    $insert = $connection->prepare($sql);
    $insert->execute([
        $title,
        $slug,
        $body,
    ]);
    setFlash("Success for add news", "alert alert-success");
    header('location:/');
}
?>

<form method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="enter title">
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Content</label>
        <textarea name="body" placeholder="Enter body here..." class="form-control" id="body" rows="3"></textarea>
    </div>
    <input name="create" class="btn btn-success" type="submit" value="Save">
</form>