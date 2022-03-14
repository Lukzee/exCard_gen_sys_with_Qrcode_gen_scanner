      <?php 
      if (!defined('permit')) {
          exit('<br><br><br><h1>Error 404</h1><h2>Object not found!</h2>');
      }
      
      if (@$_GET['req'] != 'lgn') { ?>
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://lukzee.github.io/lukzeetech/" target="_blank">
                  <i class="fa fa-globe"></i> Resume
                </a>
              </li>

              <li>
                <a href="https://www.gitmemory.com/Lukzee/" target="_blank">
                  <i class="fa fa-laptop"></i> Playground
                </a>
              </li>

              <li>
                <a href="https://github.com/Lukzee" target="_blank">
                  <i class="fa fa-github-square"></i> GitHub
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed & Coded by <a href="https://lukzee.github.io/lukzeetech/" target="_blank">SoftBrein</a>.
          </div>
        </div>
      </footer>
    </div>

</div>
<?php } ?>
  <!--   Core JS Files   -->
  <script src="<?php echo root; ?>assets/js/core/jquery.min.js"></script>
  <script src="<?php echo root; ?>assets/js/core/popper.min.js"></script>
  <script src="<?php echo root; ?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?php echo root; ?>assets/bootstrap-select-1.13.14/js/bootstrap-select.js"></script>
  <script src="<?php echo root; ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Main JS -->
  <script src="<?php echo root; ?>main.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?php echo root; ?>assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo root; ?>assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?php echo root; ?>assets/demo/demo.js"></script>

  <script>
    // process program
    function proProg(data) {
      let streamOpt = '',
      classsOpt = '';
      
      if (data == 'Ordinary Diploma') {
        streamOpt = '<option value="B" <?php if (!empty($grow["stream"]) && ($grow["stream"] == "B")) { echo "selected"; } ?>>B</option>';

        classsOpt = '<option value="Dip 1" <?php if (!empty($grow["class"]) && ($grow["class"] == "Dip 1")) { echo "selected"; } ?>>Dip 1</option> <option value="Dip 2" <?php if (!empty($grow["class"]) && ($grow["class"] == "Dip 2")) { echo "selected"; } ?>>Dip 2</option>';
      } else {
        streamOpt = '<option value="A" <?php if (!empty($grow["stream"]) && ($grow["stream"] == "A")) { echo "selected"; } ?>>A</option> <option value="B" <?php if (!empty($grow["stream"]) && ($grow["stream"] == "B")) { echo "selected"; } ?>>B</option>';

        if (data == 'Higher National Diploma') {
          classsOpt = '<option value="HND 1" <?php if (!empty($grow["class"]) && ($grow["class"] == "HND 1")) { echo "selected"; } ?>>HND 1</option> <option value="HND 2" <?php if (!empty($grow["class"]) && ($grow["class"] == "HND 2")) { echo "selected"; } ?>>HND 2</option>';
        } else if (data == 'National Diploma') {
          classsOpt = '<option value="ND 1" <?php if (!empty($grow["class"]) && ($grow["class"] == "ND 1")) { echo "selected"; } ?>>ND 1</option> <option value="ND 2" <?php if (!empty($grow["class"]) && ($grow["class"] == "ND 2")) { echo "selected"; } ?>>ND 2</option>';
        }
      }

      $('#mystream').html('<select name="stream" id="stream" class="form-control" required> <option value="">-- select stream --</option> '+streamOpt+' </select>');

      $('#myClasss').html('<select name="class" id="class" class="form-control" required> <option value="">-- select class --</option> '+classsOpt+' </select>');
    }
  </script>
</body>

</html>