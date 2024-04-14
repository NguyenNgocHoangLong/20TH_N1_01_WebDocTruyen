<?php
require_once("entities/readers.class.php");

$message = "";  // Message to display errors or success

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password)) {
        $message = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        $db = new Db();
        $conn = $db->connect();

        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT * FROM readers WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $message = "Username or email already exists.";
        } else {
            // Insert the new user
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO readers (username, email, password_hash) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password_hash);
            if ($stmt->execute()) {
                $message = "Registration successful. <a href='login.php'>Login here</a>.";
            } else {
                $message = "Error in registration.";
            }
        }
        $stmt->close();
        $conn->close();
    }
}
?>
<?php include_once("header.php");?>
    <h2>Register</h2>
    <p style="color: red;"><?php echo $message; ?></p>
    <form action="register.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
<?php include_once("footer.php");?>
