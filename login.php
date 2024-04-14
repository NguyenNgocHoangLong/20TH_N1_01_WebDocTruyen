<?php
require_once("entities/readers.class.php");
session_start();
$message = "";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (!empty($username) && !empty($password)) {
        $db = new Db();
        $conn = $db->connect();
        $stmt = $conn->prepare("SELECT * FROM readers WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password_hash'])) {
                $_SESSION['user_id'] = $row['readerID'];
                $_SESSION['username'] = $row['username'];
                header("Location: list_comic.php");
                exit;
            } else {
                $message = "Invalid username or password.";
            }
        } else {
            $message = "Invalid username or password.";
        }
        $stmt->close();
        $conn->close();
    } else {
        $message = "Both fields are required.";
    }
}
?>
<?php include_once("header.php");?>
    <h2>Login</h2>
    <p style="color: red;"><?php echo $message; ?></p>
    <form action="login.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <button type="submit" name="login">Login</button>
        </div>
    </form>
<?php include_once("footer.php");?>
