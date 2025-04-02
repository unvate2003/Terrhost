<?php 
//sitemap.php to sitemap.xml using .htaccess file 
require_once('../core/database.php');

$posts = mysqli_query($conn, "SELECT * FROM subcategories ORDER BY subcateid ASC");

//define your base URLs
//Main URL 
$main_base_url = "$homeurl";
//post base URL 
$posts_base_url = "$homeurl/";



header("Content-Type: application/xml; charset=utf-8");
 echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL; 
 echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemalocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

 echo '<url>' . PHP_EOL;
 echo '<loc>'.$main_base_url.'</loc>' . PHP_EOL;
 echo '<lastmod>'.date("Y-m-d",time()).'</lastmod>' . PHP_EOL;
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo '</url>' . PHP_EOL;

while($row=mysqli_fetch_assoc($posts)){
$urlproduct = 'thanhtoan/'.htmlentities(create_slug($row['subcate'])).'-'.htmlentities($row['key_id']).'';
 echo '<url>' . PHP_EOL;
 echo '<loc>'.$posts_base_url. $urlproduct .'</loc>' . PHP_EOL;
 echo '<lastmod>'.date("Y-m-d",time()).'</lastmod>' . PHP_EOL;
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo '<priority>1.0</priority>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;
?>