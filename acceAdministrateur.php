<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
// Connexion à la base de données
        try {
                $dbco = new PDO("mysql:host=$servername", "root", "");
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
         
                $conn = new PDO("mysql:host=localhost;dbname=clientLab", 'root', '');
        
                
        
                // // creation de votre tableau 
        
        } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
        }


         try {
        $conn = new PDO("mysql:host=localhost;dbname=clientLab", 'root', '');
        $sql = "create TABLE IF NOT EXISTS connexionAd(
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                nom VARCHAR(70),
                adresse VARCHAR(70),
                password VARCHAR(70));
                ";

                $nom="ghoffrane";
                $adresse="ghoffrane@gmail.com";
                $motdepasse="ghoffrane";
        $conn->exec($sql);
        } catch (PDOException $e) {
        exit("Erreur:" . $e->getMessage());
        } 
        $requser = $conn ->prepare("SELECT * FROM connexionAd ");
$requser->execute(array());
$userexist = $requser->rowCount();
if($userexist == 0) {
         $req = "INSERT into connexionAd(`nom`,`adresse` ,`password` )
           VALUES (:anom,:aadresse,:apassword)";
         $stmt = $conn->prepare($req);

         $stmt->bindParam(':anom', $nom , PDO::PARAM_STR);//bindParam — Lie un paramètre à un nom de variable spécifique avant d'exécuté la requête.
         
         $stmt->bindParam(':aadresse', $adresse, PDO::PARAM_STR);
         $stmt->bindParam(':apassword', $motdepasse, PDO::PARAM_STR);
       
         
         $stmt->execute();
                   
        } 
        
if(empty($_POST['login']) AND empty ($_POST['motdepasse'])) {
  }
elseif(!empty($_POST['login']) AND !empty ($_POST['motdepasse'])) {

$mailconnect=$_POST['login'];
$mdpconnect =$_POST['motdepasse'];
$requser = $conn ->prepare("SELECT * FROM connexionAd WHERE adresse = ? AND password = ?");
$requser->execute(array($mailconnect, $mdpconnect));
$userexist = $requser->rowCount();
if($userexist == 1) { //càd les infos entéées sont existés une seule fois bien sur 
$userinfo = $requser->fetch();
$_SESSION['nomAd'] = $userinfo['nom'];

$_SESSION['adresseAd'] = $userinfo['adresse'];
$_SESSION['idAd'] = $userinfo['id'];
header("Location: compteAd.php"); // si les conditions sont existées alors allez sur la pages profil.php tq nous étions parvenus à passer des variables de page en page via la méthode  GET  (en modifiant l'URL :  profil.php?variable=valeur ) donc en modifiant la valeur de variable
} else {
$erreur = "Mauvais mail ou mot de passe !";
}
} else {
$erreur = "Tous les champs doivent être complétés !";
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="">
    <!-- Bootstrap CSS -->
    

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>acceAdministrateur</title>
    <link rel="stylesheet" href="accesAdministrateurcss.css">
</head>
<body  >
<br>
  <h1 class="display-4" style=" text-align: center; margin: auto; color: #77ABD6;">librairie.tn</h1>
  <br>
  <br>
  
     
<div class="col-6" >

       
        
<p class="text-center" ><b>Vous avez deja un compte </b></p>
 </div>

<div class="x">
              <form method="POST" class="adminis" action="acceAdministrateur.php"><br/>
               
              <div class="form-group">
                 <label for="exampleInputEmail1" style="font-size: 0.8em; font-weight: 500;">Adresse e-mail</label>   
                 <input  type="email" name="login" class="form-control"   id="exampleInputEmail1" placeholder="login" aria-describedby="emailHelp"/>
               </div>

               <div class="form-group">
                 <label for="exampleInputPassword1" style="font-size: 0.8em;font-weight: 500;">Mot de passe</label>
                 <input  type= "password" name="motdepasse"  class="form-control" id="exampleInputPassword1" placeholder="password"/>
               </div>
               <br>
               <button type="submit" class="btn btn-primary btn-lg btn-block" ><span style="font-weight: bold; font-size: 0.8em;">se connecter</span></button> 
               <br>
               <br>
              </form>
            </div>
        <?php
if(isset($erreur)) {
echo '<font style="color:red ;font-weight: 500;font-size: 0.78em;">'.$erreur."</font>";
echo("<br>");
}?>
              

  



 
<br>
<br>




</body>
</html>



              

