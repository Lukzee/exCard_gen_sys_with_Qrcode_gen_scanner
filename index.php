<?php
require_once 'connection.php';
require_once 'path.php';
require_once 'class/crud_class.php';
require_once 'class/dprot_class.php';
require_once 'header.php';

$req = protect::check($conn, @$_GET['req']);
if (empty($req)) {
    $req = 'rec';
}

switch (strtolower($req)) {
    case 'lgn':
        require_once 'pgs/home.php';
        break;

    case 'out':
        require_once 'out.php';
        break;

    case 'rec':
        require_once 'pgs/user.php';
        break;

    case 'vrec':
        require_once 'pgs/rec.php';
        break;

    case 'adms':
        require_once 'pgs/tables.php';
        break;

    case 'dcrs':
        require_once 'pgs/crses.php';
        break;

    case 'fps':
        require_once 'pgs/other.php';
        break;

    case 'ams':
        require_once 'pgs/attend.php';
        break;
    
    default:
        require_once 'pgs/user.php';
        break;
}

require_once 'footer.php';
?>