<?php
$id = $_GET['id'];
//echo $imdbid;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://yts.mx/api/v2/movie_details.json?with_images=true&with_cast=true&movie_id='.$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=klbpnm14qil1rk0brhtjijgmng'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

$arr = json_decode($response, true);
// Access values from the associative array
$title = $arr["data"]["movie"]["title"];
$year = $arr["data"]["movie"]["year"];
$rating = $arr["data"]["movie"]["rating"];
$runtime = $arr["data"]["movie"]["runtime"];
$summary = $arr["data"]["movie"]["description_intro"];
$imdb_code = $arr["data"]["movie"]["imdb_code"];
$background_image_original = $arr["data"]["movie"]["background_image_original"];
$large_cover_image = $arr["data"]["movie"]["large_cover_image"];
$url = "https://api.themoviedb.org/3/find/".$imdb_code."?api_key=6d6473e3e1e4dcb12247fe0c8bb55fb7&language=en-US&external_source=imdb_id";
$curll = curl_init();

$torrents = $arr["data"]["movie"]["torrents"];

curl_setopt_array($curll, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$responsee = curl_exec($curll);

curl_close($curll);
$tmdb = json_decode($responsee, true);
$summaryy = $tmdb["movie_results"][0]["overview"];
$tmdbbackground = $tmdb["movie_results"][0]["backdrop_path"];
$tmdbbackground = "https://image.tmdb.org/t/p/original".$tmdbbackground;

echo "<html lang='en' dir='ltr' style='background-image: url(".$tmdbbackground.");'>";
echo "  <head>";
echo "    <link rel='stylesheet' href='style.css'>";
echo "    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
echo "    <meta charset='utf-8'>";
echo "    <title>Andy Cool Movies</title>";
echo "  </head>";
echo "  <body>";
echo "  <div class='topgrad'></div>";
echo " <button class='back' onclick='history.back()'><i class='fa fa-angle-left'></i></button>";
echo "  <div class='overlay'></div>";
echo "      <div class='container'>";
echo "        <header>".$title."</header>";
echo "        <span class>".$year." • ".$runtime." mins • ".$rating."</span>";
echo "        <p class='summary'>".$summaryy."</p>";
echo "        <img class='cover' src='".$large_cover_image."'></img>";
echo "      <div class='tab'>";
echo "        <center><table style='margin-left:-20px;'>";

foreach ($torrents as $torrent) {
  $quality = $torrent["quality"];
  $hash = $torrent["hash"];
  $type = $torrent["type"];
  $peers = $torrent["peers"];
  $seeds = $torrent["seeds"];
  $size = $torrent["size"];
  $url = "player\player.php?hash=".$hash."&title=".$title."&year=".$year;
  //echo "<td><form action='player\player.php?hash=".$hash."' method='get' target='_blank'>";
  //echo "<button type='submit'>".$quality."</button>";
  //echo  "</form></td>";
  echo  "<td><abbr title='Size: ".$size." - Seeds: ".$seeds." - Peers: ".$peers."'><a class='qbutton' target='_blank' href='".$url."'>".$quality."<br>".$type."</a></abbr></td>";
}

echo "        ";
echo "        ";
echo "        ";
echo "        ";
echo "        ";
echo "        ";
echo "        ";
echo "        ";
echo "        </table></center>";
echo "      </div>";
echo "      </div>";
echo "  </body>";
echo "</html>";
?>
