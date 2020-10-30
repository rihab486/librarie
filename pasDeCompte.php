<?php

$servername = "localhost";
$username = "root";
$password = "";
    

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
        $sql = "create TABLE IF NOT EXISTS connexion(
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                nom VARCHAR(70),
                prenom VARCHAR(70),
                adresse VARCHAR(70),
                password VARCHAR(70),
                sexe VARCHAR(70),
                date_de_naissance VARCHAR(70));
                ";
        $conn->exec($sql);
        } catch (PDOException $e) {
        exit("Erreur:" . $e->getMessage());
        } 
if (empty($_POST['nom']) AND empty($_POST['prenom']) AND empty($_POST['adresse']) AND empty($_POST['password']) AND empty($_POST['sexe'])) {

  }
    
elseif (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['adresse']) AND !empty($_POST['password']) AND !empty($_POST['sexe'])) {

  

            $reqmail = $conn->prepare("SELECT * FROM connexion WHERE adresse = ?");//toujours premiérerement il faut préparer la requét
                   $reqmail->execute(array($_POST['adresse']));
                   $mailexist = $reqmail->rowCount();//compter les colonnes trouvé
                   if($mailexist == 0) {//càd si le email choisisé est unique

       

     $req = "INSERT into connexion(`nom`,`prenom` ,`adresse` ,`password` , `sexe`, `date_de_naissance`)
      VALUES (:anom,:aprenom,:aadresse,:apassword,:asexe,:adate_de_naissance)";
         $stmt = $conn->prepare($req);

         $stmt->bindParam(':anom', $_POST['nom'] , PDO::PARAM_STR);//bindParam — Lie un paramètre à un nom de variable spécifique avant d'exécuté la requête.
         $stmt->bindParam(':aprenom', $_POST['prenom'], PDO::PARAM_STR);
         $stmt->bindParam(':aadresse', $_POST['adresse'], PDO::PARAM_STR);
         $stmt->bindParam(':apassword', $_POST['password'], PDO::PARAM_STR);
         $stmt->bindParam(':asexe', $_POST['sexe'], PDO::PARAM_STR);
         $stmt->bindParam(':adate_de_naissance', $_POST['date_de_naissance'], PDO::PARAM_STR);
         $stmt->execute();
                   
        } 
         
                   else{
                  $err = "Adresse mail déjà utilisée !";
               }
               
        
      
         }else {
      $err = "Tous les champs doivent être complétés !";
              }
              ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>pas d compte</title>
    <link rel="stylesheet" href="test.css">
    

        
</head>
<body >

  <br>
  <h1 class="display-4" style=" text-align: center; margin: auto; color: #77ABD6;">librairie.tn</h1>
  <br>
  <br>


<div class="col-6" >

       
        
           <p class="text-center" ><b>Je n'ai pas de compte</b></p>
            </div>
      

          <div class="xxx">
           <form method="POST" class="compte" action="pasDeCompte.php"><br/>
            
               
               <div class="form-group"><input  type= "text" name="nom"  class="form-control"  id="nom" placeholder="Nom"/></div>
               <div class="form-group"><input  type= "text" name ="prenom" class="form-control" id="prenom" placeholder="Prenom" /></div>
               <div class="form-group"><input  type= "email" name="adresse" class="form-control" id="adresse" placeholder="adresse_email ou mobile"/></div>
               <div class="form-group"><input type= "password" name="password" class="form-control" id="password" placeholder="password"/></div>
               <div class="form-group"><select name="sexe" id="sexe" class="form-control" >sexe
                 <option value="Masculin">Masculin</option>
                 <option value="Feminin">Feminin</option>
               </select></div>
               <div class="form-group"> <input type="date" name ="date_de_naissance" class="form-control" id="date_de_naissance"></div>
            

  <?php
if(isset($err)) {
echo '<font style="color:red ;font-weight: 500;font-size: 0.78em;">'.$err."</font><br>";

}?>               
               
                 <br>
               <button type="submit"  class="btn btn-primary btn-lg btn-block" >
                 <span style="font-weight: bold; font-size: 0.8em;">Créer un compte </span></button> 
               <br>
               <br>
               </from>  </div>
             
           
         </div>
       </div>
    </div>
