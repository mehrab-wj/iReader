<?php
include("../includes/basic.php");


$seo = new Seo;
$db = new DatabaseConnection;
$Build = new Build;

?>
<html>
<head>
  <title>iReader - اسکریپت برسی مطالب - مدیریت</title>
  <link href="../style/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="../style/bootstrap/css/bootstrap-rtl.css" rel="stylesheet" type="text/css">
  <link href="../style/style.css" type="text/css" rel="stylesheet">
  <link rel="shortcut icon" href="../img/eyeglasses.png" />
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">iReader</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li class=""><a href="../">نمایش سایت</a></li>
        <li class="active"><a href="./">پیشخوان</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pull-right" id="posts">
      <div class="box shadow_box purchase_cm_box" >
        <?php
          if (isset($_GET['read'])) {
            $sql = mysqli_query($db->con,"SELECT * FROM `feeds` ORDER BY `id` DESC");
            $n = 0;
            while ($match = mysqli_fetch_assoc($sql)) {
              try {
                $db->content = file_get_contents($match['url']);
                $x = new SimpleXmlElement($db->content);
                foreach($x->channel->item as $entry) {
                  $link = $entry->link;
                  $title = $entry->title;
                  $description = $entry->description;
                  $check_query = mysqli_query($db->con,"SELECT * FROM `posts` WHERE `title` = '$title'");
                  if (mysqli_num_rows($check_query) < 1 ) {
                    $inset_query = mysqli_query($db->con,"INSERT INTO `posts` (`id`, `title`, `link`,`description`) VALUES (NULL, '$title', '$link','$description'); ");
                    $n++;
                  }
                }
              }
              catch(Exception $er) {
                echo '<br>خطا در دریافت مقدار فید '.$match['url'];
              }
            }
            echo "<br>$n پست جدید دریافت و ثبت شد !";
          }
          elseif (isset($_GET['test'])) {
            getFeed($_GET['test']);
          }
          elseif (isset($_GET['data'])) {
            $sql = mysqli_query($db->con,"SELECT * FROM `feeds`");
            $n = 0;
            while (mysqli_fetch_assoc($sql)) {
              $n++;
            }
            echo 'تعداد فید های ثب شده : '.$n;
            $sql = mysqli_query($db->con,"SELECT * FROM `posts`");
            $n = 0;
            while (mysqli_fetch_assoc($sql)) {
              $n++;
            }
            echo '<br>'.'تعداد پست های ثبت شده : '.$n;
          }
         ?>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-left" id="leftmenu">
      <div class="box shadow_box purchase_cm_box">
        پنل مدیریت
        <hr>
        <a href="?read">دریافت مقدار های جدید</a>
        <br>
        <a href="?data">آمار و ارقام</a>
      </div>
    </div>
  </div>

</body>
</html>
