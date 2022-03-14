    <?php
    if (!defined('permit')) {
        exit('<br><br><br><h1>Error 404</h1><h2>Object not found!</h2>');
    }

    if (@$_SESSION['admin'] == "") {
        ?><script>window.location = '<?php echo root; ?>lgn';</script><?php
    }

    if (isset($_POST['editStd'])) {
        $stdReg = protect::check($conn, $_POST['stdReg']);
        $gs = crud::select('records', "WHERE regno='$stdReg'", $conn);
        $grow = mysqli_fetch_array($gs);
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
            <a class="navbar-brand" href="#pablo">Add Students Record</a>
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
                <h5 class="title">Add Record</h5>
              </div>
              <div class="card-body">
                <div style="border-radius: 0.1875rem; height: 350px;">
                  <form id="addStudRecfrm">
                    <div class="row">
                      <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label for="fname">Full Name</label>
                          <input type="text" class="form-control" name="fname" id="fname" placeholder="Full Name" <?php if (!empty($grow['name'])) { echo 'value="'.$grow['name'].'"'; } ?> required>
                        </div>
                      </div>
                      <div class="col-md-4 px-1">
                        <div class="form-group">
                          <label for="regno">Reg no</label>
                          <input type="text" class="form-control" name="regno" id="regno" placeholder="Reg no" <?php if (!empty($grow['regno'])) { echo 'value="'.$grow['regno'].'"'; } ?> required>
                        </div>
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label for="gender">Gender</label>
                          <select name="gender" id="gender" class="form-control" required>
                            <option value="">-- select gender --</option>
                            <option value="M" <?php if (!empty($grow['gender']) && ($grow['gender'] == 'M')) { echo 'selected'; } ?>>Male</option>
                            <option value="F" <?php if (!empty($grow['gender']) && ($grow['gender'] == 'F')) { echo 'selected'; } ?>>Female</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label for="sdep">Department</label>
                          <select name="sdep" id="sdep" class="form-control" required>
                            <option value="">-- select department --</option>
                            <?php
                            $q = crud::select('department', "ORDER BY depname ASC", $conn);
                            while ($rr = mysqli_fetch_array($q)) { ?>
                                <option value="<?php echo $rr[1]; ?>" <?php if (!empty($grow['dep']) && ($grow['dep'] == $rr[1])) { echo 'selected'; } ?>><?php echo $rr[1]; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 px-1">
                        <div class="form-group">
                          <label for="program">Programme</label>
                          <select name="program" id="program" class="form-control" required onchange="proProg(this.value);">
                            <option value="">-- select program --</option>
                            <option value="Higher National Diploma" <?php if (!empty($grow['program']) && ($grow['program'] == 'Higher National Diploma')) { echo 'selected'; } ?>>HND</option>
                            <option value="National Diploma" <?php if (!empty($grow['program']) && ($grow['program'] == 'National Diploma')) { echo 'selected'; } ?>>ND</option>
                            <option value="Ordinary Diploma" <?php if (!empty($grow['program']) && ($grow['program'] == 'Ordinary Diploma')) { echo 'selected'; } ?>>OND</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label for="stream">Stream</label>
                          <div id="mystream">
                            <select name="stream" id="stream" class="form-control" required>
                              <option value="">-- select stream --</option>
                              <option value="A" <?php if (!empty($grow['stream']) && ($grow['stream'] == 'A')) { echo 'selected'; } ?>>A</option>
                              <option value="B" <?php if (!empty($grow['stream']) && ($grow['stream'] == 'B')) { echo 'selected'; } ?>>B</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label for="class">Class</label>

                          <div id="myClasss">
                            <select name="class" id="class" class="form-control" required>
                              <option value="">-- select class --</option>
                              <option value="ND 1" <?php if (!empty($grow['class']) && ($grow['class'] == 'ND 1')) { echo 'selected'; } ?>>ND 1</option>
                              <option value="ND 2" <?php if (!empty($grow['class']) && ($grow['class'] == 'ND 2')) { echo 'selected'; } ?>>ND 2</option>
                              <option value="Dip 1" <?php if (!empty($grow['class']) && ($grow['class'] == 'Dip 1')) { echo 'selected'; } ?>>Dip 1</option>
                              <option value="Dip 2" <?php if (!empty($grow['class']) && ($grow['class'] == 'Dip 2')) { echo 'selected'; } ?>>Dip 2</option>
                              <option value="HND 1" <?php if (!empty($grow['class']) && ($grow['class'] == 'HND 1')) { echo 'selected'; } ?>>HND 1</option>
                              <option value="HND 2" <?php if (!empty($grow['class']) && ($grow['class'] == 'HND 2')) { echo 'selected'; } ?>>HND 2</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 px-1">
                        <div class="form-group">
                          <label for="Ssemester">Semester</label>
                          <select name="Ssemester" id="Ssemester" class="form-control" required>
                            <option value="">-- select semester --</option>
                            <option value="FIRST" <?php if (!empty($grow['semester']) && ($grow['semester'] == 'FIRST')) { echo 'selected'; } ?>>1st</option>
                            <option value="SECOND" <?php if (!empty($grow['semester']) && ($grow['semester'] == 'SECOND')) { echo 'selected'; } ?>>2nd</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label for="Ssession">Session</label>
                          <select name="Ssession" id="Ssession" class="form-control" required>
                            <option value="">-- select session --</option>
                            <?php
                            $y1 = 2019;
                            $y2 = 2020;
                            while (($y1 < date('Y')) && ($y2 <= date('Y'))) {
                                $y1++; $y2++;
                                ?>
                                <option value="<?php echo $y1.'/'.$y2; ?>" <?php if (!empty($grow['session']) && ($grow['session'] == $y1.'/'.$y2)) { echo 'selected'; } ?>><?php echo $y1.'/'.$y2; ?></option>
                                <?php
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label for="passport">Passport</label>
                          <input type="file" name="passport" id="passport" class="form-control">
                        </div>
                      </div>
                      
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <br>
                          <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                      </div>
                    </div>
                  </form>
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

        <form method="POST" action="card.php">
          <h3 class="text-center">Print Exam Card</h3>
          <div class="row">
            <div class="col-md-4">
              <select name="semester" id="semester" class="form-control" required>
                <option value="">-- select semester --</option>
                <option value="FIRST">1st</option>
                <option value="SECOND">2nd</option>
              </select><br>
            </div>

            <div class="col-md-4">
              <select name="session" id="session" class="form-control" required>
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

            <div class="col-md-4">
              <input type="text" name="regno" id="regno" class="form-control" placeholder="Reg no (optional)" onkeyup="stdReg(this.value);"><br>
            </div>

            <div class="col-md-4 tgs">
              <select name="dep" id="dep" class="form-control">
                <option value="">-- select department --</option>
                <?php
                $q = crud::select('department', "ORDER BY depname ASC", $conn);
                while ($rr = mysqli_fetch_array($q)) { ?>
                    <option value="<?php echo $rr[1]; ?>"><?php echo $rr[1]; ?></option>
                <?php } ?>
              </select><br>
            </div>

            <div class="col-md-4 tgs">
              <select name="stream" id="stream" class="form-control">
                <option value="">-- select stream --</option>
                <option value="A">A</option>
                <option value="B">B</option>
              </select><br>
            </div>

            <div class="col-md-4">
              <input type="submit" value="Submit" name="printEcard" class="btn btn-primary">
            </div>
          </div>
        </form>
      </div>
      