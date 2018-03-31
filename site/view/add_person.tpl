<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/css/add_person.css" />

<body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <h2>Add a person</h2>
      </div>

      <div class="row">
        <div class="col-md-12 order-md-1">
          <form class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name" value="" required>
                <div class="invalid-feedback">
                    Valid name is required.
                </div>
            </div>

            <div class="mb-3">
              <label for="dc">Date captured <span class="text-muted">(Optional)</span></label>
              <div class="input-group">
                <input type="date" class="form-control" id="dc" placeholder="yyyy-mm-dd">
              </div>
            </div>

            <div class="mb-3">
              <label for="age">Age when captured <span class="text-muted">(Optional)</span></label>
              <input type="number" class="form-control" id="age" placeholder="Age">
            </div>

            <div class="mb-3">
              <label for="etc">About this person <span class="text-muted">(Optional)</span></label>
              <textarea class="form-control" id="etc" placeholder=""></textarea>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" id="addPersonButton" type="submit">Add this person</button>
          </form>

          <div id="successMessage"></div>

        </div>
      </div>
    </div>

    <script src="<?= BASE_URL ?>/public/js/holder.min.js"></script>

    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>