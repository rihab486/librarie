<?php
session_start();

  
$servername = "localhost";
$username = "root";
$password = "";
    if (isset($_SESSION['nom']) AND isset($_SESSION['prenom']) AND isset($_SESSION['adresse']) AND isset($_SESSION['id']) ) {


        try {
                $dbco = new PDO("mysql:host=$servername", $username,$password);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

                $conn = new PDO("mysql:host=localhost;dbname=clientLab", 'root', '');
        
 
                
        
                // // creation de votre tableau 
        
      } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="documentcss.css">
  
    <title>cherher document</title>
</head>

<body>
<nav>
<form action="test1.php"class="nav" method="POST" >
<div id="nav ">
        <a href="#" id="a">accueil</a>
        <a href="presentation.html"id="a">présentation</a>
        <a id="a">mon compte</a>
        <a href="profilClient.php" id="a">mon profil</a> 
        <a href="deconnClient.php" id="a">se déconnecter</a>
      </div>
      <form></br></br></nav></br>
      <div id="se">
      <input type="search" name="q" placeholder="Recherchez un titre">
      <input type="submit" value="OK"></div></br>
<?php
                $requser = $conn->prepare("SELECT * FROM messageClient WHERE adresse= ?  ORDER BY id DESC LIMIT 1 ;");
                $requser->execute(array($_SESSION['adresse']));
                $userinfo = $requser->fetch();
                if (isset($userinfo['message'])) {
                	
                
                $message = $userinfo['message'];
                
?>
<p style="display: flex; text-align:; justify-content:; color: white;font-size: 0.9em;font-weight: 500; margin: 10px; color: black;">
   <?php echo $message; }
   else {
    	echo "pas de contenu à afficher";
    }?></p><img src="compte.jpg" alt="logo" width="100%" height="40%" >
    <h6> LIBRAIRIE.TN</h6>
    <?php
    }  
 else{ header("Location: acceClient.php");} ?>

    <br> 

