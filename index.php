<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Submission</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style>
    /* Full screen background with image */
    body {
      background-image: url('images/2.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      height: 100%;
      margin: 0;
    }

    /* Gradient overlay */
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5); /* semi-transparent dark overlay */
    }

    .vertical-center {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      z-index: 1;
      position: relative;
    }

    .form-container {
      background: rgba(255, 255, 255, 0.85); /* Slight white background with transparency */
      padding: 30px;
      border-radius: 10px;
      width: 40%;
    }

    h2 {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <!-- Overlay for darker background -->
  <div class="overlay"></div>

  <div class="container vertical-center">
    <div class="form-container">
      <h2 class="text-center">Submit Your Information</h2>
      <form method="post">
        <div class="form-group">
          <label for="firstname">Name:</label>
          <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "application-database.c7g6y8048fxd.us-east-1.rds.amazonaws.com";
    $username = "intel";
    $password = "intel123";
    $db = "intel";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and validate input
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (!empty($firstname) && !empty($email)) {
        $sql = "INSERT INTO data (firstname, email) VALUES ('$firstname', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success text-center'>New record created successfully</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>Please fill out all fields</div>";
    }

    $conn->close();
}
?>

</body>
</html>
