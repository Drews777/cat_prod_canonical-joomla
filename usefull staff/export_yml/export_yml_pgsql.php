<?php
header("Content-Type: application/xml; charset=utf-8");
$xml  = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
$xml .= "<!DOCTYPE yml_catalog SYSTEM \"shops.dtd\">\n";
$xml .= "<yml_catalog date=\"".date('Y-m-d  H:i', time())."\">\n";
$xml .= "<shop>\n<name>ООО «Агрохимзащита Алтай»</name>\n";
$xml .= "<company>ООО «Агрохимзащита Алтай»</company>\n";
$xml .= "<url>https://ahz22.ru</url>\n";

$xml .= "<currencies>\n";
$xml .= "<currency id=\"RUR\" rate=\"1\"/>\n";
$xml .= "</currencies>\n";

$dbhost = 'localhost';
$dbname='u308_db';
$dbuser = 'u308_db';
$dbpass = 'bfGK3C5QuSue';

$mysqli = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass")

or die('Could not connect: ' . pg_last_error());

$query = 'SELECT * FROM categories';
$result = pg_query($query) or die('Error message: ' . pg_last_error());

$xml .= "<categories>\n";
while ($row = pg_fetch_row($result)) {
    if ($row[3] == 0)
        $xml .= "<category id=\"".$row[0]."\">";
    else
        $xml .= "<category id=\"".$row[0]."\" parentId=\"".$row[3]."\" >";
    $xml .= $row[1]."</category>\n";

}
$xml .= "</categories>\n";

$query = "SELECT * FROM products as pp 
LEFT JOIN prices as p ON p.product_id = pp.id
WHERE status = 't'";
$result = pg_query($query) or die('Error message: ' . pg_last_error());
$xml .= "<offers>\n";
while ($row = pg_fetch_row($result)) {

    if ($row[24] != 0){
        $xml .= "<offer id=\"".$row[0]."\" available=\"true\">\n";
        $xml .= "<price>".$row[24]."</price>\n";
        $xml .= "<currencyId>RUR</currencyId>\n";
        $xml .= "<categoryId>".$row[1]."</categoryId>\n";
        $xml .= "<name>".$row[2]."</name>\n";
//        $picture = str_replace(array("\r\n", "\r", "\n"), '', $row[8]);
/*        $picture = preg_replace('#.*?(<img.+?>).*?#is', '$1', $row[8]);*/
//        $xml .= "<picture>https://ahz22.ru/".$picture."</picture>\n";
        $xml .= "<url>https://ahz22.ru/".$row[3]."</url>\n";
        if (!empty($row[6])){
            $pr_name = htmlspecialchars(strip_tags($row[6]));
            $pr_name = preg_replace("/&amp;/", " ", $pr_name);
            $pr_name = preg_replace("/&nbsp;/", " ", $pr_name);
            $pr_name = preg_replace("/&quot;/", " ", $pr_name);
            $xml .= "<description><![CDATA[".$pr_name."]]></description>\n";
        }
        else{
            $xml .= "<description><![CDATA[".$row[2]."]]></description>\n";
        }
        $xml .= "</offer>\n";
    }
}
$xml .= "</offers>\n";


$xml .= "</shop>\n</yml_catalog>";

echo $xml;