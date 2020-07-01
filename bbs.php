<?php

// connect DB
include_once __DIR__ . '/lib.php';
$bbs = new bbs();

// insert
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_submit'])) {
	// When the name and comment was entered
	if (isset($_POST['name']) && isset($_POST['comment'])) {
		// insert process
		$bbs->insert();	
	} else {
		// elaet
		echo '<script type="text/javascript">alert("There was an error writing");</script>';
	}
}

// select
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
        BBS Sample
      </h1>
      <div style="text-align: right; margin: -5rem 0 10px;">
        <button type="button" class="btn" onclick="location.href='./login.php'">
          <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Admin
        </button>
      </div>
    </div>

    <form name="bbs_post" action="" method="post" onSubmit="return checkSubmit()">
      <table class="table">
        <tbody>
           <tr>
            <th colspan="2">
              Post form
            </th>
          </tr>
          <tr>
            <th>Name</th>
            <td>
              <input type="text" name="name" class="form-control" placeholder="Please enter your name" pattern=".*\S+.*" required>
            </td>
          </tr>
          <tr>
            <th>Comment</th>
            <td>
              <textarea name="comment" placeholder="Please enter a comment" rows="3" class="form-control" required></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="pull-right">
               <input type="submit" class="btn btn-primary " name="post_submit" value="Submit">
               <input type="reset" class="btn btn-default" value="Clear">
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </form>

    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-sm-2 col-md-2 col-lg-2">Name</th>
          <th class="col-sm-6 col-md-6 col-lg-6">Comment</th>
          <th class="col-sm-2 col-md-2 col-lg-2">Post Date</th>
          <th class="col-sm-2 col-md-2 col-lg-2">Mod Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($result as $row) : ?>
          <tr class="row">
            <td><?= nl2br(htmlspecialchars($row['name'])) ?></td>
            <td><?= nl2br(htmlspecialchars($row['comment'])) ?></td>
            <td><?= htmlspecialchars($row['post_date']) ?></td>
            <td><?= htmlspecialchars($row['mod_date']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<script type="text/javascript" src="./alert.js"></script>
</body>
</html>