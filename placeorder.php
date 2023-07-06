<?php
include 'functions.php';
session_start();
template_header();

echo "<div style='text-align: center; padding: 250px 100px;' class='container'>
<h1 style='text-align: center; 'class='captureGross'>Your Order Has Been Placed</h1>
<p clas='captureSmall'>Thank you for ordering with us! We'll contact you by email with your order details.</p>
</div>";
header("Refresh:3; url=index.php");
session_destroy();
template_footer();
