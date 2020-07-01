<?php

// Confirm session
require_once __DIR__ . '/session.php';
require_logined_session();

// connect DB
include_once __DIR__ . '/lib.php';
$bbs = new bbs();

// update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_submit'])) {
  // When the name and comment was entered
  if (isset($_POST['name']) && isset($_POST['comment'])) {
    // Update process
    $bbs->update();
  } else {
    // alert
    echo '<script type="text/javascript">alert("There was an error writing");</script>';
  }
}

// delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['del_submit'])) {
  $bbs->delete();
}

// all select
$result = $bbs->select();


?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <title>BBS Sample</title>
</head>

<body>
  <div class="container">
    <div class="page-header">
      <h1>
        Admin Page
      </h1>
      <div style="text-align: right; margin: -5rem 0 10px;">
        <button type="button" class="btn" onclick="location.href='./bbs.php'">
          <span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;&nbsp;Home
        </button>
        <button type="button" class="btn" onclick="location.href='./logout.php'">
          <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>&nbsp;&nbsp;Logout
        </button>
      </div>
    </div>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['edit'])) : ?>
      <form name="bbs_post" action="" method="post" onSubmit="return checkSubmit()">
        <table class="table">
          <tbody>
             <tr>
              <th colspan="2">
                Edit form
              </th>
            </tr>
            <tr>
              <th>Name</th>
              <td>
                <input type="text" name="name" class="form-control" value='<?= $_POST["name"]; ?>' pattern=".*\S+.*" required>
              </td>
            </tr>
            <tr>
              <th>Comment</th>
              <td>
                <textarea name="comment" rows="3" class="form-control" pattern=".*\S+.*" required><?= $_POST['comment'] ?></textarea>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <div class="pull-right">
                 <input type="submit" class="btn btn-primary" name="edit_submit" value="Submit">
                 <input type="submit" class="btn btn-danger" name="del_submit" value="Delete" onclick="return checkDelete()">
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <input type="hidden" name="id" value=<?= $_POST['id'] ?>>
      </form>
    <?php endif; ?>

    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-sm-2 col-md-2 col-lg-2">Name</th>
          <th class="col-sm-6 col-md-6 col-lg-6">Comment</th>
          <th class="col-sm-1 col-md-1 col-lg-1">Post Date</th>
          <th class="col-sm-1 col-md-1 col-lg-1">Mod Date</th>
          <th class="col-sm-1 col-md-1 col-lg-1">Edit</th>
          <th class="col-sm-1 col-md-1 col-lg-1">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($result as $row) : ?>
          <form name="edit" action="" method="post">
            <tr class="row">
              <td><?= nl2br(htmlspecialchars($row['name'])) ?></td>
              <td><?= nl2br(htmlspecialchars($row['comment'])) ?></td>
              <td><?= htmlspecialchars($row['post_date']) ?></td>
              <td><?= htmlspecialchars($row['mod_date']) ?></td>
              <td>
                <input type="submit" class="btn btn-warning btn-sm" name="edit" value="Edit">
              </td>
              <td>
                <input type="submit" class="btn btn-danger" name="del_submit" value="Delete" onclick="return checkDelete()">
              </td>
            </tr>
            <input type="hidden" name="id" value=<?= htmlspecialchars($row['id']) ?>>
            <input type="hidden" name="name" value=<?= htmlspecialchars($row['name']) ?>>
            <input type="hidden" name="comment" value=<?= htmlspecialchars($row['comment']) ?>>
          </form>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<script type="text/javascript" src="./alert.js"></script>
</body>
</html>