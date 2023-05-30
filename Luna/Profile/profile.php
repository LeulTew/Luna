<?php
require('subscription.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile - Luna</title>
    <link rel="stylesheet" href="profile.css" />
</head>

<body>
    <header>
        <nav class="top-nav">
            <div class="logo">
                <a href="#">Luna</a>
            </div>
            <ul class="top-nav-links">
                <li> <a href="#">Home</a></li>
                <li><a href="#">Explore</a></li>
                <li><a href="#">Library</a></li>
                <li><a href="#">Trending</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <nav class="side-nav">
            <ul>
                <li>
                    <a href="#" class="nav-link" data-section="edit-profile"><img src="2511431-200.png" alt="" /> Edit Profile</a>
                </li>
                <li>
                    <a href="#" class="nav-link" data-section="privacy-settings"><img src="sec.png" alt="" /> Privacy/Security</a>
                </li>
                <li>
                    <a href="#" class="nav-link" data-section="subscription-details"><img src="pay.png" alt="" /> Subscription Details</a>
                </li>
            </ul>
        </nav>

        <div class="main-content">
            <!-- Edit Profile -->
            <section id="edit-profile" class="profile-section">
                <div class="profile-info">
                    <h2>Edit Profile</h2>
                    <div class="user-details">
                        <h3>
                            Edit your profile information. Update your username, bio, email,
                            country/region, and date of birth.
                        </h3>
                    </div>
                </div>
                <form id="profile-form" action="" method="POST">
                    <fieldset>
                        <legend>
                            Edit Profile
                            <img src="error.webp" alt="" width="30" height="30" />
                        </legend>
                        <!-- Username -->
                        <div class="input-control">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" placeholder="Enter Name" />
                            <div class="error"></div>
                        </div>
                        <!-- BIO -->
                        <label for="bio">Bio:</label>
                        <textarea id="bio" name="bio" placeholder="Enter Bio"><?php echo $user['bio']; ?></textarea>
                        <!-- Email -->
                        <div class="input-control">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" placeholder="Enter Email john.doe@example.com" />
                            <div class="error"></div>
                        </div>
                        <!-- Region -->
                        <div class="input-control">
                            <label for="country">Country/Region:</label>
                            <input type="text" id="country" name="country" value="<?php echo $user['country']; ?>" />
                            <div class="error"></div>
                        </div>
                        <!-- DOB -->
                        <div class="input-control">
                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="dob" name="dob" value="<?php echo $user['dob']; ?>" />
                            <div class="error"></div>
                        </div>

                        <input type="submit" name="SaveProfile" value="Save Changes" />

                        <?php if (!empty($successMessage)) : ?>
                            <div id="success-message" class="success-message"><?php echo $successMessage; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($errorMessage)) : ?>
                            <div id="error-message" class="error-message"><?php echo $errorMessage; ?></div>
                        <?php endif; ?>

                    </fieldset>

                </form>
            </section>


            <!-- Privacy/Security Settings -->
            <section id="privacy-settings" class="profile-section">
                <div>
                    <h2>Privacy/Security Settings</h2>
                    <h3>
                        Manage your privacy and security preferences. Change your current
                        password, set a new password, and confirm it. You can also choose
                        your profile visibility and notification preferences.
                    </h3>
                </div>

                <form action="" method="POST" id="privacy-form">
                    <fieldset>
                        <legend>Privacy/Security Settings</legend>

                        <label for="visibility">Profile Visibility:</label>
                        <select id="visibility" name="visibility">
                            <option value="public" <?php if ($user['profile_visibility'] == 'public') echo 'selected'; ?>>Public</option>
                            <option value="private" <?php if ($user['profile_visibility'] == 'private') echo 'selected'; ?>>Private</option>
                            <option value="friends" <?php if ($user['profile_visibility'] == 'friends') echo 'selected'; ?>>Friends Only</option>
                        </select>

                        <div class="pass">
                            <h2>Change Password</h2>

                            <div class="input-control">
                                <div id="curr" style="display: none;"><?php echo $user['password']; ?></div>
                                <label for="current-password">Current Password:</label>
                                <input type="password" id="current-password" name="current-password" />
                                <div class="error"></div>
                            </div>

                            <div class="input-control">
                                <label for="new-password">New Password:</label>
                                <input type="password" id="new-password" name="new-password" />
                                <div class="error"></div>
                            </div>

                            <div class="input-control">
                                <label for="confirm-new-password">Confirm New Password:</label>
                                <input type="password" id="confirm-new-password" name="confirm-new-password" />
                                <div class="error"></div>
                            </div>
                        </div>

                        <input type="submit" value="Save Changes" name="SaveSecurity" />

                        <!-- Display the changed message -->
                        <?php if (!empty($changedMessage)) : ?>
                            <div id="changed-message" class="Changed-message"><?php echo $changedMessage; ?></div>
                        <?php endif; ?>
                    </fieldset>
                </form>
            </section>

            <!-- Subscription -->
            <section id="subscription-details" class="profile-section">
                <h2>Subscription Details</h2>
                <form action="" method="post">
                    <fieldset>
                        <legend>Subscription Details</legend>

                        <p>Current Subscription Plan: <?php echo $subscription['current_plan']; ?></p>
                        <p>Renewal Date: <?php echo $subscription['renewal_date']; ?></p>
                        <p>Billing Information: <?php echo $subscription['billing_information']; ?></p>


                        <!-- Upgrade Button -->
                        <button type="button" name="upgrade" <?php if ($subscription['current_plan'] == 'Standard') echo 'onclick="showUpgradePopup()"';
                                                                else echo 'disabled'; ?>>Upgrade Subscription</button>

                        <!-- Downgrade Button -->
                        <button type="submit" name="downgrade" <?php if ($subscription['current_plan'] == 'Premium') echo '';
                                                                else echo 'disabled'; ?> onclick="return confirm('Are you sure you want to downgrade to the Standard plan?')">Downgrade Subscription</button>
                        <!-- Cancel Button -->
                        <button type="button" name="cancel" <?php if ($subscription['current_plan'] == 'No Plan') echo 'disabled';
                                                            else echo 'onclick="showCancelConfirmation()"'; ?>>Cancel Subscription</button>

                    </fieldset>
                </form>
            </section>

            <form action="" method="POST">
                <!-- Upgrade Pop-up -->
                <div id="upgrade-popup" style="display: none;">
                    <h3>Recommended for You</h3>
                    <h2>Premium Plan</h2>
                    <ul class="premium-plan-description">
                        <li>Access to a vast library of 4K movies</li>
                        <li>Exclusive content available only to Premium subscribers</li>
                        <li>Ad-free streaming experience</li>
                        <li>Priority customer support</li>
                        <li>Offline downloads for selected titles</li>
                    </ul>
                    <button id="upgradeButton" type="submit" name="upgradeButton">Upgrade Now</button>
                    <button type="button" onclick="hideUpgradePopup()">Keep Plan</button>
                </div>
                <!-- Payment Method Pop-up -->
                <div id="payment-popup" style="display: none;">
                    <h3>Add Payment Method</h3>
                    <button type="button" onclick="addCard()">Add Card</button>
                    <button type="button" onclick="selectMasterCard()">MasterCard</button>
                    <button type="button" onclick="selectVisa()">Visa</button>
                </div>
            </form>
            <!-- Cancel Pop up -->
            <div id="cancel-confirmation" style="display: none;">
                <p>Are you sure you want to cancel your subscription?</p>
                <button type="submit" name="cancel_confirmation">Cancel Subscription</button>
                <button type="button" onclick="hideCancelConfirmation()">Keep Plan</button>
            </div>
            </form>

        </div>
    </div>

    <script src="profile.js"></script>

</body>

</html>