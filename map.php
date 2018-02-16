<?php
header("Content-type: text/xml");
echo'<?xml version=\'1.0\' encoding=\'UTF-8\'?>';
echo'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

include('config.php');
$time = date("Y-m-d",time());
$sql = mysqli_query($con,"SELECT * FROM `posts` ORDER BY `id` DESC LIMIT 25;");
while ($product = mysqli_fetch_assoc($sql)) {
?>
            <url>
                <loc>http://ireaderr.cf/p/<?php echo $product['id']; ?></loc>
                <lastmod><?php echo $time; ?></lastmod>
                <changefreq>daily</changefreq>
                <priority>1.0</priority>
            </url>
<?php }
$sql = mysqli_query($con,"SELECT * FROM `searches` ORDER BY `id` DESC LIMIT 25;");
while ($product = mysqli_fetch_assoc($sql)) {
?>
            <url>
                <loc>http://ireaderr.cf/search/<?php echo $product['text']; ?></loc>
                <lastmod><?php echo $time; ?></lastmod>
                <changefreq>daily</changefreq>
                <priority>1.0</priority>
            </url>
<?php } ?>
</urlset>
