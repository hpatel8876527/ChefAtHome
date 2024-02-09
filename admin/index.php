<?php 

session_start();

require './functions.php';

$errors = null;

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    
    
    if(empty($_POST['email']) && empty($_POST['password'])) {

        $errors = 'All fields are required.';
    }

    
    if(!$errors) {
        
        $email = $_POST["email"];
        $password = $_POST["password"];

        $pdo = connectToDatabase();
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // admin data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($user){

            $_SESSION['admin'] = [ 'name' => $user['name'], 'email' => $user['email'] ];
            
            header('Location: /admin/dashboard.php');
            exit;

        }else{

            unset($_SESSION['admin']);
            $errors = 'Invalid Email or Password.';
        }
    

    }
    
}

include 'includes/header.php'; 

?>

<!-- Admin Login Form -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <p class="text-danger fw-bold"><?php  if($errors){ echo $errors; } ?></p>

            <div class="card">
                <div class="card-header">
                    <span class="fw-bold">Admin Login</span>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        
                    <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>

                        <button type="submit" name="login" class="btn btn-primary">Login</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

