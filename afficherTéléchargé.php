<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
   if (isset($_SESSION['nom']) AND isset($_SESSION['prenom']) AND isset($_SESSION['adresse']) AND isset($_SESSION['id']) ) {
 

        try {
                $dbco = new PDO("mysql:host=$servername", $username,$password);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

    $sql = "CREATE DATABASE IF NOT EXISTS clientLab";
                $dbco->exec($sql);
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
// --------------------------------
// La requête (exemple) : tous les "objets", classés par "id".
$query = "SELECT * FROM fichierTelecharge ORDER BY id ASC;";
  try {
    $pdo_select = $conn->prepare($query);
    $pdo_select->execute();
    $NbreData = $pdo_select->rowCount();    // nombre d'enregistrements (lignes)
    $rowAll = $pdo_select->fetchAll();
  } catch (PDOException $e){ echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
// --------------------------------
// affichage
if ($NbreData != 0) 
{
?>
    <table border="1px" style="border-spacing: 10px;"   >
    <thead>
        <tr >
            <th style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><strong>id</strong></th>
            <th style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><strong> titre  </strong></th>
            <th style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><strong> type</strong></th>
            <th style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><strong> nom fichier</strong></th>
         
             
    <tbody>
<?php
    // pour chaque ligne (chaque enregistrement)
    foreach ( $rowAll as $row ) 
    {
        
?>
                     

            <td style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><?php echo $row['id']; ?></td>
            <td style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><?php echo $row['titre']; ?></td>
            <td style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><?php echo $row['genre']; ?></td>
            <td style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><?php echo $row['namefichier']; ?></td>
           
           
        </tr>





<?php }}  else { ?>
   <p  style="display: flex; text-align:; justify-content:; color: white; font-size: 0.9em;    font-weight: 500; margin: 10px; color: black">pas des données à afficher</p>
<?php
}
?></table>
<?php
    }  
 else{ header("Location: acceClient.php");} ?>
<img src="compte.jpg" alt="logo" width="100%" height="40%" >
<h6> LIBRAIRIE.TN</h6>
    </body>
    