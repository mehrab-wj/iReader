<?php
include_once("includes/basic.php");

if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($db->con,$_GET['id']);
  $url = $Ads->open_ad_url_by_id($id);
  header('location: '.$url);

}
else {
  header('location: ../');
}
?>
