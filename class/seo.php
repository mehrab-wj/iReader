<?php
include_once("class/config.php");

class Seo extends DatabaseConnection {

  function home_meta() {
    $setting_query = mysqli_query($this->con,"SELECT * FROM `setting`");
  }
}
 ?>
