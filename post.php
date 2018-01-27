<?php
include_once("includes/basic.php");

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $title = mysqli_real_escape_string($db->con,$_GET['search']);
    $post_query = mysqli_query($db->con,"SELECT * FROM `posts` WHERE `id` = '$title' ORDER BY `id` DESC LIMIT 30");
    if (mysqli_num_rows($post_query) == 0) {
        echo '<center>
        هیچ مطلبی یافت نشد !
        <br><a href="../">
        برای برگشت به صفحه اصلی ، اینجا کلیک کنید</a>'.$title;

    }
    else {
      $p = mysqli_fetch_assoc($post_query);
?>
<html>
<head>
  <?php
    $Build->styles("../");
    $seo->home_meta();
   ?>
  <title><?php echo $p['title']; ?></title>
  <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../img/eyeglasses.png" />
<meta name="description" content="<?php echo strip_tags($p['description']); ?> - iReader - <?php echo $p['title']; ?>">
<meta name="keywords" content="برنامه نویسی , آموزش , هک و امنیت , اسکریپت , فیلم و سریال , دانلود , موبایل , خرید آنلاین , ربات , تلگرام , اخبار , هالیوود , خبر , پوست و زیبایی">
<meta http-equiv="content-language" content="fa">

<meta name="author" content="Mehrab Hojjati Pour">
<meta property="og:locale" content="fa_IR" />

<meta property="og:title" content="<?php echo $title; ?> - iReader" />
<meta property="og:description" content="<?php echo strip_tags($p['description']); ?> - iReader - <?php echo $p['title']; ?>"/>
<meta property="og:type" content="website" />
<meta property="og:image" content="../img/eyeglasses.png" />
<meta property="og:url" content="https://GhasrPay.ir" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?php echo $title; ?> - iReader" />
<meta name="twitter:description" content="<?php echo strip_tags($p['description']); ?> - iReader - <?php echo $p['title']; ?>"/>
<meta name="robots" content="../robots.txt"/>

<meta name="theme-color" content="#3F51B5" />
</head>
<body>
  <?php $Build->navbar(); ?>
  <div class="container">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="ads">
      <div class="box shadow_box purchase_cm_box" >
        <a href="ads">
         <img src="../img/1_fa.gif" alt="تبلغات بنری" id="ads2" style="margin-right:20px;width:96%;height:150px;">
        </a>
      </div>
    </div>
    <br>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pull-right" id="posts">
      <?php
      if (isset($_GET['search']) && !empty($_GET['search'])) {
       ?>
      <div class="box shadow_box purchase_cm_box" >
        <?php
          $title = mysqli_real_escape_string($db->con,$_GET['search']);
          $post_query = mysqli_query($db->con,"SELECT * FROM `posts` WHERE `id` = '$title' ORDER BY `id` DESC LIMIT 30");
          if (mysqli_num_rows($post_query) == 0) {
            echo 'هیچ مطلبی یافت نشد !';
          }
          while ($post = mysqli_fetch_assoc($post_query)) {
            mysqli_query($db->con,"UPDATE `posts` SET `views`=views+1 WHERE `id` = '$title'");
            echo "<h1>{$post['title']}</h1><br>
            {$post['views']} بازدید
            <hr>";
            $link = shortUrl($post['link']);
            $description = $post['description'];
            $description = str_replace($post['link'],$link,$description);
            echo $description;
            /*
            $n = 0;
            $space_array = explode(' ',$post['title']);
            $scount = count($space_array) - 1;
            while ($n <= $scount) {
              echo "<h2>{$space_array[$n]}</h2>";
              $n++;
            } */

            $limit = 0;
            while ($suggestion = $Build->post("RANDOM","DESC","2",true)) {
              if ($limit == 1) { break; } else { $limit++; }
              echo '<a class="suggestion s-left-border" href="'.$suggestion['id'].'">
                '.str_replace("دانلود","",$suggestion['title']).' هم ببینید
              </a><br>';
            }

            echo "<h1><a href='$link' title='{$post['title']}'>برای مشاهده کامل این مطلب ، اینجا کلیک کنید</a><h1><br>";
          }
         ?>
      </div>
      <?php }
      else {
        header('Location: ../');
      }
      $post_query = mysqli_query($db->con,"SELECT * FROM `posts` ORDER BY rand() DESC LIMIT 4");
      while ($post = mysqli_fetch_assoc($post_query)) {


           echo '<a class="suggestion green" href="'.$post['id'].'">
             چرا '.str_replace("دانلود","",$post['title']).' رو نگاه نمیکنی ؟
           </a><br>';

         } ?>

    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-left" id="leftmenu">
      <div class="box shadow_box purchase_cm_box">
          <?php $Build->search_input(); ?>
      </div>
      <div class="box shadow_box purchase_cm_box" >
          <h4>محل تبلیغات A</h4>
        <hr>
        <a href="ads">
         <img src="../img/ads-120x240.gif" alt="تبلغات بنری" id="ads2" style="margin-right:20px;">
       </a>
       <a href="http://opizo.com/ref:83757"><img src="http://opizo.com/banner/opizo_120x240.png" alt="کسب درآمد" style="margin-right:20px;"></a>
      </div>
      <div class="box shadow_box purchase_cm_box" >
          <h4>آمار و ارقام</h4>
        <hr>
        <?php
            $Build->static_panel();
         ?>
      </div>
      <div class="box shadow_box purchase_cm_box">
        <h4>دسته بندی مطالب</h4>
        <hr>
        <?php $Build->category_panel(); ?>
      </div>
      <div class="box shadow_box purchase_cm_box tags_box">
        <h4>برچست ها</h4>
        <hr>
          <?php
            $tags = "فیلم ایرانی , دانلود فیلم خارجی , دانلود سریال خارجی , دانلود فیلم ایرانی , فیلم ایرانی , سریال ایرانی ,
            دانلود فیلم ترسناک , دانلود فیلم وحشت , دانلود فیلم اکشن , دانلود انیمیشن , دانلود کارتون , دانلود فیلم کمدی
            , دانلود فیلم جنگی , دانلود فیلم عاشقانه , دانلود فیلم درام , دانلود فیلم دوبله فارسی , دانلود فیلم بدون سانسور , دانلود فیلم بزرگسالان";
            $Build->tags_panel($tags);
           ?>
      </div>

      <?php
      $limit = 0;
      while ($suggestion = $Build->post("RANDOM","DESC","2",true)) {
        if ($limit == 4) { break; } else { $limit++; }
        echo '<a class="suggestion" href="p/'.$suggestion['id'].'">
          '.$suggestion['title'].'
        </a><br>';
      }
       ?>

    </div>
  </div>

  <?php
    $Build->footer();
   $Build->javascript("../"); ?>
</body>

</html>
<?php }}
else {
  header('Location: ../');
  echo 'Not Found!';
}
?>
