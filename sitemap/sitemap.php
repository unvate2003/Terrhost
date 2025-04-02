<?php 
//sitemap.php to sitemap.xml using .htaccess file 
require_once('../core/database.php');

//define your base URLs 
$product_sitemap = "$homeurl/sitemap/sitemap_product.xml";

header("Content-Type: application/xml; charset=utf-8");
 echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL; 
 echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemalocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
 
 echo '<sitemap>' . PHP_EOL;
 echo '<loc>'.$product_sitemap.'</loc>' . PHP_EOL;
 echo '<lastmod>'.date("Y-m-d",time()).'</lastmod>' . PHP_EOL;
 echo '</sitemap>' . PHP_EOL;
 
echo '</sitemapindex>' . PHP_EOL;
?>