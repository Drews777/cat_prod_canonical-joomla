<?php

$xml  = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
$xml .= "<!DOCTYPE yml_catalog SYSTEM \"shops.dtd\">\n";
$xml .= "<yml_catalog date=\"".date('Y-m-d  H:i', time())."\">\n";
$xml .= "<shop>\n<name>Самоделкин62</name>\n";
$xml .= "<company>Самоделкин62</company>\n";
$xml .= "<url>http://xn--62-6kcqfsnhgpf7a.xn--p1ai/</url>\n";

$xml .= "<currencies>\n";
$xml .= "<currency id=\"RUR\" rate=\"1\"/>\n";
$xml .= "</currencies>\n";

$mysqli = new mysqli('localhost', 'pervyi_samo', '123456abc', 'pervyi_samo');
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

mysqli_set_charset($mysqli, "utf8");

if ($categories = mysqli_query($mysqli, 'SELECT id, p_id, name FROM pref_category')) { 

	$xml .= "<categories>\n";
    while( $row = mysqli_fetch_assoc($categories) ){ 
    	if ($row['p_id'] == 0)
    		$xml .= "<category id=\"".$row['id']."\">";
    	else
    		$xml .= "<category id=\"".$row['id']."\" parentId=\"".$row['p_id']."\" >";
		$xml .= $row['name']."</category>\n";
    }
    $xml .= "</categories>\n"; 

    mysqli_free_result($categories); 
}

if ($products = mysqli_query($mysqli, 'SELECT a.id, a.name, a.price_1, a.cat_id, a.description, a.url, a.img_1 FROM pref_product as a')) { 

	$xml .= "<offers>\n";
    while( $row = mysqli_fetch_assoc($products) ){
    	$xml .= "<offer id=\"".$row['id']."\" available=\"true\">\n";
        $xml .= "<url>http://xn--62-6kcqfsnhgpf7a.xn--p1ai/".$row['url']."</url>\n";
		$xml .= "<price>".$row['price_1']."</price>\n";
		$xml .= "<currencyId>RUR</currencyId>\n";
		$xml .= "<categoryId>".$row['cat_id']."</categoryId>\n";
        $xml .= "<picture>http://xn--62-6kcqfsnhgpf7a.xn--p1ai/useruploads/catalog/products/1/".$row['img_1']."</picture>\n";
		$xml .= "<name>".$row['name']."</name>\n";
        $xml .= "<description>".$row['description']."</description>\n";
		$xml .= "</offer>\n";
    }
    $xml .= "</offers>\n"; 

    mysqli_free_result($products); 
}

mysqli_close($mysqli);

$xml .= "</shop>\n</yml_catalog>";

echo $xml;
