<?php
// Include the database connection file
require('connect.php');

// Fetch user details
$conn = new DBConnect;
$connection = $conn->getConnection();


// Fetch user profile from the database
$user_id = 1; // Assuming the logged-in user is Nathnael (user_id = 1)

// Function to update the user profile
function updateProfile($connection, $user_id, $username, $bio, $email, $country, $dob)
{
    $query = "CALL UpdateProfile($user_id, '$username', '$bio', '$email', '$country', '$dob')";
    $result = mysqli_query($connection, $query);
    // Consume the result
    while (mysqli_next_result($connection)) {
        if (!mysqli_more_results($connection)) {
            break;
        }
    }
    if ($result) {
        // Profile updated successfully
        return true;
    } else {
        // Error occurred while updating profile
        return false;
    }
}

// Function to fetch user profile
function getProfile($connection, $user_id)
{
    $query = "CALL GetProfile($user_id)";
    $result = mysqli_query($connection, $query);
    // Consume the result
    while (mysqli_next_result($connection)) {
        if (!mysqli_more_results($connection)) {
            break;
        }
    }
    $user = mysqli_fetch_assoc($result);

    return $user;
}

// Fetch the user profile
$user = getProfile($connection, $user_id);

// Initialize variables for success and error messages
$successMessage = "";
$errorMessage = "";

// Check if the form is submitted
if (isset($_POST['SaveProfile'])) {
    // Retrieve the form data
    $username = $_POST['username'];
    $bio = $_POST['bio'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $dob = $_POST['dob'];

    // Update the user profile
    $result = updateProfile($connection, $user_id, $username, $bio, $email, $country, $dob);

    if ($result) {
        // Profile updated successfully
        $successMessage = "Profile updated successfully!";
        // Fetch the updated user profile
        $user = getProfile($connection, $user_id);
        // Redirect to profile.php with success message
        /*         //header("Location: profile.php?success=true");
        echo '<script>alert("Profile updated successfully!");</script>'; // Display success alert message
        echo '<script>window.location.href = "profile.php?success=true";</script>'; // Redirect to profile.php with success message
        exit(); */
    } else {
        // Error occurred while updating profile
        $errorMessage = "Error updating profile. Please try again.";
    }
}

// Close the database connection
mysqli_close($connection);
