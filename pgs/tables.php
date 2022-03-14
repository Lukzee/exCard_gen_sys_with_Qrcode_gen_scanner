    <?php
    if (!defined('permit')) {
        exit('<br><br><br><h1>Error 404</h1><h2>Object not found!</h2>');
    }

    if (@$_SESSION['admin'] == "") {
        ?><script>window.location = '<?php echo root; ?>lgn';</script><?php
    }
    ?>

    <style>
      .form-control {
        height: 40px !important;
      }
    </style>

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
            <a class="navbar-brand" href="#pablo">Add New Admin / Inviglator</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            
          </div>
        </div>
      </nav>

      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>

      <div class="content">
        <form id="addNewAdmin">
          <br><br>
          <div class="row">
            <div class="col-md-4">
              <input type="text" id="afname" name="afname" class="form-control" placeholder="Full Name" required><br>
            </div>

            <div class="col-md-4">
              <input type="email" id="aEml" name="aEml" class="form-control" placeholder="Email" required><br>
            </div>

            <div class="col-md-4">
              <input type="password" id="apass" name="apass" class="form-control" placeholder="Password" required><br>
            </div>

            <div class="col-md-4">
              <select name="uTyppe" id="uTyppe" class="form-control" required>
                <option value=""> -- User level -- </option>
                <option value="admin">Admin</option>
                <option value="inviglator">Inviglator</option>
              </select><br>
            </div>

            <div class="col-md-4">
              <input type="submit" id="AddAdmin" value="Submit" class="btn btn-primary"><br>
            </div>
          </div>
        </form>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Admins / Inviglators</h4>
              </div>
              <div class="card-body">
                <div class="map" style="height: 45vh;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <tr>
                          <th>S/N</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Level</th>
                          <th>Actions</th>
                        </tr>
                      </thead>

                      <tbody id="all_d_adm"></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      