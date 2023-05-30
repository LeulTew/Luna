<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Player</title>
  <meta name="description" property="og:description" content="A simple HTML5 media player with custom controls and WebVTT captions." />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Docs styles -->
  <link rel="stylesheet" href="player.css" />

</head>

<body>
  <div class="grid">
    <main>
      <div id="container">
        <?php
        require('../connect.php');
        $conn = new DBConnect;
        $connection = $conn->getConnection();
        // Retrieve the movie data and image URLs from the "movies" table
        $query = "SELECT * FROM movies WHERE movie_id = 2";
        $result = mysqli_query($connection, $query);
        // Consume the result
        while (mysqli_next_result($connection)) {
          if (!mysqli_more_results($connection)) {
            break;
          }
        }
        $mov = mysqli_fetch_assoc($result);
        ?>

        <video controls crossorigin playsinline data-poster="../<?php echo $mov['Cover']; ?>" id="player">
          <source src="<?php echo $mov['Video']; ?>" type="video/mp4" size="1080" />
          <!-- Video files -->
         <!--  <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" type="video/mp4" size="576" />
          <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4" size="720" /> -->

          <!-- Caption files -->
   <!--        <track kind="captions" label="English" srclang="en" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt" default />
          <track kind="captions" label="Français" srclang="fr" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt" />
 -->
        </video>
      </div>
    </main>
  </div>

  <script src="player.js" crossorigin="anonymous"></script>
</body>

</html>