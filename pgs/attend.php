<?php
    if (!defined('permit')) {
        exit('<br><br><br><h1>Error 404</h1><h2>Object not found!</h2>');
    }

    if (@$_SESSION['inviglator'] == "") {
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
            <a class="navbar-brand" href="#pablo">Attendance Management</a>
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
        <form>
          <br><br>
          <div class="row">
            <div class="col-md-3">
              <select name="atSession" id="atSession" class="form-control" required>
                <option value="">-- select session --</option>
                <?php
                $y1 = 2019;
                $y2 = 2020;
                while (($y1 < date('Y')) && ($y2 <= date('Y'))) {
                    $y1++; $y2++;
                    ?>
                    <option value="<?php echo $y1.'/'.$y2; ?>"><?php echo $y1.'/'.$y2; ?></option>
                    <?php
                }
                ?>
              </select><br>
            </div>

            <div class="col-md-3">
              <select name="atSemester" id="atSemester" class="form-control" onchange="proFetchCrss();" required>
                <option value="">-- select semester --</option>
                <option value="FIRST">1st</option>
                <option value="SECOND">2nd</option>
              </select><br>
            </div>

            <div class="col-md-3">
              <select name="atDep" id="atDep" class="form-control" onchange="proFetchCrss();" required>
                <option value="">-- select department --</option>
                <?php
                $q = crud::select('department', "ORDER BY depname ASC", $conn);
                while ($rr = mysqli_fetch_array($q)) { ?>
                    <option value="<?php echo $rr[1]; ?>"><?php echo $rr[1]; ?></option>
                <?php } ?>
              </select><br>
            </div>

            <div class="col-md-3">
              <select name="atClass" id="atClass" class="form-control" onchange="proFetchCrss();" required>
                <option value="">-- select class --</option>
                <option value="ND 1">ND 1</option>
                <option value="ND 2">ND 2</option>
                <option value="Dip 1">Dip 1</option>
                <option value="Dip 2">Dip 2</option>
                <option value="HND 1">HND 1</option>
                <option value="HND 2">HND 2</option>
              </select><br>
            </div>
            
            <div class="col-md-3" id="myAtCrss">
              <select name="atCourse" id="atCourse" class="form-control" required>
                <option value="">-- select course --</option>
              </select><br>
            </div>

            <div class="col-md-3">
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
                <div class="map" style="height: 40vh; overflow-y: hidden;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      