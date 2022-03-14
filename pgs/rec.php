    <?php
    if (!defined('permit')) {
        exit('<br><br><br><h1>Error 404</h1><h2>Object not found!</h2>');
    }

    if (@$_SESSION['admin'] == "") {
        ?><script>window.location = '<?php echo root; ?>lgn';</script><?php
    }
    ?>

    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">View Students Record</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-11">
            <div class="card">
              <div class="card-header">
                <h5 class="title">View Record</h5>
              </div>
              <div class="card-body">
                <div class="map" style="height: 63vh !important;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                          <tr>
                          <th>S/N</th>
                          <th>Name</th>
                          <th>Reg no</th>
                          <th>Actions</th>
                          </tr>
                      </thead>

                      <tbody id="all_d_rec"></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <style>
          .form-control {
            height: 40px !important;
          }
        </style>
      </div>