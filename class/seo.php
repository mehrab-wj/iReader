<?php
include_once(__DIR__."/config.php");

class Seo extends DatabaseConnection {

  function home_meta() {
    $setting_query = mysqli_query($this->con,"SELECT * FROM `setting`");
  }
}
 ?>
