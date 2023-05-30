<?php
// Include the database connection file
require('security.php');
$conn = new DBConnect;
$connection = $conn->getConnection();

// Fetch subscription details
$query = "CALL GetSubscriptionDetails($user_id)";
$result = mysqli_query($connection, $query);
$subscription = mysqli_fetch_assoc($result);
// Consume the result
while (mysqli_next_result($connection)) {
    if (!mysqli_more_results($connection)) {
        break;
    }
}
if (is_null($subscription)) {
    $subscription['current_plan'] = 'No Plan';
    $subscription['billing_information'] = '';
    $subscription['renewal_date'] = '';
}


// Upgrade Subscription procedure
function upgradeSubscription($user_id)
{
    global $connection;
    $query = "CALL UpgradeSubscription($user_id)";
    mysqli_query($connection, $query);
    // Consume the result
    while (mysqli_next_result($connection)) {
        if (!mysqli_more_results($connection)) {
            break;
        }
    }
}

// Downgrade Subscription procedure
function downgradeSubscription($user_id)
{
    global $connection;
    $query = "CALL DowngradeSubscription($user_id)";
    mysqli_query($connection, $query);
    // Consume the result
    while (mysqli_next_result($connection)) {
        if (!mysqli_more_results($connection)) {
            break;
        }
    }
    $subscription['current_plan'] = 'Standard';
}

// Cancel Subscription procedure
function cancelSubscription($user_id)
{
    global $connection;
    $query = "CALL CancelSubscription($user_id)";
    mysqli_multi_query($connection, $query);

    // Consume the result sets
    while (mysqli_next_result($connection)) {
        if (!mysqli_more_results($connection)) {
            break;
        }
    }
}
// Check if a form was submitted
if (isset($_POST['upgradeButton'])) {
    if ($subscription['current_plan'] == 'Standard') {
        // Show payment popup or perform payment processing
        // After successful payment, call the upgradeSubscription function
        // For now, we'll assume the payment is successful and upgrade the subscription immediately
        upgradeSubscription($user_id);
        $subscription['current_plan'] = 'Premium';
        // Refresh the page after upgrade
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
} elseif (isset($_POST['downgrade'])) {
    if ($subscription['current_plan'] == 'Premium') {
        downgradeSubscription($user_id);
        $subscription['current_plan'] = 'Standard';

        // Refresh the page after downgrade
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
} elseif (isset($_POST['cancel_confirmation'])) {
    echo "<script>alert('Service Canceled')</script>";
    // Check if the cancel confirmation is set
    if (isset($_POST['cancel_confirmation'])) {
        cancelSubscription($user_id);
        $subscription['current_plan'] = 'No Plan';
        $subscription['billing_information'] = '';
        $subscription['renewal_date'] = '';
    }
}
