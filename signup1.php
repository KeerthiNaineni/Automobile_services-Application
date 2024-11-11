<?php
$servername="localhost";
$username="root";
$password="";
$dbname="login";
try{
    $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    if($_SERVER['REQUEST_METHOD']=='POST'){
        function validateInput($data){
            $data=trim($data);
            $data=stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }
        $username=validateInput($_POST['username']);
        $email=validateInput($_POST['email']);
        $password=validateInput($_POST['password']);
        $confirmpassword=validateInput($_POST['cpassword']);
        if($password!==$confirmpassword){
            echo "Passwords do not match ..please enter correct password"; 
        }else{
            $hashed_password=password_hash($password,PASSWORD_DEFAULT);
            $stmt_check=$conn->prepare("Select * from userdata where username=:username or email=:email");
            $stmt_check->bindParam(':username',$username);
            $stmt_check->bindParam(':email',$email);
            $stmt_check->execute();
            if($stmt_check->rowCount()>0){
                echo "Username or Email already exists.Please choose different one.";
            }
            else{
       $stmt_insert=$conn->prepare("Insert into userdata (username,email,password) values (:username,:email,:password)");
       $stmt_insert->bindParam(':username',$username);
       $stmt_insert->bindParam(':email',$email);
       $stmt_insert->bindParam(':password',$hashed_password);
       $stmt_insert->execute();
       echo "Registration successful";
       header("refresh:2;url=login1.php");
       exit();
    }
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
    <link rel="stylesheet" href="styles/signupscript1.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Signup Page</title>
</head>
<body>
    <section class="container forms">
        <div class="form signup">
            <div class="form-content">
                <header>Signup</header>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="field input-field">
                        <input type="text" name="username" class="input"  placeholder="Name" required>
                    </div>
                    <div class="field input-field">
                        <input type="email" name="email" class="input" placeholder="Email" required>
                    </div>
                    <div class="field input-field">
                        <input type="password" name="password" placeholder="Password" class="password" required>
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="field input-field">
                        <input type="password" name="cpassword" placeholder="Confirm Password"  class="password" required>
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="field button-field">
                        <button>Signup</button>
                    </div>
                </form>
                <div class="form-link">
                    <span>Already have an account?
                    <a href="login1.php" class="link login-link">Login</a></span>
                </div>
            </div>
            <div class="line"></div>
            <div class="media-options">
                <a href="https://accounts.google.com" class="field google">
                    <img src="google.png" alt="" class="google-img">
                    <span>Signup with Google</span>
                </a>
            </div>
        </div>
    </section>
    <script src="scripts/signupscript1.js"></script>
</body>
</html>
