<?php
include_once(__DIR__."/config.php");

class Seo extends DatabaseConnection {
  function home_meta() {
    $ProjectInfo = new ProjectInfo;
    $site_info = $ProjectInfo->load_site_data_from_database();
    ?>
    <title><?php echo $site_info['site_title'].' - '.$site_info['site_short_about']; ?></title>
    <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="shortcut icon" href="<?php echo $site_info['site_logo']; ?>" />
   <meta name="description" content="<?php echo $site_info['site_about']; ?>">
   <meta name="keywords" content="<?php echo $site_info['site_tags']; ?>">
   <meta http-equiv="content-language" content="fa">

   <meta name="author" content="Mehrab Hojjati Pour">
   <meta property="og:locale" content="fa_IR" />

   <meta property="og:title" content="<?php echo $site_info['site_title']; ?>" />
   <meta property="og:description" content="<?php echo $site_info['site_about']; ?>" />
   <meta property="og:type" content="website" />
   <meta property="og:image" content="<?php echo $site_info['site_logo']; ?>" />
   <meta property="og:url" content="https://mehrab.xyz" />
   <meta name="twitter:card" content="summary" />
   <meta name="twitter:title" content="<?php echo $site_info['site_title']; ?>" />
   <meta name="twitter:description" content="<?php echo $site_info['site_about']; ?>" />
   <meta name="robots" content="robots.txt"/>

   <meta name="theme-color" content="<?php echo $site_info['site_color']; ?>" />
    <?php
  }
}
 ?>
