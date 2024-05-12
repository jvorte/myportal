<?php
// Initialize the session
session_start();

 // Include config file
require_once "login_system/config.php";

$doc_id = $_GET['doc_id'];
$doc_name = $_GET['name'];

if (isset($_GET['doc_id']) & isset($_GET['name']))
{ 

   // Attempt update query execution
   try{
    $sql = "DELETE FROM documents WHERE  file_id ='$doc_id'";  
    $pdo->exec($sql);
    // echo "Records were deleted successfully.";
  } catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
  }
// PHP program to delete a file named gfg.txt 
// using unlink() function 
  
$file_pointer = "upload_doc/$doc_name"; 
  
// Use unlink() function to delete a file 
if (!unlink($file_pointer)) { 
    echo ("$file_pointer cannot be deleted due to an error"); 
} 
else { 
    echo ("$file_pointer has been deleted"); 
} 
 
header('Location: myDocuments.php');
die();

}
?> 