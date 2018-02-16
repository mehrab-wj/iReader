<?php
class Ads extends DatabaseConnection {
  function get_ad($position) {
    $search_ad_query = mysqli_query($this->con,"SELECT * FROM `ads` WHERE `position` = '$position' AND `status` = 'active'");
    if (mysqli_num_rows($search_ad_query) > 0) { //baresi vojod tablighat va namayesh an;
      $ad = mysqli_fetch_assoc($search_ad_query);
      $ad_link = $this->short_ad_url($ad['id']);
      $views = $ad['view_count'];
      $views = explode('|',$views);
      $total_views = $views[0] + 1;
      if ($total_views == $views[1]) {
        $update_ad_query = mysqli_query($this->con,"UPDATE `ads` SET `status` = 'deactive' WHERE `ads`.`id` = '{$ad['id']}'");
        //tahgir vaziat tablighat dar sorati ke tedad bazdid hash be mizan morede nazar reside bashad;
      }
      $update_ad_query = mysqli_query($this->con,"UPDATE `ads` SET `view_count` = '$total_views|{$views[1]}' WHERE `ads`.`id` = '{$ad['id']}'");
      //echo "total views: ".($views[0] + 1).'<br>ordered views: '.$views[1];
      echo "<a href='$ad_link'>
        <img src='{$ad['banner']}' alt='تبلیغات بنری' class='$position'></a>
      </a>";
    }
    else { // dar sorat nabud tablighat faal :
      if ($position == "top-big-ad") {
        ?>
          <a href="ads">
           <img src="img/1_fa.gif" alt="تبلغات بنری" id="ads2" class="<?php echo $position ?>">
          </a>
        <?php
      }
      else {
        echo 'هیج تبلیغاتی یافت نشد !<br>
        لطفا در مقدار دهی مکان تبلیغات دقت کنید .';

      }
    }
  }
  function short_ad_url($id) {
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF'];

    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
    $pathInfo = pathinfo($currentPath);

    // output: localhost
    $hostName = $_SERVER['HTTP_HOST'];

    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';

    // return: http://localhost/myproject/
    return $protocol.'://'.$hostName."{$pathInfo['dirname']}/ad/$id";
  }
  function open_ad_url_by_id($ad_id) {
    $search_ad_query = mysqli_query($this->con,"SELECT * FROM `ads` WHERE `id` = '$ad_id'");
    if (mysqli_num_rows($search_ad_query) == 1) {
      $ad = mysqli_fetch_assoc($search_ad_query);
      $ad_url = $ad['link'];
      $click = explode("|",$ad['click_count']);
      $total_click = $click[0] + 1;
      if ($total_click == $click[1]) {
        $update_ad_query = mysqli_query($this->con,"UPDATE `ads` SET `status` = 'deactive' WHERE `ads`.`id` = '{$ad['id']}'");
        //tahgir vaziat tablighat dar sorati ke tedad bazdid hash be mizan morede nazar reside bashad;
      }
      $update_ad_query = mysqli_query($this->con,"UPDATE `ads` SET `click_count` = '$total_click|{$click[1]}' WHERE `ads`.`id` = '{$ad['id']}'");
      return $ad_url;
    }
    else {
      return '../';
    }
  }
}
 ?>
