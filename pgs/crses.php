<?php
    if (!defined('permit')) {
        exit('<br><br><br><h1>Error 404</h1><h2>Object not found!</h2>');
    }

    if (@$_SESSION['admin'] == "") {
        ?><script>window.location = '<?php echo root; ?>lgn';</script><?php
    }

    if (isset($_POST['editCrs'])) {
        $dcCode = protect::check($conn, $_POST['dcCode']);
        $gs = crud::select('courses', "WHERE cCode='$dcCode'", $conn);
        $grow = mysqli_fetch_array($gs);
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
            <a class="navbar-brand" href="#pablo">Add New Courses</a>
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
        <form id="addNewCrss">
          <br><br>
          <div class="row">
            <div class="col-md-3">
              <input type="text" id="cCode" name="cCode" class="form-control" placeholder="Course Code" <?php if (!empty($grow['cCode'])) { echo 'value="'.$grow['cCode'].'"'; } ?> required><br>
            </div>

            <div class="col-md-4">
              <input type="text" id="cTitle" name="cTitle" class="form-control" placeholder="Course Title" <?php if (!empty($grow['cTitle'])) { echo 'value="'.$grow['cTitle'].'"'; } ?> required><br>
            </div>

            <div class="col-md-2">
              <input type="text" id="cUnits" name="cUnits" class="form-control" placeholder="Units" <?php if (!empty($grow['cUnit'])) { echo 'value="'.$grow['cUnit'].'"'; } ?> required><br>
            </div>

            <div class="col-md-3">
                <select name="cSemester" id="cSemester" class="form-control" required>
                    <option value="">-- select semester --</option>
                    <option value="FIRST" <?php if (!empty($grow['cSemester']) && ($grow['cSemester'] == 'FIRST')) { echo 'selected'; } ?>>1st</option>
                    <option value="SECOND" <?php if (!empty($grow['cSemester']) && ($grow['cSemester'] == 'SECOND')) { echo 'selected'; } ?>>2nd</option>
                </select><br>
            </div>

            <div class="col-md-4">
                <select name="cdep" id="cdep" class="form-control" required>
                    <option value="">-- select department --</option>
                    <?php
                    $q = crud::select('department', "ORDER BY depname ASC", $conn);
                    while ($rr = mysqli_fetch_array($q)) { ?>
                        <option value="<?php echo $rr[1]; ?>" <?php if (!empty($grow['cdep']) && ($grow['cdep'] == $rr[1])) { echo 'selected'; } ?>><?php echo $rr[1]; ?></option>
                    <?php } ?>
                </select><br>
            </div>

            <div class="col-md-4">
                <select name="cClass" id="cClass" class="form-control" required>
                    <option value="">-- select class --</option>
                    <option value="ND 1" <?php if (!empty($grow['cClass']) && ($grow['cClass'] == 'ND 1')) { echo 'selected'; } ?>>ND 1</option>
                    <option value="ND 2" <?php if (!empty($grow['cClass']) && ($grow['cClass'] == 'ND 2')) { echo 'selected'; } ?>>ND 2</option>
                    <option value="Dip 1" <?php if (!empty($grow['cClass']) && ($grow['cClass'] == 'Dip 1')) { echo 'selected'; } ?>>Dip 1</option>
                    <option value="Dip 2" <?php if (!empty($grow['cClass']) && ($grow['cClass'] == 'Dip 2')) { echo 'selected'; } ?>>Dip 2</option>
                    <option value="HND 1" <?php if (!empty($grow['cClass']) && ($grow['cClass'] == 'HND 1')) { echo 'selected'; } ?>>HND 1</option>
                    <option value="HND 2" <?php if (!empty($grow['cClass']) && ($grow['cClass'] == 'HND 2')) { echo 'selected'; } ?>>HND 2</option>
                </select><br>
            </div>

            <div class="col-md-4">
              <input type="submit" value="Submit" class="btn btn-primary"><br>
            </div>
          </div>
        </form>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Courses</h4>
              </div>
              <div class="card-body">
                <div class="map" style="height: 45vh;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <tr>
                          <th>S/N</th>
                          <th>Course Code</th>
                          <th>Course Title</th>
                          <th>Unit</th>
                          <th>Dept.</th>
                          <th>Level</th>
                          <th>Semester</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody id="all_d_crs"></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      