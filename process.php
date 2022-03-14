<?php
require_once 'connection.php';
require_once 'path.php';
require_once 'class/crud_class.php';
require_once 'class/dprot_class.php';

//admin sign in
if(isset($_POST['pass'])){
    $email = protect::check($conn, $_POST['eml']);
    $pass = md5(protect::check($conn, $_POST['pass']));
    
    $ar = "WHERE user= '$email' AND pass='$pass'";
    
    $qu = crud::select('admin', $ar, $conn);
    if (mysqli_num_rows($qu) == 1) {
        $rw = mysqli_fetch_array($qu);

        if ($rw['uType'] == 'admin') {
            $_SESSION['admin'] = $rw['user'];
        } elseif ($rw['uType'] == 'inviglator') {
            $_SESSION['inviglator'] = $rw['user'];
        }

        echo 'success';
        
    } else {
        echo 'incorrect email or password';
    }
}

//add record
if (isset($_POST['fname'])) {
    $fname = protect::check($conn, $_POST['fname']);
    $regno = protect::check($conn, $_POST['regno']);
    $gender = protect::check($conn, $_POST['gender']);
    $sdep = protect::check($conn, $_POST['sdep']);
    $program = protect::check($conn, $_POST['program']);
    $stream = protect::check($conn, $_POST['stream']);
    $class = protect::check($conn, $_POST['class']);
    $Ssemester = protect::check($conn, $_POST['Ssemester']);
    $Ssession = protect::check($conn, $_POST['Ssession']);

    if (!empty($fname) && !empty($regno) && !empty($gender) && !empty($sdep) && !empty($program) && !empty($stream) && !empty($Ssemester) && !empty($class) && !empty($Ssession)) {
        $args1 = "WHERE regno='$regno'";
        $q = crud::select('records', $args1, $conn);

        if (mysqli_num_rows($q) == 0) {
            # new records
            $location='';
            if($_FILES["passport"]["name"] != '') {
            $test = explode('.', $_FILES["passport"]["name"]);
            $ext = end($test);
            $name = rand(100, 999) . '.' . $ext;
            $location = 'upload/' . $name;
            move_uploaded_file($_FILES["passport"]["tmp_name"], $location);

            $location = SERVER_NAME.$location;
            }
 
            $args = "regno='$regno',name='$fname',gender='$gender',dep='$sdep',program='$program',stream='$stream',class='$class',semester='$Ssemester',session='$Ssession',passport='$location'";
            if (crud::insert('records', $args, $conn)) {
                echo 'Saved';
            } else {
                echo 'error occur!';
            }
        } else {
            # update records
            $args = "name='$fname',gender='$gender',dep='$sdep',program='$program',stream='$stream',class='$class',semester='$Ssemester',session='$Ssession' WHERE regno='$regno'";
            if (crud::update('records', $args, $conn)) {
                echo 'Saved';
            } else {
                echo 'error occur!';
            }
        }
    }
}

//add course
if (isset($_POST['cCode'])) {
    $cCode = protect::check($conn, $_POST['cCode']);
    $cTitle = protect::check($conn, $_POST['cTitle']);
    $cUnits = protect::check($conn, $_POST['cUnits']);
    $cSemester = protect::check($conn, $_POST['cSemester']);
    $cdep = protect::check($conn, $_POST['cdep']);
    $cClass = protect::check($conn, $_POST['cClass']);

    if (!empty($cCode) && !empty($cTitle) && !empty($cUnits) && !empty($cSemester) && !empty($cdep) && !empty($cClass)) {
        $args1 = "WHERE cCode='$cCode' AND cdep='$cdep'";
        $q = crud::select('courses', $args1, $conn);

        if (mysqli_num_rows($q) == 0) {
            # new courses
            $args = "cCode='$cCode',cTitle='$cTitle',cUnit='$cUnits',cdep='$cdep',cClass='$cClass',cSemester='$cSemester'";
            if (crud::insert('courses', $args, $conn)) {
                echo 'Saved';
            } else {
                echo 'error occur!';
            }
        } else {
            # update courses
            $args = "cTitle='$cTitle',cUnit='$cUnits',cClass='$cClass',cSemester='$cSemester' WHERE cCode='$cCode' AND cdep='$cdep'";
            if (crud::update('courses', $args, $conn)) {
                echo 'Saved';
            } else {
                echo 'error occur!';
            }
        }
    }
}

//add new admin
if (isset($_POST['aEml'])) {
    $aEml = protect::check($conn, $_POST['aEml']);
    $afname = protect::check($conn, $_POST['afname']);
    $uTyppe = protect::check($conn, $_POST['uTyppe']);
    $apass = md5(protect::check($conn, $_POST['apass']));

    if (!empty($aEml) && !empty($apass) && !empty($afname) && !empty($uTyppe)) {
        $args1 = "WHERE user='$aEml'";
        $q = crud::select('admin', $args1, $conn);

        if (mysqli_num_rows($q) == 0) {
            # new admin
            $args = "user='$aEml', pass='$apass', uType='$uTyppe', names='$afname'";
            if (crud::insert('admin', $args, $conn)) {
                echo 'Success';
            } else {
                echo 'error occur!';
            }
        } else {
            echo 'User already exists!';
        }
    }
}

# get all records
if (isset($_POST['getRec'])) {
    $q = crud::select('records', 'ORDER BY name AND class ASC', $conn);
    $i=0;
    while ($r = mysqli_fetch_array($q)) {
        $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><img src="<?php echo $r['passport']; ?>" alt="" width="30px" style="border-radius: 50%;"> <?php echo $r['name']; ?></td>
            <td><?php echo $r['regno'] ?></td>
            <td>
                <form action="<?php echo root; ?>rec" method="POST">
                    <input type="hidden" name="stdReg" value="<?php echo $r['regno'] ?>">

                    <input type="submit" name="editStd" value="Edit" class="btn-primary">

                    &nbsp; 
                    <input type="button" value="Delete" class="btn-danger" onclick="dellstud('<?php echo $r['regno'] ?>', '<?php echo $r['name']; ?>');">
                </form>
            </td>
        </tr>
        <?php
    }
}

# get all courses
if (isset($_POST['getCrss'])) {
    $q = crud::select('courses', 'ORDER BY cCode AND cdep AND cClass AND cSemester ASC', $conn);
    $i=0;
    while ($r = mysqli_fetch_array($q)) {
        $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $r['cCode']; ?></td>
            <td><?php echo $r['cTitle']; ?></td>
            <td><?php echo $r['cUnit']; ?></td>
            <td><?php echo $r['cdep']; ?></td>
            <td><?php echo $r['cClass']; ?></td>
            <td><?php echo $r['cSemester'] ?></td>
            <td>
                <form action="<?php echo root; ?>dcrs" method="POST">
                    <input type="hidden" name="dcCode" value="<?php echo $r['cCode'] ?>">

                    <input type="submit" name="editCrs" value="Edit" class="btn-primary">

                    &nbsp; 
                    <input type="button" value="Delete" class="btn-danger" onclick="dellCrss('<?php echo $r['cCode'] ?>', '<?php echo $r['cTitle']; ?>');">
                </form>
            </td>
        </tr>
        <?php
    }
}

# get attendance courses
if (isset($_POST['fetchCrss'])) {
    $atDep = protect::check($conn, $_POST['atDep']);
    $atClass = protect::check($conn, $_POST['atClass']);
    $atSemester = protect::check($conn, $_POST['atSemester']);

    if (!empty($atDep) && !empty($atClass) && !empty($atSemester)) {
        $q = crud::select('courses', "WHERE cdep='$atDep' AND cClass='$atClass' AND cSemester='$atSemester' ORDER BY cCode ASC", $conn);
        ?>
        <select name="atCourse" id="atCourse" class="form-control" required>
            <option value="">-- select course --</option>
            <?php
            while ($r = mysqli_fetch_array($q)) {
                ?>
                <option value="<?php echo $r['id']; ?>"><?php echo $r['cCode']; ?></option>
                <?php
            }
            ?>
        </select><br>
        <?php
    } else {
        ?>
        <select name="atCourse" id="atCourse" class="form-control" required>
            <option value="">-- select course --</option>
        </select><br>
        <?php
    }
}

# get all adm
if (isset($_POST['getAdm'])) {
    $online = $_SESSION['admin'];
    $q = crud::select('admin', "WHERE user!='admin@gmail.com' AND user!='$online' ORDER BY user ASC", $conn);
    $i=0;
    while ($r = mysqli_fetch_array($q)) {
        $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $r['names']; ?></td>
            <td><?php echo $r['user']; ?></td>
            <td><?php echo $r['uType']; ?></td>
            <td>
                <input type="button" value="Delete" class="btn-danger" onclick="dellAdm('<?php echo $r['user'] ?>');">
            </td>
        </tr>
        <?php
    }
}

# delete record
if (isset($_POST['dl_Studt'])) {
    $studnt_ID = protect::check($conn, $_POST['studnt_ID']);

    if (!empty($studnt_ID)) {
        crud::del('records', "regno='$studnt_ID'", $conn);
    }
}

# delete course
if (isset($_POST['dl_Crss'])) {
    $cours_ID = protect::check($conn, $_POST['cours_ID']);

    if (!empty($cours_ID)) {
        crud::del('courses', "cCode='$cours_ID'", $conn);
    }
}

# delete admin
if (isset($_POST['dl_Adm'])) {
    $adm_ID = protect::check($conn, $_POST['adm_ID']);

    if (!empty($adm_ID)) {
        crud::del('admin', "user='$adm_ID'", $conn);
    }
}


?>