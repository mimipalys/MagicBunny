
<!DOCTYPE html>
<html>
<?php
  include('../../links.php');
?>
<head>
  <link rel="stylesheet" type="text/css" href="../../borderstyle.css">
  <title>
          Using display: flex and 
          justify-content: space-between
  </title>
</head>

<?php 
session_start();

//include correct header
if (isset($_SESSION['user_id']) and $_SESSION['role'] == "patient") {
  include $header_logged_in_patient;
} elseif (isset($_SESSION['user_id']) and $_SESSION['role'] == "caregiver") {
  include $header_logged_in_caregiver;
} else {
  include $header;
}

?>

 <body>
 <h1> Vacation</h1>
 <div class = "bodydiv">
   <div class = "newscolumns_Wide">
   <h2> Traveling to Kenya? These are the vaccines you need! </h2>
     <h4>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Felis donec et odio pellentesque diam volutpat. Vulputate dignissim suspendisse in est. In mollis nunc sed id semper risus in. Tortor at auctor urna nunc id cursus metus. Ultricies mi eget mauris pharetra et ultrices neque ornare aenean. Non nisi est sit amet facilisis magna etiam tempor orci. Massa enim nec dui nunc mattis enim ut tellus elementum. Vehicula ipsum a arcu cursus vitae congue mauris. Arcu odio ut sem nulla pharetra diam sit. Ultrices vitae auctor eu augue ut lectus. At augue eget arcu dictum varius duis. 
    </h4>
    <p>
      Dolor sit amet consectetur adipiscing elit duis tristique sollicitudin nibh. Leo a diam sollicitudin tempor id.
    Vulputate ut pharetra sit amet aliquam id diam maecenas. Arcu non sodales neque sodales. Pulvinar sapien et ligula ullamcorper malesuada proin. Condimentum mattis pellentesque id nibh tortor id aliquet. Varius quam quisque id diam. Sed sed risus pretium quam vulputate dignissim suspendisse in est. At tellus at urna condimentum mattis pellentesque id nibh tortor. Felis eget velit aliquet sagittis id consectetur. Aliquam etiam erat velit scelerisque in. Tristique senectus et netus et malesuada. Gravida cum sociis natoque penatibus et. Lacus sed viverra tellus in hac. Laoreet suspendisse interdum consectetur libero id faucibus nisl. Ac feugiat sed lectus vestibulum. Nisl vel pretium lectus quam id leo. Pellentesque habitant morbi tristique senectus et. Ornare lectus sit amet est placerat in. Amet nulla facilisi morbi tempus iaculis. Enim sed faucibus turpis in eu mi bibendum neque. Imperdiet nulla malesuada pellentesque elit.
</p>
   </div>
  </div>

 </body>

</body>
</html>

<?php 
 include $footer;
 ?>