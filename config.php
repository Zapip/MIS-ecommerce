<?php
session_start();

// initializing variables
$username = "";
$email = "";
$errors = array();

// connect to the database
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'ecommerce');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $firstName = mysqli_real_escape_string($db, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($db, $_POST['last_name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($firstName)) {
        array_push($errors, "First name is required");
    }
    if (empty($lastName)) {
        array_push($errors, "First name is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM user_info WHERE first_name='$firstName' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['Name'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO user_info (first_name, last_name, email, password) 
  			  VALUES('$firstName','$lastName', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['Name'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        // Encrypt the password using md5 (or preferably use password_hash for better security)
        $password = md5($password);

        // First, check the user_info table
        $user_query = "SELECT * FROM user_info WHERE email='$email' AND password='$password'";
        $user_result = mysqli_query($db, $user_query);

        if (mysqli_num_rows($user_result) == 1) {
            // User found in user_info
            $user = mysqli_fetch_assoc($user_result);
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');  // Redirect to user dashboard or home page
        } else {
            // If user not found in user_info, check admin_info
            $admin_query = "SELECT * FROM admin_info WHERE admin_email='$email' AND admin_password='$password'";
            $admin_result = mysqli_query($db, $admin_query);

            if (mysqli_num_rows($admin_result) == 1) {
                // Admin found in admin_info
                $admin = mysqli_fetch_assoc($admin_result);
                $_SESSION['admin_email'] = $admin['admin_email'];
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['success'] = "You are now logged in";
                header('location: admin.php');  // Redirect to admin dashboard
            } else {
                // If not found in both tables
                array_push($errors, "Wrong email/password combination");
            }
        }
    }
}


?>