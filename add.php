<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Check if all required fields are filled out
	if (!empty($_POST["title"]) && !empty($_POST["genre"]) && !empty($_POST["description"]) && !empty($_POST["release_date"]) && !empty($_POST["duration"]) && !empty($_POST["director"]) && !empty($_POST["cast"]) && !empty($_POST["rating"]) && !empty($_POST["mov_img"]) && !empty($_POST["trailer"]) && !empty($_POST["video"]) && !empty($_POST["cover"])) {

		// Define validation functions
		function validate_title($title) {
			if (preg_match("/^[a-zA-Z0-9\s]+$/", $title)) {
				return true;
			} else {
				return false;
			}
		}

		function validate_genre($genre) {
			if (preg_match("/^[a-zA-Z\s]+$/", $genre)) {
				return true;
			} else {
				return false;
			}
		}

		function validate_description($description) {
			if (preg_match("/^[a-zA-Z0-9\s\.,'\"\(\)\-]+$/", $description)) {
				return true;
			} else {
				return false;
			}
		}

		function validate_date($date) {
			if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date)) {
				return true;
			} else {
				return false;
			}
		}

		function validate_duration($duration) {
			if (preg_match("/^[0-9]+$/", $duration)) {
				return true;
			} else {
				return false;
			}
		}

		function validate_director($director) {
			if (preg_match("/^[a-zA-Z\s]+$/", $director)) {
				return true;
			} else {
				return false;
			}
		}

		function validate_cast($cast) {
			if (preg_match("/^[a-zA-Z\s]+$/", $cast)) {
				return true;
			} else {
				return false;
			}
		}

		function validate_rating($rating) {
			if (preg_match("/^[0-9]+(\.[0-9]+)?$/", $rating)) {
				return true;
			} else {
				return false;
			}
		}

		function validate_url($url) {
			if (filter_var($url, FILTER_VALIDATE_URL)) {
				return true;
			} else {
				return false;
			}
		}

		// Validate input fields
		$title_error = "";
		if (!validate_title($_POST["title"])) {
			$title_error = "Error: Invalid title format. Title can only contain letters, numbers, and spaces.";
		}

		$genre_error = "";
		if (!validate_genre($_POST["genre"])) {
			$genre_error = "Error: Invalid genre format. Genre can only contain letters and spaces.";
		}

		$description_error = "";
		if (!validate_description($_POST["description"])) {
			$description_error = "Error: Invalid description format. Description can only contain letters, numbers, spaces, commas, periods, quotes, hyphens, and parentheses.";
		}

		$release_date_error = "";
		if (!validate_date($_POST["release_date"])) {
			$release_date_error = "Error: Invalid release date format. Date must be in the format YYYY-MM-DD.";
		}

		$duration_error = "";
		if (!validate_duration($_POST["duration"])) {
			$duration_error = "Error: Invalid duration format. Duration must be a whole number.";
		}

		$director_error = "";
		if (!validate_director($_POST["director"])) {
			$director_error = "Error: Invalid director format. Director can only contain letters and spaces.";
		}

		$cast_error = "";
		if (!validate_cast($_POST["cast"])) {
			$cast_error = "Error: Invalid cast format. Cast can only contain letters and spaces.";
		}

		$rating_error = "";
		if (!validate_rating($_POST["rating"])) {
			$rating_error = "Error: Invalid rating format. Rating must be a number between 0 and 10, with up to one decimal place.";
		}

		$mov_img_error = "";
		if (!validate_url($_POST["mov_img"])) {
			$mov_img_error = "Error: Invalid movie image URL format.Please enter a valid URL.";
		}

		$trailer_error = "";
		if (!validate_url($_POST["trailer"])) {
			$trailer_error = "Error: Invalid trailer URL format. Please enter a valid URL.";
		}

		$video_error = "";
		if (!validate_url($_POST["video"])) {
			$video_error = "Error: Invalid video URL format. Please enter a valid URL.";
		}

		$cover_error = "";
		if (!validate_url($_POST["cover"])) {
			$cover_error = "Error: Invalid cover image URL format. Please enter a valid URL.";
		}

		// If there are no validation errors, submit the form
		if (empty($title_error) && empty($genre_error) && empty($description_error) && empty($release_date_error) && empty($duration_error) && empty($director_error) && empty($cast_error) && empty($rating_error) && empty($mov_img_error) && empty($trailer_error) && empty($video_error) && empty($cover_error)) {
			// Submit the form
			echo "Form submitted successfully!";
		}

	} else {
		// Display an error message if any required fields are empty
		echo "Error: All fields are required.";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add a Movie</title>

	<style>
		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		body {
			font-family: Arial, sans-serif;
			background-color: #FAFAFA;
		}

		h1 {
			text-align: center;
			margin: 30px 0;
			color: #444;
			text-shadow: 1px 1px 1px #EEE;
		}

		form {
			background-color: #FFF;
			border-radius: 5px;
			box-shadow: 0 2px 5px rgba(0,0,0,0.3);
			margin: 30px auto;
			max-width: 700px;
			padding: 30px;
			width: 90%;
		}

		label {
			color: #333;
			display: block;
			font-size: 18px;
			font-weight: bold;
			margin-bottom: 5px;
		}

		input[type="text"], input[type="date"], input[type="number"], input[type="url"], textarea {
			border: 1px solid #CCC;
			border-radius: 4px;
			box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
			font-size: 16px;
			margin-bottom: 20px;
			padding: 10px;
			width: 100%;
		}

		input[type="submit"] {
			background-color: #4CAF50;
			border: none;
			border-radius: 4px;
			color: #FFF;
			cursor: pointer;
			font-size: 18px;
			margin-top: 20px;
			padding: 10px;
			transition: background-color 0.3s ease;
			width: 100%;
		}

		input[type="submit"]:hover {
			background-color: #3E8E41;
		}
	</style>
</head>
<body>
	<h1>Add a Movie</h1>


    <form method="post">
	<label for="title">Title:</label>
	<input type="text" id="title" name="title">
	<div class="error" style="<?php echo !empty($title_error) ? 'color: red;' : ''; ?>"><?php echo $title_error; ?></div>

	<label for="genre">Genre:</label>
	<input type="text" id="genre" name="genre">
	<div class="error" style="<?php echo !empty($genre_error) ? 'color: red;' : ''; ?>"><?php echo $genre_error; ?></div>

	<label for="description">Description:</label>
	<textarea id="description" name="description"></textarea>
	<div class="error" style="<?php echo !empty($description_error) ? 'color: red;' : ''; ?>"><?php echo $description_error; ?></div>

	<label for="release_date">Release Date:</label>
	<input type="date" id="release_date" name="release_date" required>
	<div class="error" style="<?php echo !empty($release_date_error) ? 'color: red;' : ''; ?>"><?php echo $release_date_error; ?></div>

	<label for="duration">Duration (in minutes):</label>
	<input type="number" id="duration" name="duration" required>
	<div class="error" style="<?php echo !empty($duration_error) ? 'color: red;' : ''; ?>"><?php echo $duration_error; ?></div>

	<label for="director">Director:</label>
	<input type="text" id="director" name="director">
	<div class="error" style="<?php echo !empty($director_error) ? 'color: red;' : ''; ?>"><?php echo $director_error; ?></div>

	<label for="cast">Cast:</label>
	<input type="text" id="cast" name="cast">
	<div class="error" style="<?php echo !empty($cast_error) ? 'color: red;' : ''; ?>"><?php echo $cast_error; ?></div>

	<label for="rating">Rating (out of 10):</label>
	<input type="number" id="rating" name="rating" min="0" max="10" step="0.1" required>
	<div class="error" style="<?php echo !empty($rating_error) ? 'color: red;' : ''; ?>"><?php echo $rating_error; ?></div>

	<label for="mov_img">Movie Image URL:</label>
	<input type="text" id="mov_img" name="mov_img">
	<div class="error" style="<?php echo !empty($mov_img_error) ? 'color: red;' : ''; ?>"><?php echo $mov_img_error; ?></div>

	<label for="trailer">Trailer URL:</label>
	<input type="text" id="trailer" name="trailer">
	<div class="error" style="<?php echo !empty($trailer_error) ? 'color: red;' : ''; ?>"><?php echo $trailer_error; ?></div>

	<label for="video">Video URL:</label>
	<input type="text" id="video" name="video">
	<div class="error" style="<?php echo !empty($video_error) ? 'color: red;' : ''; ?>"><?php echo $video_error; ?></div>

	<label for="cover">Cover Image URL:</label>
	<input type="text" id="cover" name="cover">
	<div class="error" style="<?php echo !empty($cover_error) ? 'color: red;' : ''; ?>"><?php echo $cover_error; ?></div>

	<input type="submit" value="Add Movie">
</form>
</body>
</html>
