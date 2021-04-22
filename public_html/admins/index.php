<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>APPLICATION DE GESTION DE NOTE</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="../templates/css/bootstrap.css">
  <link rel="stylesheet" href="../templates/css/stick.css">
</head>

<body>

  <div class="containet">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top mb-4">
      <a class="navbar-brand" href="#">GESTION NOTES</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active mr-2">
              <a class="nav-link btn btn-info" href="/inscription">Inscription </a>
          </li>
          <li class="nav-item active">
              <a class="nav-link btn btn-outline-info" href="/connection">Connection </a>
          </li>
        </ul>

      </div>
    </nav>
  </div>

  <div class="container " style="margin-top: 75px;">
    <div class="row">
      <?=$contents;?>
    </div>
  </div>
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
        <span class="text-muted font-weight-bolder "> © <?=date("Y")?> APPLICATION DE GESTION DES NOTES REALISER PAR SERGE & HARLEN.</span>

        </div>
      </div>
    </div>
  </footer>
  <script src="../templates/js/jquery.min.js"></script>
  <script src="../templates/js/popper.min.js"></script>
  <script src="../templates/js/bootstrap.js"></script>
  <script src="../templates/js/app.js"></script>
</body>

</html>