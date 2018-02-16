<?php
class DatabaseConnection {
  public $host = "localhost";
  public $username = "root";
  public $password = "";
  public $dbname = "ireader";

  public $con;
  public $select_db;
  function __construct() {
    $this->con = mysqli_connect($this->host, $this->username, $this->password);
    if (!$this->con){
        die("Database Connection Failed :( <br>" . mysqli_error($this->con));
    }
    $this->select_db = mysqli_select_db($this->con, $this->dbname);
    if (!$this->select_db){
        die("Database Selection Failed :! <br>" . mysqli_error($this->con));
    }
    mysqli_query($this->con,"SET NAMES 'utf8mb4'");
    mysqli_query($this->con,"SET CHARACTER SET 'utf8mb4'");
    mysqli_query($this->con,"SET character_set_connection = 'utf8mb4'");
  }

  public $site_name;
  public $site_short_about;
  public $site_about;
  public $site_tags;
  public $site_logo;
  public $site_color;

  function load_site_data_from_database() {
    $setting_query = mysqli_query($this->con,"SELECT * FROM `setting` WHERE `setting_tag` = 'orginal_setting';");
    if (mysqli_num_rows($setting_query) == 0) {
      mysqli_query($this->con,"INSERT INTO `setting` (`id`, `setting_tag`, `site_title`, `site_about`, `site_tags`, `site_logo`, `site_color`, `site_short_about`) VALUES
      (NULL, 'orginal_setting', 'iReader', 'اسکریپت فید خوان iReader - ربات مطلب خوان', 'iReader , feed reader bot , ربات فید خوان', 'img/eyeglasses.png', '#3F51B5', 'اسکریپت فید خوان');");
      //insert custom setting if setting row is not exist!
    }
    else {
      $setting = mysqli_fetch_assoc($setting_query);
      /* $this->site_name = $setting['site_title'];
      $this->site_short_about = $setting['site_short_about'];
      $this->site_about = $setting['site_about'];
      $this->site_tags = $setting['site_tags'];
      $this->site_logo = $setting['site_logo'];
      $this->site_color = $setting['site_color']; */
      return $setting;
    }
  }
  function insert_search_log($text) {
    $search_in_search_table_query = mysqli_query($this->con,"SELECT * FROM `searches` WHERE `text` LIKE '$text' OR `text` LIKE '%$text%'");
    if (mysqli_num_rows($search_in_search_table_query) > 0) {
      $search_data = mysqli_fetch_assoc($search_in_search_table_query);
      $new_count = $search_data['count'] + 1;
      $id = $search_data['id'];
      $update_query = mysqli_query($this->con,"UPDATE `searches` SET `count` = '$new_count' WHERE `searches`.`id` = '$id'");
      if (!$update_query) { echo mysqli_error($this->con); }
      else { return true; }
    }
    else {
      $insert_query = mysqli_query($this->con,"INSERT INTO `searches` (`id`,`text`,`count`) VALUES (NULL,'$text',1);");
      if (!$insert_query) { echo mysqli_error($this->con); }
      else { return true; }
    }
  }

}
class ProjectInfo extends DatabaseConnection {
  public $version = "2.0";
  public $developer_github = "mehrab-wj";
  public $git_address = "https://github.com/mehrab-wj/iReader";
  public $site_name;
  public $site_short_about;
  public $site_about;
  public $site_tags;
  public $site_logo;
  public $site_color;

  function load_site_data_from_database() {
    $setting_query = mysqli_query($this->con,"SELECT * FROM `setting` WHERE `setting_tag` = 'orginal_setting';");
    if (mysqli_num_rows($setting_query) == 0) {
      mysqli_query($this->con,"INSERT INTO `setting` (`id`, `setting_tag`, `site_title`, `site_about`, `site_tags`, `site_logo`, `site_color`, `site_short_about`) VALUES
      (NULL, 'orginal_setting', 'iReader', 'اسکریپت فید خوان iReader - ربات مطلب خوان', 'iReader , feed reader bot , ربات فید خوان', 'img/eyeglasses.png', '#3F51B5', 'اسکریپت فید خوان');");
      //insert custom setting if setting row is not exist!
    }
    else {
      $setting = mysqli_fetch_assoc($setting_query);
      /* $this->site_name = $setting['site_title'];
      $this->site_short_about = $setting['site_short_about'];
      $this->site_about = $setting['site_about'];
      $this->site_tags = $setting['site_tags'];
      $this->site_logo = $setting['site_logo'];
      $this->site_color = $setting['site_color']; */
      return $setting;
    }
  }

}


 ?>
