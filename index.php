<?php
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = mysqli_connect("localhost", "root", "", "Admission");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $branch = mysqli_real_escape_string($con, $_POST['branch']);

    $sql = "INSERT INTO admission (name, dob, phone, gender, email, address, branch, dt)
            VALUES ('$name', '$dob', '$phone', '$gender', '$email', '$address', '$branch', current_timestamp())";

    if (mysqli_query($con, $sql)) {
        $success = true;
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Elegant Admission Form</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h1>Welcome to Sinhgad College</h1>
    <p>Please fill in the form to apply for admission</p>

    <?php if ($success): ?>
      <div class="success-message">🎉 Application submitted successfully!</div>
    <?php endif; ?>

    <form id="admissionForm" method="POST" onsubmit="return validateForm();">
      <label>Name:
        <input type="text" name="name" id="name" required placeholder="Enter your full name">
      </label>

      <label>DOB:
        <input type="date" name="dob" id="dob" required>
      </label>

      <label>Mobile Number:
        <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" required>
      </label>

      <label>Gender:
        <select name="gender" id="gender" required>
          <option value="">--Select Gender--</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </label>

      <label>Email:
        <input type="email" name="email" id="email" required>
      </label>

      <label>Permanent Address:
        <textarea name="address" id="address" rows="3" required></textarea>
      </label>

      <label>Branch:
        <select name="branch" id="branch" required>
          <option value="">--Select Branch--</option>
          <option value="Comp">Computer</option>
          <option value="IT">IT</option>
          <option value="Mech">Mechanical</option>
        </select>
      </label>

      <button type="submit" class="btn">Submit Application</button>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html>
