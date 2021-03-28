<?php
  session_start();
  include "config.php";

  // login with cookie
  if(isset($_POST['logout'])) {
    if(isset($_SESSION['session_name'])) {
      unset($_SESSION['session_name']);
      session_destroy();
    }
    setcookie('user', '', time()-3600, '/');
    header('location: /tutorial/');
  }

  if (isset($_POST['session_name'])) {
    setcookie('user', $_POST['session_name'], time()+86400*365, '/');
    header('location: /tutorial/');
  }

  if (isset($_COOKIE['user'])) {
    $_SESSION['session_name'] = $_COOKIE['user'];
  } else {
    if(isset($_SESSION['session_name'])) {
      unset($_SESSION['session_name']);
      session_destroy();
    }
    include "login.php";
    exit();
  }

  echo "<ul>";
  foreach(get_users() as $user) {
    echo "<li>$user</li>";
  }
  echo "</ul>";

  function get_users() {
    try {
      $conn = new PDO(
        "mysql:host=".$GLOBALS['dbhost'].";dbname=".$GLOBALS['dbname'].";",
        $GLOBALS['dbuser'],
        $GLOBALS['dbpassword'] 
      );
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stm = $conn->prepare("SELECT * FROM utenti");
      $stm->execute([]);
      $utenti_name = [];
      while($row = $stm->fetch(PDO::FETCH_ASSOC)){
        array_push($utenti_name, $row['name']);
      }
      return $utenti_name;
    } catch(PDOException $e) {
      echo $e->getMessage();
      return array();
    }
  }

?>


<!DOCTYPE html>
<html>

<head>
  <title>Tutorial</title>
  <meta name="author" content="Dmytro Tkach" />
  <meta name="description" content="Questo è un sito tutorial generico" />
  <meta name="keywords" content="tutorial, html, javascript, jquery, php" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>

<body>
  <header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <div class="text-white">BENVENUTO <?php echo $user == "" ? "GUEST" : strtoupper($user) ?></div>
          <div class="px-4 text-white">
            <form action="/tutorial/" method="post">
              <input type="text" name="logout" value="true" hidden>
              <input class="btn btn-outline-success" type="submit" value="Logout">
            </form>
          </div>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

  </header>
  <div class="tutorial-form container my-5">
    <!-- Form -->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="check">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-primary">Reset</button>
    </form>
    <!-- End Form -->

    <!-- Accordion -->
    <div class="accordion my-5" id="serverData">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            SERVER DATA & FORM SUBMIT RESULT
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#serverData">
          <div class="accordion-body">
            <?php include "php-result.php" ?>
          </div>
        </div>
      </div>
    </div>
    <!-- End Accordion -->

    <!-- Accordion -->
    <div class="accordion my-5" id="fileData">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            FILE DATA 
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#fileData">
          <div class="accordion-body">
            <?php include "read-file.php" ?>
          </div>
        </div>
      </div>
    </div>
    <!-- End Accordion -->

    <!-- Form file-->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="formFile" class="form-label">Carica un file</label>
        <input class="form-control" type="file" id="formFile" name="file">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-primary">Reset</button>
    </form>
    <!-- End Form file-->

  </div>

    
    <div id="uploadsFile" class="mx-5"><?php include "uploads.php" ?></div>


  <footer>

  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>