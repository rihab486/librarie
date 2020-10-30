

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
        
if(empty($_POST['login']) AND empty ($_POST['motdepasse'])) {
  }
elseif(!empty($_POST['login']) AND !empty ($_POST['motdepasse'])) {

$mailconnect=$_POST['login'];
$mdpconnect =$_POST['motdepasse'];
$requser = $conn ->prepare("SELECT * FROM connexion WHERE adresse = ? AND password = ?");
$requser->execute(array($mailconnect, $mdpconnect));
$userexist = $requser->rowCount();
if($userexist == 1) { //càd les infos entéées sont existés une seule fois bien sur 
$userinfo = $requser->fetch();
$_SESSION['nom'] = $userinfo['nom'];
$_SESSION['prenom'] = $userinfo['prenom'];
$_SESSION['adresse'] = $userinfo['adresse'];
$_SESSION['id'] = $userinfo['id'];
header("Location: compteClient.php"); // si les conditions sont existées alors allez sur la pages profil.php tq nous étions parvenus à passer des variables de page en page via la méthode  GET  (en modifiant l'URL :  profil.php?variable=valeur ) donc en modifiant la valeur de variable
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
    <link rel="stylesheet" href="test1.css">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acces client</title>
</head>
<body  >
  <br>
  <h1 class="display-4" style=" text-align: center; margin: auto; color: #77ABD6;">librairie.tn</h1>
  <br>
  <br>
  <div id="G">
  
  <div class="con1" >     
        <br>
           <p class="text-center"><b>Vous avez déjà un compte ?</b></p>
            
             <form action="acceClient.php" class="compte1" method="POST" >
               <div class="form-group">
                 
                 <label for="exampleInputEmail1" style="font-size: 0.8em; font-weight: 500;"><b>Adresse e-mail<b></label>   
                 <input  type="email" name="login" class="form-control"   id="exampleInputEmail1" placeholder="login" aria-describedby="emailHelp"/>
               </div>
               <div class="form-group">
                 <label for="exampleInputPassword1" style="font-size: 0.8em;font-weight: 500;"><b>Mot de passe<b></label>
                 <input  type= "password" name="motdepasse"  class="form-control" id="exampleInputPassword1" placeholder="password"/>
               </div>
        <?php
if(isset($erreur)) {
echo '<font style="color:red ;font-weight: 500;font-size: 0.78em;">'.$erreur."</font>";
echo("<br>");
}?>
              <br>
               <button type="submit" class="btn btn-primary btn-lg btn-block" ><span style="font-weight: bold; font-size: 0.8em;">se connecter</span></button> 
               <br>
               <br>
              </form>
            </div>

   <div id="con2" >      
   <br><br>  
   <div class="aa"> 
  <h3 style=" margin: auto;"><b> Vous êtes un nouveau client ?</b><br>
                                               <b> En créant un compte sur notre boutique, vous pourrez</b> <br>
                                               <b> passer vos commandes plus rapidement, enregistrer</b> <br>
                                               <b> plusieurs adresses de livraison, consulter et suivre vos</b> <br>
                                               <b> commandes, et plein d'autres choses encore.</b><br><br>
 <button type="button"   ><a href="pasDeCompte.php" >créer un compte </a>  </button></h3></div>

 </div>
 </div> 



 
<br>
<br>




</body>
</html>



              

