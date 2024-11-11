
<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$dbname="login";
try{
    $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['username'];
        $password=$_POST['password'];
       $stmt=$conn->prepare("Select * from userdata where username=:username");
       $stmt->bindParam(':username',$username);
       $stmt->execute();
       $user=$stmt->fetch(PDO::FETCH_ASSOC);
    //    print_r($user);
     if($user && password_verify($password,$user['password'])){
        $_SESSION['username']=$user['username'];
        echo "<br>Login succcessful";
        header("refresh:2;url=firstpage2.php");
        exit();
        }
    //admin-data
    $stmt = $conn->prepare("SELECT * FROM admindata WHERE adminname = :adminname");
        $stmt->bindParam(':adminname', $username);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // If admin exists and password matches
        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['adminname']=$admin['adminname'];
            echo "<br>Admin login successful";
            header("refresh:2;url=admin.php");
            exit();
        } else {
            echo "<br>Invalid username or password";
        }
}

}catch(PDOException $e){
    echo "Error : ". $e->getMessage();
}
$conn=null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/loginpage1.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login Page</title>
</head>
<body>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Login</header>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="field input-field">
                        <input type="text" class="input" placeholder="Name" name="username" required>
                    </div>
                    <div class="field input-field">
                        <input type="password" placeholder="Password" class="password" name="password" required>
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="form-link">
                        <a href="forgot_password.php" class="forgot-pass">Forgot password?</a>
                    </div>
                    <div class="field button-field">
                        <button>Login</button>
                    </div>
                </form>
                <div class="form-link">
                    <span>Don't have an account?
                    <a href="signup1.php" class="link signup-link">Signup</a></span>
                </div>
            </div>
            <div class="line"></div>
            <div class="media-options">
                <a href="https://accounts.google.com" class="field google">
                    <img src="google.png" alt="" class="google-img">
                    <span>Login with Google</span>
                </a>
            </div>
        </div>
    </section>
    <script src="scripts/loginscript1.js"></script>
</body>
</html>
