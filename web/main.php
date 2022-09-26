<?php
$search = urlencode($_GET['search']);
$page = urlencode($_GET['page']);

$prevpage = $page-1;
$nextpage = $page+1;

$prevurl = "main.php?page=".$prevpage."&search=".$search;
$nexturl = "main.php?page=".$nextpage."&search=".$search;

echo "<!DOCTYPE html>";
echo "<html lang='en' dir='ltr'>";
echo "  <head>";
echo "    <meta charset='utf-8'>";
echo "    <link rel='stylesheet' href='style.css'>";
echo "    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "    <title>Andy cool movies</title>";
echo "  </head>";
echo "  <body>";
echo "    <div class='blur'></div>";
echo "    <div class='gradient'></div>";
echo "    <form class='' action='main.php' method='get'>";
echo "      <input type='text' name='page' class='page' value='1'>";
echo "      <input type='text' placeholder='Search by Name or IMDb id' name='search' class='search' value=''>";
echo "       <div class='pbuttonsm'>";
echo "         <a class='pbuttons' href='main.php?page=1&search='><i class='fa fa-home'></i></a>";
echo "         <a class='pbuttons' href='".$prevurl."'><i class='fa fa-angle-left'></i></a>";
echo "         <span class='pnum'> ".$page."</span>";
echo "         <a class='pbuttons' href='".$nexturl."'><i class='fa fa-angle-right'></i></a>";
echo "       </div>";
echo "      <input type='submit'";
echo "       style='position: absolute; left: -9999px; width: 1px; height: 1px;'";
echo "       tabindex='-1' />";
echo "    </form>";

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://yts.mx/api/v2/list_movies.json?sort_by=download_count&limit=50&query_term='.$search.'&page='.$page,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=5ogkebj4p6cte0fdau20q3gj4v'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

$arr = json_decode($response, true);
// Access values from the associative array
$array = $arr["data"]["movies"];
$movie_count = $arr["data"]["movie_count"];
echo "<p>".$movie_count." results</p>";
echo "<div class='scroll'>";
echo "<table style='width:80%'>";
echo "<table>";
foreach (array_chunk($array, 5, true) as $arrayy) {
    echo '<tr>';
    foreach($arrayy as $key) {
      $id = $key["id"];
      $title = $key["title"];
      $year = $key["year"];
      $rating = $key["rating"];
      $summary = $key["summary"];
      $background_image_original = $key["background_image_original"];
      $large_cover_image = $key["large_cover_image"];
      echo "<td>
            <a href='engine/engine.php?id=".$id."'><img src='".$large_cover_image."'></a>
            <br>
            <span class='title'>".$title."</span>
            <span class='year'>".$year."</span>
            </td>";
    }
    echo '</tr>';
}
echo "</table>";
echo "<td>";
echo "<td>";
echo "<td>";
echo "</div>";
echo "</body>";
echo "</html>";
?>
