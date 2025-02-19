<?php
$showAlert = false;
$showError = false;
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $username= $_POST['username'];
    $mobile= $_POST['mobile'];
    $password= $_POST['password'];
    $address=$_POST['address'];
    $role=$_POST['role'];
    $existSql = "SELECT * FROM `users` WHERE username = '$username' AND password='$password'AND role='$role'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "Username Already Exists";
    }
    else{
        // $exists = false;
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (`username`, `mobile`, `password`, `address`,`role`) VALUES ('$username', '$mobile', '$hash', '$address','$role')";
        $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
                header("location: login.php");
            }
            else    {
            $showError = "Passwords do not match";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel="stylesheet">
    <style>
    body {
      background-color: #f0f0f0; /* Adjusted background color */
      background-size: cover; /* Adjusted size to improve clarity */
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 70%;
    }
    .register-container {
      margin: 20px;
      width: 100%;
      max-width: 400px; /* Adjusted width to make the card smaller */
    }
    .card {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255,0.1); /* Adjusted transparency */
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      width: 100%;
    }
    .form-control, .form-select {
      font-size: 0.9rem; /* Adjusted font size */
      padding: 0.5rem; /* Adjusted padding */
    }
    .btn-primary {
      transition: all 0.3s ease-in-out;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      transform: scale(1.05);
    }
</style>
</head>
<body>
    <div class="container">
    <div class="register-container" style="max-width: 500px; padding: 20px;">
            <div class="card text-center">
                <h3 class="mb-4">Register</h3>
                <form action="register.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter User name" required>
                    </div>
                    <div class="mb-2">
                        <label for="mobile" class="form-label">Mobile No</label>
                        <input type="tel" maxlength="10" class="form-control" name="mobile" id="mobile" placeholder="Enter mobile number" required>
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" maxlength="11" class="form-control" name="password" id="password" placeholder="Enter password" required>
                    </div>
                    <div class="mb-2">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="address" placeholder="Enter your address" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="role" class="form-label">Register as</label>
                        <select class="form-select" name="role" id="role">
                            <option value="voter">Voter</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
                <div class="mt-3">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
