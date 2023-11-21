<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: index.php");
  exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if username is empty
  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter username.";
  } else {
    $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate credentials
  if (empty($username_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Set parameters
      $param_username = $username;

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);

        // Check if username exists, if yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1) {
          // Bind result variables
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
          if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $hashed_password)) {
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;

              if ($username == "admin_jommasuk") {
                header("location: admin/index.php");
              } else {
                // Redirect user to welcome page
                header("location: index.php");
              }
            } else {
              // Password is not valid, display a generic error message
              $login_err = "Invalid username or password.";
            }
          }
        } else {
          // Username doesn't exist, display a generic error message
          $login_err = "Invalid username or password.";
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="Kitab Intergrated Management System" content="" />
  <meta name="Badrul Hisham - Unit IT KITAB" content="" />
  <title>Jommasuk - Login</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    .back {
      background-image: url(assets/img/quran.jpg);
      background-size: cover;
    }
  </style>
</head>

<body class="back">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <!--login container-->
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">
                    Jommasuk Login
                  </h3>
                </div>
                <?php
                if (!empty($login_err)) {
                  echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }
                ?>
                <div class="card-body">
                  <h6 class="text-center">Sebelum daftar sila rujuk panduan penggunaan JomMasuk <a href="documentation/documentation.html">di sini</a></h6>
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-floating mb-3">
                      <input type="text" name="username" class="form-control" placeholder="Test" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?> value="<?php echo $username; ?>">
                      <label class="small mb-1" for="inputEmail">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" name="password" class="form-control" placeholder="Test" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>>
                      <label class="small mb-1" for="inputPassword">Password</label>
                    </div>
                    <!-- <div class="form-check mb-3">
                      <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                      <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                    </div> -->
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                      <!--<a class="small" href="password.html">Forgot Password?</a>-->
                      <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center py-3">
                  <div class="small">
                    <a href="registration.php">Belum daftar akaun? Daftar Sekarang!</a><br>
                    <a href="https://wa.me/60193932471">Lupa username / password ? Hubungi IT</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <!--footer-->
    <div id="layoutAuthentication_footer">
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Jommasuk 2023</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!--/footer-->
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script>
    function validation() {
      var id = document.f1.userEmail.value;
      var ps = document.f1.userPassword.value;
      if (id.length == "" && ps.length == "") {
        alert("User Name and Password fields are empty");
        return false;
      } else {
        if (id.length == "") {
          alert("User Name is empty");
          return false;
        }
        if (ps.length == "") {
          alert("Password field is empty");
          return false;
        }
      }
    }
  </script>
</body>

</html>