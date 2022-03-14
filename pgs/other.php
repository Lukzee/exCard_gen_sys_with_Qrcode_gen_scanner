    <?php
    if (!defined('permit')) {
        exit('<br><br><br><h1>Error 404</h1><h2>Object not found!</h2>');
    }

    if (@$_SESSION['admin'] == "" && @$_SESSION['inviglator'] == "") {
        ?><script>window.location = '<?php echo root; ?>lgn';</script><?php
    }

    if (!empty($_SESSION['admin'])) {
      $online = $_SESSION['admin'];
    } elseif (!empty($_SESSION['inviglator'])) {
      $online = $_SESSION['inviglator'];
    }

    $reply = '';

    if (isset($_POST['submitBtn'])) {
        $oldpass = md5(protect::check($conn, $_POST['oldPass']));
        $newpass = md5(protect::check($conn, $_POST['newPass']));
        $cnewpass = md5(protect::check($conn, $_POST['cNewPass']));

        if (!empty($oldpass) && !empty($newpass) && !empty($cnewpass)) {
            if ($newpass == $cnewpass) {
                $q1 = crud::select('admin', "WHERE user='$online' AND pass='$oldpass'", $conn);
                if (mysqli_num_rows($q1) == 1) {
                    if (crud::update('admin', "pass='$newpass' WHERE user='$online'", $conn)) {
                        $reply = 'Password changed successfully...';
                    } else {
                        $reply = 'Error occured';
                    }
                } else {
                    $reply = 'Old password is not correct!';
                }
            } else {
                $reply = 'New password did not match!';
            }
        } else {
            $reply = 'Fill all the required fields pls!';
        }
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
            <a class="navbar-brand" href="#pablo">Setting</a>
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
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                Change Password
              </div>
              <div class="card-body ">
                <div class="map">
                  <br>
                  <form method="POST" action="">
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-4"><p class="alert-warning text-center"><?php echo $reply; ?></p></div>
                      <div class="col-md-6"></div>
                      <div class="col-md-4">
                        <input type="password" name="oldPass" id="oldPass" class="form-control" placeholder="Old Password" required><br>

                        <input type="password" name="newPass" id="newPass" class="form-control" placeholder="New Password" required><br>
                      </div>
                      
                      <div class="col-md-4">
                        <input type="password" name="cNewPass" id="cNewPass" class="form-control" placeholder="Confirm New Password" required><br>

                        <input type="submit" name="submitBtn" class="btn btn-primary" value="Change">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      