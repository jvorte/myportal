<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    // ====================test=======================
     // Validate confirm address
    if(empty(trim($_POST["address"]))){
        $confirm_address_err = "Please confirm address.";     
    } else{
        $address = trim($_POST["address"]);
        
    }
    
         // Validate confirm city
         if(empty(trim($_POST["city"]))){
            $confirm_city_err = "Please confirm city.";     
        } else{
            $city = trim($_POST["city"]);
          
        }

           // Validate confirm country
           if(empty(trim($_POST["country"]))){
            $confirm_country_err = "Please confirm country.";     
        } else{
            $country = trim($_POST["country"]);
           
        }

           // Validate confirm zip
           if(empty(trim($_POST["zip"]))){
            $confirm_zip_err = "Please confirm zip.";     
        } else{
            $zip = trim($_POST["zip"]);
           
        }
            // Validate confirm mobile
            if(empty(trim($_POST["mobile"]))){
                $confirm_mobile_err = "Please confirm mobile.";     
            } else{
                $mobile = trim($_POST["mobile"]);
              
            }
            // Validate confirm email
            if(empty(trim($_POST["email"]))){
                $confirm_email_err = "Please confirm email.";     
            } else{
                $email = trim($_POST["email"]);
              
            }


       // ==================e test=========================
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password , address, city, country, zip, mobile, email) VALUES (:username, :password, :address, :city, :country, :zip, :mobile, :email)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            $stmt->bindParam(":address", $param_address, PDO::PARAM_STR);
            $stmt->bindParam(":city", $param_city, PDO::PARAM_STR);
            $stmt->bindParam(":country", $param_country, PDO::PARAM_STR);
            $stmt->bindParam(":zip", $param_zip, PDO::PARAM_STR);
            $stmt->bindParam(":mobile", $param_mobile, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_address = $address;
            $param_city = $city;
            $param_country = $country;
            $param_zip = $zip;
            $param_mobile = $mobile;
            $param_email = $email;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: ../index.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>



 
 <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyPortal</title>
    <link rel="stylesheet" href="../style.css">
         <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <!-- Bootstrap Font Icon CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
     <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    </head>
  <body id="bg_portal">
<!-- ------------------navbar----------------------- -->


<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand" href="portal.php"><img id="icon" src="../icons/3.png" alt="" srcset=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="../portal.php">Home</a>
        </li>

      </ul>
      <a class="nav-link  ">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar2-week" viewBox="0 0 16 16">
        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
        <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
        </svg>
          <?php echo date("l jS \of F Y h:i:s A")?></a> 
  
    </div>
  </div>
</nav>

<!-- ---------------end---navbar----------------------- -->

<!-- ---------------center----------------------- -->
<div class="container myData">
<h2>Registration Form</h1>
<p>please enter your data</p>

    <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="col-md-6">
  <label>Username</label>
    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
    <span class="invalid-feedback"><?php echo $username_err; ?></span>
  </div>
  <div class="col-md-3">
  <label>Password</label>
    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
    <span class="invalid-feedback"><?php echo $password_err; ?></span>
  </div>
  <div class="col-md-3">
  <label>Confirm Password</label>
    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
  </div>

  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" name="address" class="form-control <?php echo (!empty($confirm_address_err)) ? 'is-invalid' : ''; ?>"  id="inputAddress" placeholder="1234 Main St">
    <span class="invalid-feedback"><?php echo $address_err; ?></span> 
</div>

  <div class="col-md-3">
    <label for="inputCity" class="form-label">City</label>
    <input type="text" name="city"  class="form-control<?php echo (!empty($city)) ? 'is-invalid' : ''; ?>" value="" id="inputCity">
    <span class="invalid-feedback"><?php echo $city_err; ?></span>
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">Country</label>
    <select id="inputState" name="country"  class="form-select <?php echo (!empty($country)) ? 'is-invalid' : ''; ?>" value="">
    <span class="invalid-feedback"><?php echo $country_err; ?></span>
      <option selected>Choose...</option>
      <option>Austria</option>
      <option>Deutchland</option>
    </select>
  </div>

  <div class="col-md-2">
    <label for="inputZip" class="form-label">Zip</label>
    <input type="text" name="zip"  class="form-control <?php echo (!empty($zip)) ? 'is-invalid' : ''; ?>" value="" id="inputZip">
    <span class="invalid-feedback"><?php echo $zip_err; ?></span>
  </div>
  <div class="col-md-3">
    <label for="inputCity" class="form-label">Mobile</label>
    <input type="text" name="mobile"  class="form-control<?php echo (!empty($mobile)) ? 'is-invalid' : ''; ?>" value="" id="inputCity">
    <span class="invalid-feedback"><?php echo $mobile_err; ?></span>
  </div>
  <div class="col-md-3">
    <label for="inputCity" class="form-label">Email</label>
    <input type="Email" name="email"  class="form-control<?php echo (!empty($email)) ? 'is-invalid' : ''; ?>" value="" id="inputCity">
    <span class="invalid-feedback"><?php echo $email_err; ?></span>
  </div>

  <p>Already have an account? <a href="../index.php">Login here</a>.</p>
  <div class="col-12 mb-3">
  <input type="submit" class="btn btn-primary" value="Submit">
  <input type="reset" class="btn btn-secondary ml-2" value="Reset">
  </div>
</form>


</div>
<!-- ---------------end---center----------------------- -->
   


    <footer class="footer">
  <h6 class="text-center  fs-6 bg-dark text-light">D.Vortelinas Copyright<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-c-circle" viewBox="0 0 16 16">
  <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.146 4.992c-1.212 0-1.927.92-1.927 2.502v1.06c0 1.571.703 2.462 1.927 2.462.979 0 1.641-.586 1.729-1.418h1.295v.093c-.1 1.448-1.354 2.467-3.03 2.467-2.091 0-3.269-1.336-3.269-3.603V7.482c0-2.261 1.201-3.638 3.27-3.638 1.681 0 2.935 1.054 3.029 2.572v.088H9.875c-.088-.879-.768-1.512-1.729-1.512"/>
</svg> <?php echo date("Y");?></h6>
</footer>
<script src="myscripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>



 
