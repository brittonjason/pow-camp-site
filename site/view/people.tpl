<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/css/listing.css" />

<body>

  <main role="main">

    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading">POWs</h1>
        <p class="lead text-muted">Records of POWs who were put into Camp Aliceville.</p>
        <p>
          <a href="#" class="btn btn-primary my-2">Main call to action</a>
          <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p>
      </div>
    </section>

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row">

        <?php foreach($list as $person): ?>
          <div class="col-md-4">
            <div class="card mb-4 box-shadow">
              <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
              <div class="card-body">
                <p class="card-text"><?= $person->name ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <?php $nm = ucwords(str_replace(" ", "_", $person->name)); ?>
                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="<?= BASE_URL ?>/people/<?= $nm ?>">View</a></button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
          
        </div>

      </div>
    </div>

  </main>

  <script src="<?= BASE_URL ?>/public/js/holder.min.js"></script>