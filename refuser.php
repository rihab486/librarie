<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
if (isset($_SESSION['nomAd']) AND isset($_SESSION['adresseAd']) AND isset($_SESSION['idAd']) ) {
if(isset($_GET['id'])  ){
$_SESSION['id1']=$_GET['id'];
}
    

     
        try {
                $dbco = new PDO("mysql:host=$servername", $username,$password);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

    $sql = "CREATE DATABASE IF NOT EXISTS clientLab";
                $dbco->exec($sql);
                $conn = new PDO("mysql:host=localhost;dbname=clientLab", 'root', '');
        
                
        
               
        
      } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
        }
 
try {
       $conn = new PDO("mysql:host=localhost;dbname=clientLab", 'root', '');
        $sql = "create TABLE IF NOT EXISTS messageClient(
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                adresse VARCHAR(70),
                message VARCHAR(70));
                ";

        $conn->exec($sql);
        } catch (PDOException $e) {
        exit("Erreur:" . $e->getMessage());
        }



$reqmail = $conn->prepare("SELECT * FROM deposerDocumentAvant WHERE id =? ");//toujours premiérerement il faut préparer la requét
                   $reqmail->execute(array($_SESSION['id']));
                   $mailexist = $reqmail->rowCount();//compter les colonnes trouvé
                   if($mailexist == 1) {
                   $userinfo = $reqmail->fetch();
                   $adresse = $userinfo['adresse'];?> 

 <?php  
        
     if (!empty($_POST['message']) AND isset($_POST['message']) )  {
     $message=$_POST['message'] ; 
     echo $message;
       

 $req1 = "INSERT into messageClient(`adresse`,`message`)
VALUES (:aadresse,:amessage)";
$stmt = $conn->prepare($req1);
$stmt->bindParam(':aadresse', $adresse, PDO::PARAM_STR);
$stmt->bindParam(':amessage', $message, PDO::PARAM_STR);

$stmt->execute();
header("Location: controlerDocument.php");



}}
 ?>
 <?php }
 else{ header("Location: acceAdministrateur.php");} ?>

