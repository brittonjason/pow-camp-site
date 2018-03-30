<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $pageTitle ?> | Camp Aliceville</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= BASE_URL ?>/public/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="<?= BASE_URL ?>">Camp Aliceville</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <?php if(isset($_SESSION['username'])): ?>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>">People</a></li>
            <li class="nav-item">Logged in as <strong><?= $_SESSION['username'] ?></strong></li>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/logout/">Logout</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/people/">People</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/locations/">Locations</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/login/">Login</a></li>
          <?php endif; ?>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
  </body>


