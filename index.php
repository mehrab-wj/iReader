<?php
include_once("includes/basic.php");
//include kardan class ha , function ha va motegahyer haye morede niaz az (includes/basic.php) anjam mishe ;)

?>
<!DOCTYPE HTML>
<html>
<head>
  <?php
    $Build->styles();
    $seo->home_meta();
   ?>

</head>
<body>
  <?php $Build->navbar(); ?>
  <div class="container">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="ads">
      <div class="box shadow_box purchase_cm_box" >
        <a href="ads">
         <img src="img/1_fa.gif" alt="تبلغات بنری" id="ads2" style="margin-right:20px;width:96%;height:150px;">
        </a>
      </div>
    </div>
    <br>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pull-right" id="posts">
      <div class="box shadow_box purchase_cm_box" >
      <h1>  آخرین مطالب دریافتی</h1>
        <hr>
        <?php $Build->post("id","DESC","20"); ?>
      </div>
      <div class="box shadow_box purchase_cm_box" >
      <h1>  مطالب پربازدید</h1>
        <hr>
        <?php $Build->post("views","DESC","15"); ?>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-left" id="leftmenu">
      <div class="box shadow_box purchase_cm_box">
          <?php $Build->search_input(); ?>
      </div>
      <div class="box shadow_box purchase_cm_box" >
          <h4>محل تبلیغات A</h4>
        <hr>
        <a href="ads">
         <img src="img/ads-120x240.gif" alt="تبلغات بنری" id="ads2" style="margin-right:20px;">
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
          <?php $Build->tags_panel($ProjectInfo->tags); ?>
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
   $Build->javascript(); ?>

</body>
</html>
