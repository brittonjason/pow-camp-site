<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/css/person.css" />

<body>

<div class="container">

  <h1 class="my-4"><?= $person->name ?></h1>

  <div class="row">

    <div class="col-md-4">
      <img class="img-fluid" src="http://placehold.it/750x500" alt="">
    </div>

    <div class="col-md-8">
      <h3 class="my-3">Details</h3>
      <p>
        <?php if ($person->date_captured != null): ?>
            Date captured <?= $person->date_captured ?><br>
        <?php endif; ?>            
        <?php if ($person->age != null): ?>
            Age when captured <?= $person->age ?><br>
        <?php endif; ?>
      </p>
      <h3 class="my-3">About</h3>
      <p>
        <?php if ($person->etc != null): ?>
            <?= $person->etc ?>
        <?php endif; ?>
      </p>
    </div>

  </div>
  <!-- /.row -->
 
</div>
<!-- /.container -->


<script src="<?= BASE_URL ?>/public/js/holder.min.js"></script>