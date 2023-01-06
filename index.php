<!-- formulaire HTML -->
<form method="GET">
  <input type="text" name="query" placeholder="Rechercher sur YouTube">
  <input type="submit" value="Go">
</form>

<?php
// Vérifiez si le formulaire a été soumis
if (isset($_GET['query'])) {
  // Récupérez la valeur de la requête de recherche
  $query = $_GET['query'];

  // Remplacez YOUR_API_KEY par votre propre clé API YouTube
  $apiKey = "YOUR_API_KEY";

  // Encodez la requête de recherche pour l'utiliser dans l'URL
  $encodedQuery = urlencode($query);

  // Construisez l'URL de l'API YouTube
  $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=$encodedQuery&type=video&key=$apiKey";

  // Effectuez une requête HTTP GET à l'URL de l'API
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($curl);
  curl_close($curl);

  // Décodez la réponse JSON
  $results = json_decode($response, true);

  // Affichez les titres et les descriptions des vidéos de la recherche
  foreach ($results['items'] as $result) {
    $video_title = $result['snippet']['title'];
    $video_description = $result['snippet']['description'];
    echo "$video_title: $video_description\n";
  }
}
?>
