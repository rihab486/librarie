<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";


  
        try {
                $dbco = new PDO("mysql:host=$servername", $username,$password);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conn = new PDO("mysql:host=localhost;dbname=clientLab", 'root', '');
         } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
        }

          if(empty($_POST['adresse']) AND empty ($_POST['password']) AND empty ($_POST['motdepasse']) ){ }
          elseif(!empty($_POST['adresse']) AND !empty ($_POST['password']) AND !empty ($_POST['motdepasse']) ){
          	# code...
          
                  	  if($_POST['password']==$_POST['motdepasse']) {
                  	  	if ($_POST['adresse']==$_SESSION['adresse']) {
                  	  		# code...
                        $newadresse=$_POST['adresse'];
                        
                        $newpassword=$_POST['password'];
                        $requser = $conn ->prepare("UPDATE connexion SET adresse = ? WHERE id = ?");
                        $requser->execute(array($newadresse,$_SESSION['id']));

                        $insertmp = $conn->prepare("UPDATE connexion SET password= ? WHERE id = ?"); //modifier la ligne de la base 
                       $insertmp->execute(array($newpassword, $_SESSION['id']));




                  header('Location: compteClient.php'); }

                  else{ $reqmail = $conn->prepare("SELECT * FROM connexion WHERE adresse = ?");//toujours premiérerement il faut préparer la requét
                   $reqmail->execute(array($_POST['adresse']));
                   $mailexist = $reqmail->rowCount();//compter les colonnes trouvé
                   if($mailexist == 0) {
                  	    $newadresse=$_POST['adresse'];
                        $id =$_SESSION['id'];
                        $newpassword=$_POST['password'];
                        $requser = $conn ->prepare("UPDATE connexion SET adresse = ? WHERE id = ?");
                        $requser->execute(array($newadresse,$id));

                        $insertmp = $conn->prepare("UPDATE connexion SET password= ? WHERE id = ?"); //modifier la ligne de la base 
                       $insertmp->execute(array($newpassword, $id));

                  header('Location: compteClient.php'); }
                  else{ $err = "Adresse mail déjà utilisée !";}


                   } }
                    else{
                  	$err = "confirmez   votre motdepasse  !";
                        } }
                        else{
                  	$err = "Tous les champs doivent être complétés  !";
                        }

             
 ?>













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="profilclientadd.css">
   

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil client</title>
</head>


<body>
<br>
  <h1 class="display-4" style=" text-align: center; margin: auto; color: #77ABD6;">librairie.tn</h1>
  <br>
  <br> 

  <form name="login" action="profilClient.php" method="POST">
          <div class="compte">
               
           <p class="text-center" style="color: white; font-weight: bold;">modifier mon mot de passe</p>
           
           <br>
          
               
                 
                 <label for="exampleInputEmail1" style="font-size: 0.8em; font-weight: 500;">nouveau adresse</label>   
                 <input  type="email" name="adresse"  placeholder="login" aria-describedby="emailHelp"/><br>
               
                 <label for="exampleInputPassword1" style="font-size: 0.8em;font-weight: 500;">nouveau mot de passe</label>
                 <input  type= "password" name="motdepasse"  placeholder="password"/><br>
              
                 <label for="exampleInputPassword1" style="font-size: 0.8em;font-weight: 500;">confirmer du nouveau Mot de passe</label>
                 <input  type= "password" name="password"   placeholder="password"/><br>
                 <br>
               <button type="submit"  ><span style="font-weight: bold; font-size: 0.8em;">confirmer</span></button> 
               <br>
               <br/></div>				        
</form>

        <?php
if(isset($err)) {
echo '<font style="color:red ;font-weight: 500;font-size: 0.78em;">'.$err."</font><br>";

}?>
               
            