    <?php
    if (!defined('permit')) {
        exit('<br><br><br><h1>Error 404</h1><h2>Object not found!</h2>');
    }

    if (@$_SESSION['admin'] != "") {
        ?><script>window.location = '<?php echo root; ?>rec';</script><?php
    }

    if (@$_SESSION['inviglator'] != "") {
        ?><script>window.location = '<?php echo root; ?>ams';</script><?php
    }
    ?>

    <style>
      body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-image: url("<?php echo root; ?>assets/img/home-banner.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
      }

      .imgCon {
        height: 100vh;
        line-height: 100vh;
        text-align: center;
      }

      .cImg {
        text-align: center;
        display: inline-block;
        vertical-align: middle;
      }

      .mmmyLgnFrm {
        margin-top: 26vh;
        width: 60%;
        display: inline-block;
      }

      .form-control, .form-control::placeholder {
        color: beige;
        font-size: 20px;
      }
      
      @media (max-width: 770px) {
        body {
          overflow-y: scroll;
          padding-top: 30px;
          padding-bottom: 30px;
        }

        .mmmyLgnFrm {
          margin-top: 10vh;
        }

        .imgCon {
          height: auto;
          line-height: 0;
        }
      }
    </style>
    <div class="row">
      <div class="col-md-6">
        <div class="imgCon">
          <img src="<?php echo root; ?>assets/img/favicon.png" alt="" width="40%" class="cImg">
        </div>
      </div>

      <div class="col-md-6 text-center">
        <div class="mmmyLgnFrm" style="background-color: rgba(255,255,255,0.4); padding: 40px 20px; border-radius: 5px;">
          <h2 class="font-weight-bolder text-info">Log In</h2>

          <form id="Lgnform">
            <p class="alert-warning" id="Algnreply"></p>
            <input type="email" class="form-control" placeholder="Email" name="eml" id="eml" required><br>

            <input type="password" class="form-control" placeholder="Password" name="pass" id="pass" required><br>

            <button type="submit" class="btn btn-primary w-100">Sign in</button>
          </form>
        </div>
      </div>
    </div>