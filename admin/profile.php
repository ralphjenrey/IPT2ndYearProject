<?php
include 'admin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" type="text/css" href="css/profile.css">
</head>

<body>

  <div class="dashboard-container">
    <header class="bg-dark text-white text-center fs-4">Profile</header>
    <?php
    if(isset($_POST['update_password'])) {
      // Get the user's input
      $current_password = $_POST['current_password'];
      $new_password = $_POST['new_password'];
      $confirm_password = $_POST['confirm_password'];

      // TODO: Validate the user's input

      // Check if the current password is correct
      $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
      $stmt->execute([$_SESSION['user_id']]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if(password_verify($current_password, $user['password'])) {
        // Hash the new password using bcrypt
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update the user's password in the database
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hashed_password, $_SESSION['user_id']]);

        // Display a success message
        echo "Password updated successfully";
      } else {
        // If the current password is incorrect, display an error message
        echo "Current password is incorrect";
      }
    }
    ?>

    <form method="post">
      <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
      <p><strong>Email:</strong> <?php echo $user['email']; ?></p>

      <div class="accordion" id="toggleAccordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="passwordHeading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#passwordCollapse" aria-expanded="false" aria-controls="passwordCollapse">
              Change Password
            </button>
          </h2>
          <div id="passwordCollapse" class="accordion-collapse collapse" aria-labelledby="passwordHeading" data-bs-parent="#toggleAccordion">
            <div class="accordion-body">
              <label for="current_password">Current Password:</label>
              <input type="password" id="current_password" name="current_password"><br>

              <label for="new_password">New Password:</label>
              <input type="password" id="new_password" name="new_password"><br>

              <label for="confirm_password">Confirm New Password:</label>
              <input type="password" id="confirm_password" name="confirm_password"><br>
              <input type="submit" name="update_password" value="Update Password">
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="pictureHeading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pictureCollapse" aria-expanded="false" aria-controls="pictureCollapse">
              Change Profile Picture
            </button>
            </h2>
<div id="pictureCollapse" class="accordion-collapse collapse" aria-labelledby="pictureHeading" data-bs-parent="#toggleAccordion">
<div class="accordion-body">
<form method="post" enctype="multipart/form-data">
<input type="file" name="profile_picture"><br>
<input type="submit" value="Change Profile Picture">
</form>
</div>
</div>
</div>
</div>
</form>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
             
