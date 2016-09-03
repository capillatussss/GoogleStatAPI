<?php
/*
* GoogleStatAPI
* @author: Julius Herb (noscio.eu/herb)
* @see: https://github.com/jgherb/GoogleStatAPI
*/
//Get search pattern from request parameters
$query = $_GET['s'];
//Prepare search pattern for google
$query = str_replace(" ","+",$query);
//Generate query url for google
$url = 'https://www.google.com/search?q="'.$query.'"';
//Query data from google
$ch = curl_init();
//Set generated url
curl_setopt($ch, CURLOPT_URL, $url);
//Configure connnection
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//Execute query and save data
$result = curl_exec ($ch);
//Find the meta tag for redirect (which is executed if JS is not enabled)
preg_match_all("/<noscript><meta content=\"0;url=(.*)http-equiv=\"refresh\">/", $result, $output_array);
//Extract the url of the meta tag
$url = $output_array[1][0];
$url = str_replace('" ','',$url);
$url = "https://www.google.com/".$url;
$url = html_entity_decode($url);
//Query data from google page (with no JS, raw HTML)
$ch = curl_init();
//Set new generated url
curl_setopt($ch, CURLOPT_URL, $url);
//Configure connnection
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//Execute query and save data
$result = curl_exec ($ch);
//Find the result stats of the query
preg_match_all("/id=\"resultStats\">(.*)<\/div><div id=\"res\">/", $result, $output_array);
$filter = $output_array[1][0];
preg_match_all("/hr (.*) Erg/", $filter, $output_array);
$info = $output_array[1][0];
// If you want you can remove the separator dots/commas
# $info = str_replace(".","",$info);
# $info = str_replace(",","",$info);
//Output the result
echo $info;
?>
