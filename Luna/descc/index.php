<?php
require('connect.php');
$conn = new DBConnect;
$connection = $conn->getConnection();
$id = isset($_GET['id']) ? $_GET['id'] : 2;
$query = "SELECT * FROM movies where movie_id = $id ";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $Poster = $row['Poster'];
    $title = $row['title'];
    $rating = $row['rating'];
    $duration = $row['duration'];
    $genre = $row['genre'];
    $release_date = substr($row['release_date'], 0, 4);
    $description = $row['description'];
    $trailer = $row['Trialer'];
  }
} else {
  // no movies were found
  echo "No movies found.";
}

// Fetch the recommendations
$recommendations = [];
$query = "SELECT movie_id, mov_img FROM movies LIMIT 6";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $recommendations[] = $row;
  }
} else {
  // no movies were found
  echo "No movies found.";
}

// Fetch the actors
$actors = [];
$query = "SELECT * FROM actors where movie_id= $id";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $actors[] = $row;
  }
} else {
  // no actors were found
  echo "No actors found.";
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="styles/style.css">
</head>

<body>
  <header>

    <a href="#" class="brand">LUNA Stream</a>
    <div class="menu-btn"></div>
    <div class="navigation">
      <div class="navigation-items">
        <a href="#">Home</a>
        <a href="#">Explore</a>
        <a href="#">Library</a>
        <a href="#">Trending</a>
        <a href="#">Settings</a>
      </div>
    </div>
    <button id="dark-mode-btn"><img id="mode-icon" src="pics/dark.png" alt="Dark Mode"></button>
  </header>
  <div class="overlay2"></div>
  <img src="<?php echo $Poster; ?>" alt="Movie Poster" class="bg">

  <section class="hero">
    <div class="left">
      <div class="texts">
        <h1><?php echo $title; ?></h1>
        <div class="desc">
          <div class="rating">
            <img src="images/rat.png" alt="">
            <span><?php echo $rating; ?></span>
          </div>
          <div class="time">
            <img src="images/tim.png" alt="">
            <span><?php echo $duration; ?>min</span>
          </div>
          <p>· <?php echo $genre; ?> ·</p>
          <div class="year">
            <p><?php echo $release_date; ?></p>
          </div>
        </div>
        <p class="decs"><?php echo $description; ?></p>
        <button class="vidplay" onclick="openPlayer()">Play now</button>
        <button class="trailplay" onclick="openTrailer('<?php echo $trailer; ?>')">Trailer</button>
      </div>
    </div>
    <div class="right">
      <h1>Recommendations</h1>
      <div class="recomm">
        <?php foreach ($recommendations as $recommendation) { ?>
          <img src="<?php echo $recommendation['mov_img']; ?>" alt="" class="rec" onclick="changeId(<?php echo $recommendation['movie_id']; ?>)">
        <?php } ?>
      </div>
      <h1>Actors</h1>
      <div class="recomm">
        <?php foreach ($actors as $actor) { ?>
          <div class="actor">
            <img src="<?php echo $actor['image']; ?>" alt="" class="act">
            <p><?php echo $actor['name']; ?></p>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <script src="scripts/desc.js"></script>
  <script src="scripts/button.js"></script>
</body>

</html>