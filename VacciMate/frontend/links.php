<?php
// Get the current server's protocol (http or https)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

// Get the current server's hostname
$host = $_SERVER['HTTP_HOST'];

// Construct the login URL dynamically using the protocol, hostname, and port number

//First header
$homepage_link = $protocol . $host . '/frontend/homepage/frontpage.php'; 
$login_link = $protocol . $host . '/frontend/SignupandSingnin/signIn.php';
$register_link = $protocol . $host . '/frontend/SignupandSingnin/signUp.php'; 
$setting_link = $protocol . $host . '/frontend/Settings/Settings_Page.php'; 
$my_page = $protocol . $host . '/frontend/My_Page/Patient/view_vaccine_history.php';
$logout = $protocol . $host . '/processing/logout.php';
$my_page_caregiver = $protocol . $host . '/frontend/My_Page/Caregiver/register_vaccine.php';
$logo_img = '/images/VacciMate.png';
$logo_img2 = '/images/vacci.png';
$logo_img1177 = '/images/1177.png';


//Secound header
$travel_link = $protocol . $host . '/processing/continents.php'; 
$search_link = $protocol . $host . '/processing/search_vaccine.php'; 
$aboutUs_link = $protocol . $host . '/frontend/Non_connected_pages/About_Us/About_Us.php';
$view_administered_vaccines = $protocol . $host . '/frontend/My_Page/Caregiver/view_administered_vaccines.php';
$statistics = $protocol . $host . '/frontend/My_Page/Caregiver/caregiver_statistics_search.php';


//my page links 
$savedvaccine_link = $protocol . $host . '/processing/savedvaccine.php'; 

//News links
$TBE_link = $protocol . $host . '/frontend/Non_connected_pages/News/TBE.php'; 
$TBE_image = " https://img.freepik.com/free-photo/couple-lying-down-meadow_329181-12751.jpg?w=900&t=st=1696859047~exp=1696859647~hmac=54997c6897e37006f6afab72495a5a19bbf1f33ffe8decb4706f0ff50090ae86"; 


$influenza_image ="https://img.freepik.com/free-photo/doctor-vaccinating-patient-clinic_23-2148880521.jpg?w=900&t=st=1696859468~exp=1696860068~hmac=287ac6245b4bf9756b04e689c968f162124f798419d39d112effe04628ed09db"; 
$influenza_link = "http://localhost:8888/frontend/Non_connected_pages/News/influenza.php";

$kenya_link = "http://localhost:8888/frontend/Non_connected_pages/News/kenya.php"; 
$kenya_image = "https://img.freepik.com/free-photo/dirt-road-with-green-mountains_1160-643.jpg?w=900&t=st=1696859511~exp=1696860111~hmac=a38eb051074e8aceb9fc7aad6ea86354b1fb99466cd1b560c9124686ad42f5ad"; 


//settings links
$delete_account =  $protocol . $host . '/processing/delete_account.php';

// register users processing link
$register_patient = $protocol . $host . '/processing/patient_registration.php';
$register_caregiver = $protocol . $host . '/processing/healthcareprovider_registration.php';


// Header - FRONT PAGE
$header = $_SERVER['DOCUMENT_ROOT'] . '/frontend/elements/header/header.php';
$header_logged_in_patient = $_SERVER['DOCUMENT_ROOT'] . '/frontend/elements/header/header_logged_in_patient.php';
$header_logged_in_caregiver = $_SERVER['DOCUMENT_ROOT'] . '/frontend/elements/header/header_logged_in_caregiver.php';

// Header - MY PAGE PATIENT
$header_my_page_patient = $_SERVER['DOCUMENT_ROOT'] . '/frontend/elements/header/my_page_header_patient.php';
$header_my_page_caregiver = $_SERVER['DOCUMENT_ROOT'] . '/frontend/elements/header/my_page_header_caregiver.php';


// Footer
$footer = $_SERVER['DOCUMENT_ROOT'] . '/frontend/elements/footer/footer.php';


$styles_doc = $protocol . $host . '/frontend/borderstyle.css';
$footer_style = $protocol . $host . '/frontend/elements/footer/footer.css';

//link to get_notification_settings.php
$get_not_link = $protocol . $host . '/processing/Notification/get_notification_settings.php';

?>