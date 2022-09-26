<?php
$hash = $_GET['hash'];
$title = $_GET['title'];
$year = $_GET['year'];

$magnet = "magnet:?xt=urn:btih:".$hash."&dn=".urlencode($title." - ".$year)."&tr=http://track.one:1234/announce&tr=udp://track.two:80";

echo "<html lang='en' dir='ltr'>";
echo "  <head>";
echo "    <link rel='stylesheet' href='style.css'>";
echo "    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
echo "    <meta charset='utf-8'>";
echo "    <title>YTS client</title>";
echo "  </head>";
echo "  <body bgcolor='black'>";
echo "<div class='center'></div>";
echo "<video controls src='".$magnet."' width='80%'  data-title='".$title." - ".$year."'></video>";
echo "</div>";
echo "<script src='https://cdn.jsdelivr.net/npm/@webtor/embed-sdk-js/dist/index.min.js' charset='utf-8' async></script>";
echo "</body>";
 ?>
