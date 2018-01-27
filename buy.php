<?php
include_once("includes/basic.php");
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
      <h4>  خرید اسکریپت iReader</h4>
        <hr>
        iReader یک اسکریپت فید خوان هست
        که به شما کمک میکنه تا جدید ترین مطالب یک سایت را فراخوانی کنید !
        در نتیجه شما با خیال آسوده کافیه تنظیم کنید که سایت ، هر چند وقت یک بار خوش رو آپدیت کنه
        و به این شکل سایت شما ، همیشه بروز خواهد ماند .
        <br>
        این به شما کمک میکند تا یک وب سایت همیشه به روز داشته باشید و وقتی یک کاربر
        مطلبی را در گوگل و دیگر موتور های جستجو ، سرچ میکند ، سایت شما یکی از سایت های پیشنهادی باشد
        !
        <br><br>
        این سیستم به شما کمک میکند تا در کمترین زمان ممکن ، بازدید کننده های بسیار زیادی را
        دریافت کنید !
        <br>
        داشتن بازدید زیاد سایت شما ، به شما کمک می کند تا بتوانید تبلیغات در سایت خود ثبت کنید و کسب درآمد کنید !
        <br>
        همچنین یکی دیگر از مزیت های این اسکریپت ، سیستم هوشمند تبلیغاتی آن بوده که کاملا
        هوشمند نیز می باشد .
        <br>
        متضایان برای ثبت تبلیغ در سایت شما ، بعد از پرداخت مبلغ تعیین شده ، تبلیغاتشان به صورا کاملا خودکار
        در سایت قرار میگیرد !
        <br>
        این یعنی شما بعد از راه اندازی سایت ، دیگر هیچ نیازی به مدیریت آن ندارید زیرا
        این اسکریپت ، تمامی کار های مدیریت را خودش انجام میدهد !
        <br>
        <label style="color:red;">همچنین در نظر داشته باشید که این اسکریپت ، از سیستم تبلیغاتی کلیکی پشتیبانی میکند !</label>
        <br><br>
        برخی از مزیت ها iReader :
        <br>
        امکان تنظیم نامحدود سایت برای دریافت مطالب
        <br>
        امکان تنظیم زمان به روز رسانی وب سایت
        <br>
        امکان تنظیم قیمت تبلیغ در پنل مدیریت
        <br>
        سئو بسیار قوی
        <br>
        سیستم دریافت و ثبت تبلیغات به صورا کاملا هوشمند
        <br>
        قابلیت اتصال به درگاه پرداخت
        <a href="https://nextpay.IR/" title="NextPay">
          نکست پی
        </a>
        <hr>
        قیمت این اسکریپت : 600,000 هزار تومان <br>
        هزینه 6 ماه پشتیبانی و راه اندازی اسکریپت : 50,000 هزار تومان<br>
        جهت خرید این اسکریپت با ما در تلگرام تماس حاصل فرماید<br>
        <a href="https://t.me/OneProgrammer" title="Telegram ID">@OneProgrammer</a>
        <br>
        یا با شماره های زیر تماس حاصل فرمایید :<br>
        0903-826-7079
      </div>

      <?php
      $post_query = mysqli_query($db->con,"SELECT * FROM `posts` ORDER BY rand() DESC LIMIT 4");
      while ($post = mysqli_fetch_assoc($post_query)) {


           echo '<a class="suggestion green" href="'.$post['id'].'">
             چرا '.str_replace("دانلود","",$post['title']).' رو نگاه نمیکنی ؟
           </a><br>';

         } ?>

      <br><div class="box shadow_box purchase_cm_box" >
      <h4>  مطالب تصادفی</h4>
        <hr>
        <?php
          $post_query = mysqli_query($db->con,"SELECT * FROM `posts` ORDER BY rand() DESC LIMIT 10");
          while ($post = mysqli_fetch_assoc($post_query)) {
            echo "<a href='p/{$post['id']}' title='{$post['title']}'>{$post['title']}</a><br>";
          }
         ?>
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
          <?php $Build->tags_panel($ProjectInfo->site_tags); ?>
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
