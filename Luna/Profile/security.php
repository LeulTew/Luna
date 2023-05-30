<?php
require('editProfile.php');
$conn = new DBConnect;
$connection = $conn->getConnection();

// Initialize variables for changed message
$changedMessage = "";

// Check if the form is submitted
if (isset($_POST['SaveSecurity'])) {
    // Retrieve the form data
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];
    $confirmNewPassword = $_POST['confirm-new-password'];
    $visibility = $_POST['visibility'];

    // Update the visibility setting in the database
    $updateVisibilityQuery = "CALL UpdateVisibility($user_id, '$visibility')";
    $updateVisibilityResult = mysqli_query($connection, $updateVisibilityQuery);
    // Consume the result
    while (mysqli_next_result($connection)) {
        if (!mysqli_more_results($connection)) {
            break;
        }
    }
    if ($updateVisibilityResult) {
        // Update the user's visibility in the $user variable
        $user['profile_visibility'] = $visibility;
        $changedMessage = "Visibility Changed!";
    }

    // Get the current password from the database
    $currentPasswordDB = $user['password'];
    // Verify if the current password matches the one entered by the user
    if ($currentPasswordDB == $currentPassword && $newPassword == $confirmNewPassword) {
        // Update the password in the database
        $updateSecurityQuery = "CALL UpdateSecurity($user_id, '$newPassword')";
        $updateSecurityResult = mysqli_query($connection, $updateSecurityQuery);
        // Consume the result
        while (mysqli_next_result($connection)) {
            if (!mysqli_more_results($connection)) {
                break;
            }
        }
        if ($updateSecurityResult && $updateVisibilityResult) {
            $changedMessage = "Password and Visibility Changed!";
            // Update the user's visibility in the $user variable
            $user['profile_visibility'] = $visibility;
        } else if ($updateSecurityResult) {
            $changedMessage = "Password Changed!";
        } else {
            $changedMessage = "Password Change Failed!";
        }
    }
}

// Close the database connection
mysqli_close($connection);
