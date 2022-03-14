<?php
require_once 'connection.php';
require_once 'path.php';
require_once 'class/crud_class.php';
require_once 'class/dprot_class.php';

if (isset($_POST['printEcard'])) {
    $semester = protect::check($conn, $_POST['semester']);
    $session = protect::check($conn, $_POST['session']);
    $regno = protect::check($conn, $_POST['regno']);
    $dep = protect::check($conn, $_POST['dep']);
    $stream = protect::check($conn, $_POST['stream']);

    if (!empty($regno)) {
        $arg = "WHERE semester='$semester' AND session='$session' AND regno='$regno'";
    } else {
        $arg = "WHERE semester='$semester' AND session='$session' AND dep='$dep' AND stream='$stream' ORDER BY name ASC";
    }

    # QRcode Generator
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "QRcode/qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);

    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'H';
    $matrixPointSize = 4;

    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>
            EXAM CARD
        </title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
        <!-- CSS Files -->
        <link href="<?php echo root; ?>assets/css/bootstrap.min.css" rel="stylesheet" />

        <style>
            body {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                padding-top: 60px !important;
                padding-bottom: 60px !important;
                overflow-x: hidden;
            }

            html {
                font-family: sans-serif;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }

            .container {
                border: 1px solid black;
                padding: 40px;
                margin-bottom: 60px !important;
            }

            .m-f-r {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                margin-right: 15px;
                margin-left: 15px;
            }

            .mfr-22 {
                -ms-flex: 0 0 22%;
                flex: 0 0 22%;
                max-width: 22%;
            }
            
            .mfr-78 {
                -ms-flex: 0 0 78%;
                flex: 0 0 78%;
                max-width: 78%;
            }

            .mfr-60 {
                -ms-flex: 0 0 60%;
                flex: 0 0 60%;
                max-width: 60%;
            }

            .mfr-40 {
                -ms-flex: 0 0 40%;
                flex: 0 0 40%;
                max-width: 40%;
            }

            .mfr-20 {
                -ms-flex: 0 0 20%;
                flex: 0 0 20%;
                max-width: 20%;
            }

            .mfr-50 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%;
            }

            .mfr-13 {
                -ms-flex: 0 0 13%;
                flex: 0 0 13%;
                max-width: 13%;
            }
            .mfr-37 {
                -ms-flex: 0 0 37%;
                flex: 0 0 37%;
                max-width: 37%;
            }

            @media print {
                .btn {
                    display: none;
                }

                .container {
                    width: 100vw;
                    height: 100vh;
                    border: 0px;
                    padding: 40px;
                    margin-bottom: 0px !important;
                }
            }

            * {
                -webkit-print-color-adjust:exact !important;
                color-adjust: exact !important;
            }
        </style>
        </head>

        <body>
            <input type="button" value="PRINT" class="btn btn-primary" onclick="javascript:print();">
            <a href="<?php echo root; ?>rec" class="btn btn-primary">Back</a>
    <?php
        
    $q = crud::select('records', $arg, $conn);
    while ($r = mysqli_fetch_array($q)) {
        
        
        $filename = $PNG_TEMP_DIR.$r['name'].'.png';
        
        //default data    
        QRcode::png($r['name'].", ".$r['regno'].", ".$r['dep'].", ".$r['class'].$r['stream'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        ?>
            <div class="container" style="background-color:white;">
                <div class="m-f-r">
                    <div class="mfr-22">
                        <img src="<?php echo root; ?>assets/img/favicon.png" width="60px" alt="">
                    </div>
                    <div class="mfr-78 text-center">
                        <h5>THE FEDERAL POLYTECHNIC, BAUCHI</h5>
                        <h6>PMB 0231, BAUCHI</h6>
                        <p>info@fptb.edu.ng | www.fptb.edu.ng</p>
                    </div>
                </div>
                <p class="text-center" style="background-color:black; color:beige"><strong><?php echo $r['semester']. ' SEMESTER, '. $r['session'].' EXAMINATION SLIP'; ?></strong></p>

                <div class="m-f-r">
                    <div class="mfr-60">
                        <div class="m-f-r">
                            <div class="mfr-20">
                                <p>Reg. Number: <br>
                                <strong><?php echo $r['regno']; ?></strong></p>
                            </div>
                            <div class="mfr-60">
                                <p>Full Name: <br>
                                <strong><?php echo $r['name']; ?></strong></p>
                            </div>
                            <div class="mfr-20">
                                <p>Gender: <br>
                                <strong><?php echo $r['gender']; ?></strong></p>
                            </div>
                        </div>
                        <hr>

                        <div class="m-f-r">
                            <div class="mfr-20">
                                <p>Department: <br>
                                <strong><?php echo $r['dep']; ?></strong></p>
                            </div>
                            <div class="mfr-60">
                                <p>Programme of Study: <br>
                                <strong><?php echo $r['program'] .' in '. $r['dep']. ' ( '.$r['stream'].')'; ?></strong></p>
                            </div>
                            <div class="mfr-20">
                                <p>Class: <br>
                                <strong><?php echo $r['class']; ?></strong></p>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="mfr-40">
                        <div class="m-f-r">
                            <div class="mfr-50" style="padding-right:10px;"><img src="<?php echo $r['passport']; ?>" alt="" width="100%" height="200px"></div>
                            <div class="mfr-50" style="border: 1px solid black; padding:40px;"><p >Affix Recent Passport</p></div>
                        </div>
                    </div>
                </div>

                <p style="border-bottom: 3px solid black;"></p>
                <h6 class="text-center"><strong>Registered Courses</strong></h6><br>

                <div class="">
                    <table class="table">
                      <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Course Unit</th>
                            <th>Inviglator Date/Sign</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $crs = explode(',', $r['courses_id']);
                        $i=0;
                        $tt =0;
                        foreach ($crs as $cs) {
                            $i++;
                            $q2 = crud::select('courses', "WHERE id='$cs'", $conn);
                            $a = mysqli_fetch_array($q2);
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $a['cCode']; ?></td>
                                <td><?php echo $a['cTitle']; ?></td>
                                <td><?php echo $a['cUnit']; ?></td>
                                <td>|</td>
                            </tr>
                            <?php
                            $tt = $tt+$a['cUnit'];
                        }
                        ?>
                      </tbody>
                    </table><hr>
                    <div class="m-f-r">
                        <div class="mfr-50"></div>
                        <div class="mfr-13">Total Unit: </div>
                        <div class="mfr-37"><?php echo $tt; ?></div>
                    </div>
                    <hr>
                    <p style="border-bottom: 3px solid black;"></p>

                    <div class="m-f-r text-center">
                        <div class="mfr-20">
                            <?php
                            echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" />';
                            ?>
                        </div>
                        <div class="mfr-40">
                            <br><br>
                            <p style="width: 60%; display:inline-block; border-bottom: 1px solid black;"></p>
                            <p>Student's Sign. & Date</p>
                        </div>
                        <div class="mfr-40">
                            <br><br>
                            <p style="width: 60%; display:inline-block; border-bottom: 1px solid black;"></p>
                            <p>HOD Sign., Stamp & Date</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    ?>
    <!--   Core JS Files   -->
    <script src="<?php echo root; ?>assets/js/core/jquery.min.js"></script>
    <script src="<?php echo root; ?>cdnjs/html2canvas.js"></script>
    <script src="<?php echo root; ?>jsPDF-1.0.272/dist/jspdf.debug.js"></script>
    <script src="<?php echo root; ?>custom.js"></script>
    </body>

    </html>
    <?php
}

?>