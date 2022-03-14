//root url
function root(){
    var path = window.location.pathname;
    var a = path.split('/');
    return '/'+a[1]+'/';
}

function stdReg(reg) {
    if (reg != '') {
        $('.tgs').css('display', 'none');
    } else {
        $('.tgs').css('display', 'block');
    }
}

// admin login
$('#Lgnform').submit(function(event){
    event.preventDefault();
    $.ajax({
        method: 'POST',
        url: root()+'process.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(res) {
            if (res.indexOf('success') >= 0) {
                window.location = root()+'rec';
            } else {
                $('#Algnreply').html(res);
                setTimeout(() => {
                    $('#Algnreply').html('');
                }, 3000);
            }
        },
        dataType: 'text'
    });
});

// add new admin
$('#addNewAdmin').submit(function(event){
    event.preventDefault();
    $.ajax({
        method: 'POST',
        url: root()+'process.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(res) {
            alert(res);
            gAdm();
            $('#addNewAdmin')[0].reset();
        },
        dataType: 'text'
    });
});

// add new course
$('#addNewCrss').submit(function(event){
    event.preventDefault();
    $.ajax({
        method: 'POST',
        url: root()+'process.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(res) {
            alert(res);
            gCrss();
            $('#addNewCrss')[0].reset();
        },
        dataType: 'text'
    });
});

// add record
$('#addStudRecfrm').submit(function(event){
    event.preventDefault();
    let dcourses = $('#courses').val();
    formData = new FormData(this);
    formData.append("slctcourses", dcourses);

    $.ajax({
        method: 'POST',
        url: root()+'process.php',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(res) {
            alert(res);
            gRec();
            $('#addStudRecfrm')[0].reset();
        },
        dataType: 'text'
    });
});

// fetch records
function gRec() {
    $.ajax({
        method: 'POST',
        url: root()+'process.php',
        data: {
            getRec: 1
        },
        success: function(res) {
            $('#all_d_rec').html(res);
        },
        dataType: 'text'
    });
}
gRec();

// fetch courses
function gCrss() {
    $.ajax({
        method: 'POST',
        url: root()+'process.php',
        data: {
            getCrss: 1
        },
        success: function(res) {
            $('#all_d_crs').html(res);
        },
        dataType: 'text'
    });
}
gCrss();

// fetch records
function gAdm() {
    $.ajax({
        method: 'POST',
        url: root()+'process.php',
        data: {
            getAdm: 1
        },
        success: function(res) {
            $('#all_d_adm').html(res);
        },
        dataType: 'text'
    });
}
gAdm();

// fetch attendance course
function proFetchCrss() {
    let atSemester = $('#atSemester').val(),
    atDep = $('#atDep').val(),
    atClass = $('#atClass').val();

    $.ajax({
        method: 'POST',
        url: root()+'process.php',
        data: {
            fetchCrss: 1,
            atDep: atDep,
            atClass: atClass,
            atSemester: atSemester
        },
        success: function(res) {
            $('#myAtCrss').html(res);
        },
        dataType: 'text'
    });
}

// delete records
function dellstud(studnt_ID, nm) {
    let ques = confirm('are you sure to delete '+nm);
    if (ques == true) {
        $.ajax({
            method: 'POST',
            url: root()+'process.php',
            data: {
                dl_Studt: 1,
                studnt_ID: studnt_ID
            },
            success: function() {
                alert('deleted');
                gRec();
            },
            dataType: 'text'
        });
    }
}

// delete courses
function dellCrss(crss_ID, nm) {
    let ques = confirm('are you sure to delete '+nm);
    if (ques == true) {
        $.ajax({
            method: 'POST',
            url: root()+'process.php',
            data: {
                dl_Crss: 1,
                cours_ID: crss_ID
            },
            success: function() {
                alert('deleted');
                gCrss();
            },
            dataType: 'text'
        });
    }
}

// delete Admin
function dellAdm(studnt_ID) {
    let ques = confirm('are you sure to delete '+studnt_ID);
    if (ques == true) {
        $.ajax({
            method: 'POST',
            url: root()+'process.php',
            data: {
                dl_Adm: 1,
                adm_ID: studnt_ID
            },
            success: function() {
                alert('deleted');
                gAdm();
            },
            dataType: 'text'
        });
    }
}
