<?php
include_once(__DIR__."/config.php");

class Build extends DatabaseConnection {
  public $title;
  public $ProjectInfo;
  public $site_info;

  public function __construct() {
    $ProjectInfo = new ProjectInfo;
    $site_info = $ProjectInfo->load_site_data_from_database();
    $this->title = $site_info['site_title'];
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

  function styles($custom_path = "") { //style haye morede nazar ro inja benvisid
    echo '
    <link href="'.$custom_path.'style/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="'.$custom_path.'style/bootstrap/css/bootstrap-rtl.css" rel="stylesheet" type="text/css">
    <link href="'.$custom_path.'style/style.css" type="text/css" rel="stylesheet">';
  }

  function javascript($custom_path = "") { //code haye javascript khodeton ro inja benvisid

      echo '<script src="'.$custom_path.'js/jquery.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="'.$custom_path.'style/bootstrap/js/bootstrap.min.js"></script>
      <script>
        $("#searchBtn").click(function() {
          window.location = "'.$custom_path.'search/" + $("#searchInput").val();
        });
      </script>
      <!-- Google Analytics -->
    <script>
    (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,"script","//www.google-analytics.com/analytics.js","ga");

    ga("create", "UA-XXXX-Y", "auto");
    ga("send", "pageview");

    </script>
    <!-- End Google Analytics -->

    <!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-599be82bd6dca90c"></script>
    -->';

  }

  function category_panel() {
    $category_query = mysqli_query($this->con,"SELECT * FROM `category` ORDER BY `id` DESC");
    while ($category = mysqli_fetch_assoc($category_query)) {
      echo "<a href='category/{$category['url']}'>{$category['name']}</a>";
    }
  }

  function tags_panel($tags) {
    $tags_array = explode(',',$tags);
    $n = 0;
    $t_count = count($tags_array) - 1;
    while ($n <= $t_count) {
      echo '<h3>'.$tags_array[$n].'</h3>';
      $n++;
    }
  }

  function static_panel() {
    $day = date('d');
    $now = date('Y-m-'.$day);
    $yesterday = date('Y-m-'.($day - 1));
    $ip = getUserIP();
    $device = getOS();
    $browser = getBrowser();

    $search_query = mysqli_query($this->con,"SELECT * FROM `visitors_ip` WHERE `time` = '$now' AND `ip` = '$ip'");
    if (mysqli_num_rows($search_query) == 0) {
      $inset_query = mysqli_query($this->con,"INSERT INTO `visitors_ip` (`id`, `ip`, `time`, `device`, `browser`) VALUES (NULL, '$ip', '$now', '$device', '$browser'); ");
    }

    $search_today_ip_query = mysqli_query($this->con,"SELECT * FROM `visitors_ip` WHERE `time` = '$now'");
    $today_ip_count = mysqli_num_rows($search_today_ip_query);
    $search_yesterday_ip_query = mysqli_query($this->con,"SELECT * FROM `visitors_ip` WHERE `time` = '$yesterday'");
    $yesterday_ip_count = mysqli_num_rows($search_yesterday_ip_query);

    $query=mysqli_query($this->con,'SELECT * FROM `counter`');
    $field=mysqli_fetch_array($query);
    if($field['last_visit']==$now) {
      $query="UPDATE `counter` SET `today`=today+1,`total`=total+1";
    }
    else {
      $query="UPDATE `counter` set `yesterday`=today,`today`=1,`last_visit`='$now',`total`=total+1";
    }
    mysqli_query($this->con,$query);
    //display counter
    $query=mysqli_query($this->con,'SELECT * FROM `counter`');
    $field=mysqli_fetch_array($query);
    echo "
      آی پی شما : $ip
      <br>
      بازدیدهای امروز : {$field['today']}
      <br>
      بازدیدهای دیروز : {$field['yesterday']}
      <br>
      بازدید کننده امروز : $today_ip_count
      <br>
      بازدید کننده دیروز : $yesterday_ip_count
      <br>
      کل بازدیدها : {$field['total']}

    ";
    $feeds_count_query = mysqli_query($this->con,"SELECT * FROM `feeds`");
    $n = mysqli_num_rows($feeds_count_query);
    echo '<br>تعداد فید های ثب شده : '.$n;
    $posts_count_query = mysqli_query($this->con,"SELECT * FROM `posts`");
    $n = mysqli_num_rows($posts_count_query);
    echo '<br>'.'تعداد پست های ثبت شده : '.$n;
  }

  function post($order_by = "id",$sort_by = "DESC",$limit = "15",$get_return = false) {
    if ($order_by == "RANDOM") { $order_by = "RAND()"; }
    else { $order_by = "`$order_by`"; }
    $post_query = mysqli_query($this->con,"SELECT * FROM `posts` ORDER BY $order_by $sort_by LIMIT $limit");
    if ($get_return) { return mysqli_fetch_assoc($post_query); }
    else {
      while ($post = mysqli_fetch_assoc($post_query)) {
        echo "<h2><a href='p/{$post['id']}' title='{$post['title']}'>{$post['title']}</a></h2>";
      }
    }
  }
  function searches_log($order_by = "id",$sort_by = "DESC",$limit = "15",$get_return = false) {
    if ($order_by == "RANDOM") { $order_by = "RAND()"; }
    else { $order_by = "`$order_by`"; }
    $post_query = mysqli_query($this->con,"SELECT * FROM `searches` ORDER BY $order_by $sort_by LIMIT $limit");
    if ($get_return) { return mysqli_fetch_assoc($post_query); }
    else {
      while ($post = mysqli_fetch_assoc($post_query)) {
        echo "<h2><a href='search/{$post['text']}' title='{$post['text']}'>{$post['text']}</a></h2>";
      }
    }
  }

  function search_input() {
    ?>
    <input type="text" class="form-control" name="ireader-search" placeholder="یک چیز بنویسید و ...." id="searchInput"><br>
    <input type="submit" class="btn btn-success" value='جستجو کنید !' style="width:100%;" id="searchBtn">
    <?php
  }
  function navbar() {
    ?>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#"><?php echo $this->title; ?></a>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="ads">تبلیغ در سایت</a></li>
            <li><a href="buy">خرید این اسکریپت</a></li>
            <li class="active"><a href="./">خانه</a></li>
          </ul>
        </div>
      </nav>
    <?php
  }

  function footer() {
    //code haye footer ro mitunid be har nahvi ke dust darid taghir Bedin
    //lotfan address github in proje va copy right ro taghir nadin ❤️
    ?>
    <footer class="footer">
      <div>
        <div>
          <p>
            <strong><?php echo $this->title; ?> </strong> یک پروژهٔ آزاد و متن‌باز است 😊<br>
  			    <a href="https://github.com/mehrab-wj/ireader">مخرن گیت‌هاب پروژه</a> |
  			    <a href="http://t.me/OneProgrammer">گزارش مشکلات و پیشنهادها</a> <br>
            نوشته شده توسط <a href="https://mehrab.xyz/" id="copy_right">Mehrab Hojjati Pour</a><br>
            این پروژه برای اولین بار در <a href="https://marketeman.in/">مارکته من</a> توسعه یافت !
          </p>
        </div>
      </div>
    </footer>
    <?php
  }
}
 ?>
