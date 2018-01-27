<?php
    header("Content-Type: application/xml; charset=utf-8");
    include("config.php");
    
echo '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	>
<channel>
<title>iReader - اسکریپت برسی مطالب</title>
<link>http://www.ireaderr.cf/</link>
<description>مطالب ارسال شده</description>';
$result = mysqli_query($con,"SELECT * FROM `posts` ORDER BY `id` DESC LIMIT 5") or die ("Could not execute query");
 
    while($row = mysqli_fetch_array($result)) {
        echo '<item>';
        echo '<title>'.strip_tags($row['title']).'</title>';
        echo '<link>ireaderr.cf/'.$row['id'].'</link>';
        echo '<description>'.strip_tags($row['description']).'</description>';
        echo '</item>';
}
echo '</channel>
</rss>';

?>