<?php
// Initialize the session
session_start();

 // Include config file
require_once "login_system/config.php";

$vacation_id = $_GET['vacation_id'];

if (isset($_GET['vacation_id']))
{ 
   // Attempt update query execution
   try{
     $sql = "DELETE FROM vacations WHERE  id ='$vacation_id'";  
     $pdo->exec($sql);
     // echo "Records were deleted successfully.";
   } catch(PDOException $e){
     die("ERROR: Could not able to execute $sql. " . $e->getMessage());
   }
   header('Location: myData.php');
   die();
  

 }

//End delete Vacations
// ----------------------------
?>