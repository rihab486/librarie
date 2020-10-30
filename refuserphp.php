<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
if (isset($_SESSION['nomAd']) AND isset($_SESSION['adresseAd']) AND isset($_SESSION['idAd']) ) {
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
   
    

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="refuserphpcss.css">
</head>
<body  >
  <form method="POST" action="refuserphp.php">
         <p  style="display: flex; text-align:; justify-content:; color: white;font-size: 0.9em;font-weight: 500; margin: 10px; color: #3a6289">
  écrivez votre message ici:</p>
       
       <textarea name="message" id="ameliorer" class="form-control" rows="10" cols="50"></textarea>    
   
<?php
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
                   $reqmail->execute(array($_SESSION['id1']));
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


          
  
   

   <?php echo "<button type='submit' name='formconnexion' class='btn btn-primary' onclick='return confirm(\"voulez vous confirmer ces informations? \");' ><span style='font-weight: bold; font-size: 0.8em;'> Envoyer </span></button>" ; ?> 

</form>

<img src="compte.jpg" alt="logo" width="100%" height="40%" >
<h6> LIBRAIRIE.TN</h6>
</body>
</html>


          
   