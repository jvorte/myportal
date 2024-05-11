<?php
// Initialize the session
session_start();

 // Include config file
require_once "login_system/config.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

// Attempt select query execution (myData-user data)
$id=$_SESSION['id'];
try{

  $sql = "SELECT * FROM users WHERE id = $id ";  
  $result = $pdo->query($sql);
  if($result->rowCount() > 0){
     
      while($row = $result->fetch()){
       $id = $row['id'] ;
       $username = $row['username'];
       $firstname= $row['firstname'];
       $lastname = $row['lastname'];
       $address = $row['address'];
       $city = $row['city']; 
       $country = $row['country']; 
       $zip = $row['zip']; 
       $mobile = $row['mobile']; 
       $email =  $row['email'];  
      
       }

      // Free result set
      unset($result);
  } else{
      echo "No records matching your query were found.";
  }
} catch(PDOException $e){
  die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}



// Attempt select query execution (myData-user meeting)
$id=$_SESSION['id'];
try{

  $sql = "SELECT * FROM meeting WHERE user_id = $id ";  
  $result = $pdo->query($sql);
  if($result->rowCount() > 0){
     
      while($row = $result->fetch()){
       $date = $row['date'] ;
       $time = $row['time'];      
      
       }

      // Free result set
      unset($result);
  } 

} catch(PDOException $e){
  die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}



// --------------------------------1.Modal--address------------------------------------------------
       // Define variables and initialize with empty values
            
       $confirm_address_err = $confirm_city_err =$confirm_country_err = $confirm_zip_err = "";


       if (isset($_POST['submit1']))
       {
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

     $sql = "UPDATE users SET address='$address', city='$city', country='$country', zip='$zip' WHERE id='$id'";    
      $pdo->exec($sql);


     }
// -----------------------------End---1.Modal-----address---------------------------------------------



// --------------------------------2.Modal--mobile------------------------------------------------
       // Define variables and initialize with empty values
            
       $confirm_mobile_err = "";


       if (isset($_POST['submit2']))
              { // Validate confirm mobile
          if(empty(trim($_POST["mobile"]))){
            $confirm_mobile_err = "Please confirm mobile.";     
        } else{
            $mobile = trim($_POST["mobile"]);  
        }
        $sql = "UPDATE users SET mobile='$mobile' WHERE id='$id'";    
        $pdo->exec($sql);
  
       }
// --------------------------------2.End Modal--mobile------------------------------------------------




// --------------------------------3.Modal--Email------------------------------------------------
       // Define variables and initialize with empty values
            
       $confirm_email_err = "";


       if (isset($_POST['submit3']))
              { // Validate confirm mobile
          if(empty(trim($_POST["email"]))){
            $confirm_email_err = "Please confirm email.";     
        } else{
            $email = trim($_POST["email"]);  
        }
        $sql = "UPDATE users SET email='$email' WHERE id='$id'";    
        $pdo->exec($sql);
  
       }
// --------------------------------3.End Modal--Email------------------------------------------------


// --------------------------------4.Modal--Meeting------------------------------------------------
       // Define variables and initialize with empty values
            
       $confirm_date_err = $confirm_time_err = "";


       if (isset($_POST['submit4']))
              { // Validate confirm mobile
          if(empty(trim($_POST["date"]))){
            $confirm_date_err = "Please confirm date.";     
        } else{
            $date = trim($_POST["date"]);  
        }
        if(empty(trim($_POST["time"]))){
          $confirm_time_err = "Please confirm time.";     
      } else{
          $time = trim($_POST["time"]);  
      }
         
        $sql = "INSERT INTO  meeting   (user_id , date, time ) VALUES ('$id','$date', '$time')";   
        $pdo->exec($sql);
  
       }

       //Delete

       if (isset($_POST['submit6']))
       { 
          // Attempt update query execution
          try{
            $sql = "DELETE FROM meeting WHERE user_id ='$id'";  
            $pdo->exec($sql);
            // echo "Records were deleted successfully.";
          } catch(PDOException $e){
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
          }

          header('Location: myData.php');
          die();
        }

       //End delete
// --------------------------------4.End Modal--Meeting------------------------------------------------


// --------------------------------5.Modal--Vacations------------------------------------------------
       // Define variables and initialize with empty values
            
       $confirm_from_err = $confirm_until_err = "";


       if (isset($_POST['submit5']))
       { // Validate confirm mobile
        if(empty(trim($_POST["from"]))){
          $confirm_from_err = "Please confirm from date.";     
      } else{
          $from = trim($_POST["from"]);  
      }
      if(empty(trim($_POST["until"]))){
        $confirm_until_err = "Please confirm until time.";     
    } else{
        $until = trim($_POST["until"]);  
    }
       
      $sql = "INSERT INTO  vacations   (user_id , from_date, until_date ) VALUES ('$id','$from', '$until')";   
      $pdo->exec($sql);
      
         header('Location: myData.php');
         die();

     }

// --------------------------------5.End Modal--Vacations------------------------------------------------

?>

 
 <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyPortal</title>
    <link rel="stylesheet" href="style.css">
         <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <!-- Bootstrap Font Icon CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
     <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


  <body id="bg_portal">
<!-- ------------------navbar----------------------- -->


<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand" href="portal.php"><img id="icon" src="icons/3.png" alt="" srcset=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="myPortal.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
   
       <li class="nav-item hello">
       <a class="nav-link" href="myData.php">
       <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
        <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
        <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z"/>
      </svg>
      Welcome , <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
     
       </li>
      <li class="nav-item">        
        <a href="login_system/reset-password.php" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
      </svg>
            Reset Your Password</a>
        </li>
    
        <li class="nav-item">        
        <a href="login_system/logout.php" class="nav-link ml-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
          <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
        </svg>
            Sign Out of Your Account</a>
        </li>      
        <li class="nav-item">
        <a class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar2-week" viewBox="0 0 16 16">
        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
        <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
        </svg>
          <?php echo date("l jS \of F Y h:i:s A") ;?></a>  
        </li>
    
      </ul>
      <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
       </form> -->
    </div>
  </div>
</nav>

<!-- ---------------end---navbar----------------------- -->

<!-- ---------------center----------------------- -->

<div class="container title animate__animated animate__backInUp">
<h1 class="mt-5 display-4">MyData</h1> 
</div>

<div class="container mydata">

<div class="container  animate__animated animate__backInUp">
  <div class="row">
    <div class="col-sm-8">

    <ol class="list-group my-5">

  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class=" fs-5">FullName</div>
    <?php echo $firstname ." ".$lastname?>
    </div>
  </li>

  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class=" fs-5">MyAddress</div>
      <?php echo $address ." ".$city." ".$zip." ".$country?>
    </div> 
    <!-- <span class="badge  rounded-pill"><a href="changeAddress.php?user_id=<?php echo $id?>">Change Address</a></span> -->
    <span class="badge  rounded-pill">
      <button type="button" class="btn btn-primary"   style='--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .85rem;'  data-bs-toggle="modal" data-bs-target="#exampleModal1">
      Change Address
      </button>
    </span>
  </li>

  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class=" fs-5">Mobile Phone</div>
      <?php echo $mobile?>
    </div> 
    <!-- <span class="badge  rounded-pill"><a href="changeMobile.php?user_id=<?php echo $id?>">Change Mobile Number</a></span> -->
    <span class="badge rounded-pill">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" style='--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .85rem;' data-bs-target="#exampleModal2">
      Change Mobile Number
      </button>
    </span>
  </li>

  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class=" fs-5">My Email</div>
      <?php echo $email?>
    </div>
    <!-- <span class="badge  rounded-pill"><a href="changeEmail.php?user_id=<?php echo $id?>">Change Email Address</a></span>  -->
    <span class="badge  rounded-pill">
      <button type="button" class="btn btn-primary " style='--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .85rem;' data-bs-toggle="modal" data-bs-target="#exampleModal3">
      Change Email Address
      </button>
    </span>
  </li>

</ol>

    </div>
   
    <div class="col-sm-4">
    <ol class="list-group my-5">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class=" fs-5">Meet My SuperVisor</div>
 
     <div class=" fs-6">Date:<?php echo (isset($date ))?( $date) : ( " --"); ?></div>
   
     <div class=" fs-6">Time:<?php echo (isset($time ))?( $time)." <button type='button' style='--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;' 
     class='btn btn-link' data-bs-toggle='modal' data-bs-target='#staticBackdrop1'>Delete</button>" : ( " --"); ?>
     </div>
      
    </div>
 
    <!-- <span class="badge  rounded-pill"><a href="">Cancel Meeting</a></span> -->
    <span class="badge  rounded-pill">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal"  style='--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .85rem;'  data-bs-target="#exampleModal4">
      My Meeting 
    </span>
    
    
  </li>
  

  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class=" fs-5">My Vacations</div>
<?php 
// Attempt select query execution (myData-user vacations)
$id=$_SESSION['id'];
try{

  $sql = "SELECT * FROM vacations WHERE user_id = $id ";  
  $result = $pdo->query($sql);
  if($result->rowCount() > 0){
     
      while($row = $result->fetch()){
       $vacation_id = $row['id'] ;
       $from = $row['from_date'] ;
       $until = $row['until_date']; ?>
       <div class=" fs-6" >from: <?php echo $from?></div>
       <div class=" fs-6">until: <?php echo $until ?>
      <a href="delete_vacation.php?vacation_id=<?php echo $vacation_id?>"> Delete</a>
      </div>     
  <?php
       }
     
    
      // Free result set
      unset($result);
  } 
  else{
       echo $empty = "empty"; 
  }
} catch(PDOException $e){
  die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

   // Close connection
   unset($pdo);

?>

<!-- <?php echo $vacation_id?>   -->
    
    </div>
    <!-- <span class="badge rounded-pill"><a href="">Change Dates</a></span> -->
    <span class="badge  rounded-pill">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal"  style='--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .85rem;'  data-bs-target="#exampleModal5">
      My Vacations
      </button>
    </span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class=" fs-5">Αvailable Vacation Days</div>

    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
</ol>
    </div>
    
  </div>
  
</div>

</div>
<!-- ---------------end---center----------------------- -->


  <!-- -------------------modal 6 to check delete meeting---------------------------------- -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Do you want to delete your Meeting Date?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="" method="post">
        <button type="submit" name="submit6" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

  <!-- -----------------end--modal 6 to check delete meeting---------------------------------- -->

    <!-- -------------------modal 7 to check delete Vacations---------------------------------- -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Do you want to delete your Vactions Date?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="" method="post">
        <button type="submit" name="submit7" class="btn btn-danger">Delete</button>
      </form>
      </div>
    </div>
  </div>
</div>

  <!-- -----------------end--modal 7 to check delete Vacations---------------------------------- -->


                                   <!-- Modals -->

<!-- Modal  1.Change Address-->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Change your Address</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- ---------------------------------------- -->
            <div class="row g-3">
            <div class="col-sm-12">
            <label for="inputEmail4" class="form-label">Current Address</label>
              <input type="text" class="form-control" placeholder="<?php echo $address ." ".$city." ".$zip." ".$country?>" aria-label="City" disabled>
            </div>

            
      <form action="" method="post">
        
            <div class="modal-header">
            <label for="inputEmail4" class="form-label">New Address</label>
           </div>
           <div class="col-12">
              <label for="inputAddress" class="form-label">Address</label>
              <input type="text" name="address" class="form-control <?php echo (!empty($confirm_address_err)) ? 'is-invalid' : ''; ?>"  id="inputAddress" placeholder="">
              <span class="invalid-feedback"><?php echo $confirm_address_err; ?></span> 
          </div>

          <div class="col-md-6">
            <label for="inputCity" class="form-label">City</label>
            <input type="text" name="city"  class="form-control<?php echo (!empty($confirm_city_err)) ? 'is-invalid' : ''; ?>" value="" id="inputCity">
            <span class="invalid-feedback"><?php echo $confirm_city_err; ?></span>
          </div>

          <div class="col-md-6">
            <label for="inputState" class="form-label">Country</label>
            <select id="inputState" name="country"  class="form-select <?php echo (!empty($confirm_country_err)) ? 'is-invalid' : ''; ?>" value="">
            <span class="invalid-feedback"><?php echo $confirm_country_err; ?></span>
              <option selected>Choose...</option>
              <option>Austria</option>
              <option>Deutchland</option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="inputZip" class="form-label">Zip</label>
            <input type="text" name="zip"  class="form-control <?php echo (!empty($confirm_zip)) ? 'is-invalid' : ''; ?>" value="" id="inputZip">
            <span class="invalid-feedback"><?php echo $confirm_zip_err; ?></span>
          </div>


          </div>
           <!-- ---------------------------------------- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit1" class="btn btn-primary">Save changes</button>
      </div>
 </form>

    </div>
  </div>
</div>

<!-- end Modal  1.Change Address-->


<!-- Modal  2.Change Mobile Number-->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Mobile Number</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
              <!-- ---------------------------------------- -->
              <div class="row g-3">
            <div class="col-sm-6">
            <label for="inputEmail4" class="form-label">Current Mobile Number</label>
              <input type="text" class="form-control" placeholder="<?php echo $mobile?>" aria-label="City" disabled>
            </div>

            <form action="" method="post">
            <div class="col-md-6">
              <label for="inputCity" class="form-label">New Mobile Number</label>
              <input type="text" name="mobile"  class="form-control<?php echo (!empty($confirm_mobile_err)) ? 'is-invalid' : ''; ?>" value="" id="inputCity">
              <span class="invalid-feedback"><?php echo $confirm_mobile_err; ?></span>
            </div>

          </div>
           <!-- ---------------------------------------- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit2"  class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
   
<!-- end Modal  2.Change Mobile Number-->

<!-- Modal  3.Change Email Address-->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Email Address</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
               <!-- ---------------------------------------- -->
               <div class="row g-3">
            <div class="col-sm-12">
            <label for="inputEmail4" class="form-label">Current Email Address</label>
              <input type="text" class="form-control" placeholder="<?php echo $email?>" aria-label="City" disabled>
            </div>
       
            <form action="" method="post">
            <div class="col-md-12">
              <label for="inputCity" class="form-label">New Email Address</label>
              <input type="Email" name="email"  class="form-control<?php echo (!empty($confirm_email_err)) ? 'is-invalid' : ''; ?>" value="" id="inputCity">
              <span class="invalid-feedback"><?php echo $confirm_email_err; ?></span>
            </div>

          </div>
           <!-- ---------------------------------------- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  name="submit3"  class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
   
<!-- end Modal  3.Change Email Address-->

<!-- Modal  4. Meeting-->
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">My Meeting</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
             <!-- ---------------------------------------- -->
             <div class="row g-3">

            <div class="col-sm-6">
            <label for="inputEmail4" class="form-label">Wish Date</label>
            <form action="" method="POST">         
            <input type="date" class="form-control<?php echo (!empty($confirm_date_err)) ? 'is-invalid' : ''; ?>" name="date" required>
            <span class="invalid-feedback"><?php echo $date_err; ?></span>
            <input type="time" class="form-control my-3 <?php echo (!empty($confirm_time_err)) ? 'is-invalid' : ''; ?>"  name="time" required>
            <span class="invalid-feedback"><?php echo $time_err; ?></span>
            <button type="submit" name="submit4" class="btn btn-primary">Save changes</button>
          </form>
            </div>
          </div>
           <!-- ---------------------------------------- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
   
<!-- end Modal  4.  Meeting-->


<!-- Modal  5.Vacation Dates-->
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">My Vacations</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   
      </div>
      <div class="modal-body">
        <!-- ---------------------------------------- -->
        <div class="row g-3">
            <div class="col-sm-12">
            <label for="inputEmail4" class="form-label"></label>
                <form action="" method="POST">
                  <label for="birthday">From:</label>
                  <input type="date" id="vocation" name="from" class="form-control my-3 <?php echo (!empty($confirm_from_err)) ? 'is-invalid' : ''; ?>" required> 
                  <span class="invalid-feedback"><?php echo $from_err; ?></span>
                  <label for="birthday">Until:</label>
                  <input type="date" id="vacations" name="until" class="form-control my-3 <?php echo (!empty($confirm_until_err)) ? 'is-invalid' : ''; ?>"required >                 
                  <span class="invalid-feedback"><?php echo $until_err; ?></span>
      

            </div>   
          </div>
           <!-- ---------------------------------------- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit5"  class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
   
<!-- end Modal  5.Change Dates-->


                                  <!-- end Modals -->

                                  

    <footer class="footer">
  <h6 class="text-center  fs-6 bg-dark text-light">D.Vortelinas Copyright<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-c-circle" viewBox="0 0 16 16">
  <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.146 4.992c-1.212 0-1.927.92-1.927 2.502v1.06c0 1.571.703 2.462 1.927 2.462.979 0 1.641-.586 1.729-1.418h1.295v.093c-.1 1.448-1.354 2.467-3.03 2.467-2.091 0-3.269-1.336-3.269-3.603V7.482c0-2.261 1.201-3.638 3.27-3.638 1.681 0 2.935 1.054 3.029 2.572v.088H9.875c-.088-.879-.768-1.512-1.729-1.512"/>
</svg> <?php echo date("Y");?></h6>
</footer>
<script src="myscripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>