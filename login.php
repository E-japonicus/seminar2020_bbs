<?php

// Confirm session
require_once __DIR__ . '/session.php';
require_unlogined_session();

// Array of password hashes generated in advance for each user
$hashes = [
    'admin' => '$2y$10$hf6hy9Fx5QPehwxoxIcxOenY7uV48Bl.L2PFT35YA78Nmgj8oJDia',
]; 

// Username and password received from the user
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        password_verify(
            $password,
            isset($hashes[$username])
                ? $hashes[$username]
                : '$2y$10$hf6hy9Fx5QPehwxoxIcxOenY7uV48Bl' // Prevent from getting extremely fast only when the user name does not exist
        )
    ) {
        // Prevent session ID tracking
        session_regenerate_id(true);
        $_SESSION['username'] = $username;
        header('location: ./admin.php');
        exit;
    }
    // When authentication fails
    echo '<script type="text/javascript">alert("Username or password is different");</script>';
}

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
        Sign In
      </h1>
      <div style="text-align: right; margin: -5rem 0 10px;">
        <button type="button" class="btn" onclick="location.href='./bbs.php'">
          <span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;&nbsp;Home
        </button>
      </div>
    </div>

    <form name="login_post" action="" method="post">
      <table class="table">
        <tbody>
          <tr>
            <th>Username</th>
            <td>
              <input type="text" name="username" class="form-control" placeholder="Username" required>
            </td>
          </tr>
          <tr>
            <th>Password</th>
            <td>
              <input type="password" name="password" class="form-control" placeholder="Password" required>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="pull-right">
                <input type="submit" class="btn btn-success" name="login_submit" value="Login">
                <input type="reset" class="btn btn-default" value="Clear">
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>

</body>
</html>