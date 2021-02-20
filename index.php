<?php

ob_start();
//error_reporting(E_ALL);

date_default_timezone_set('Africa/Nairobi');
$date_today = date("Y-m-d");
$current_time = date('H:i:s');
$date_time = date('Y-m-d H:i:s');

$donot_reply_email = "donot-reply@thecollab.hostedug.com";
//error_reporting(0);
session_start();
include 'core/init.php';
include 'functions/constants.php';
$role = @$_SESSION['role'];
$title = "TheCollab | ";

$crypt = new Encryption();
$page = isset($_GET['!']) ? $_GET['!'] : ('wel');
$page = explode("|", $page)[0];
//$page = $encoded_page;
//echo $page;

switch ($page) {
    default:
        $page = 'wel';
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;

    case 'dashboard':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
    case 'collaboratordashboard':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;

    case 'Reg':
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;
    case 'forgot_password':
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;

    case 'recovery':
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;

    case 'new_password':
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;
    case 'create_collab':
        if (file_exists('pages/collaboration/' . $page . '.php'))
            include 'pages/collaboration/' . $page . '.php';
        break;

    case 'edit_collab':
        if (file_exists('pages/collaboration/' . $page . '.php'))
            include 'pages/collaboration/' . $page . '.php';
        break;
    case 'add_ctb':
        if (file_exists('pages/collaboration/' . $page . '.php'))
            include 'pages/collaboration/' . $page . '.php';
        break;
    case 'activities':
        if (file_exists('pages/collaboration/' . $page . '.php'))
            include 'pages/collaboration/' . $page . '.php';
        break;

    case 'upl':
        if (file_exists('pages/collaboration/' . $page . '.php'))
            include 'pages/collaboration/' . $page . '.php';
        break;
    case 'collaborator':
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;

    case 'invites_collab':
        if (file_exists('pages/collaborator/' . $page . '.php'))
            include 'pages/collaborator/' . $page . '.php';
        break;
    case 'other_col':
        if (file_exists('pages/collaborator/' . $page . '.php'))
            include 'pages/collaborator/' . $page . '.php';
        break;

    case 's_reg':
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;
    case 'sv_instance':
        if (file_exists('pages/instance/' . $page . '.php'))
            include 'pages/instance/' . $page . '.php';
        break;
    case 'pay':
        if (file_exists('pages/instance/' . $page . '.php'))
            include 'pages/instance/' . $page . '.php';
        break;

    case 'login':
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;
    case 'logout':
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;

    case 'logout':
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;

    case 'ajax_data':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
    case 'list_col':
        if (file_exists('pages/collaborator/' . $page . '.php'))
            include 'pages/collaborator/' . $page . '.php';
        break;

    case 'new_col':
        if (file_exists('pages/collaborator/' . $page . '.php'))
            include 'pages/collaborator/' . $page . '.php';
        break;

    case 'downs':
        if (file_exists('pages/files/' . $page . '.php'))
            include 'pages/files/' . $page . '.php';
        break;
    case 'read':
        if (file_exists('pages/files/' . $page . '.php'))
            include 'pages/files/' . $page . '.php';
        break;
    case 'ups':
        if (file_exists('pages/files/' . $page . '.php'))
            include 'pages/files/' . $page . '.php';
        break;

    case 'notfy':
        if (file_exists('pages/events/' . $page . '.php'))
            include 'pages/events/' . $page . '.php';
        break;
    case 'fetch-event':
        if (file_exists('pages/events/' . $page . '.php'))
            include 'pages/events/' . $page . '.php';
        break;

    case 'downs':
        if (file_exists('pages/files/' . $page . '.php'))
            include 'pages/files/' . $page . '.php';
        break;
    case 'plt':
        if (file_exists('pages/files/' . $page . '.php'))
            include 'pages/files/' . $page . '.php';
        break;



    ///Admin access
    case 'admin_dashboard':
        if (file_exists('pages/admin/' . $page . '.php'))
            include 'pages/admin/' . $page . '.php';
        break;
}
ob_flush();
?>
