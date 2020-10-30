<?php
session_start();

  
$servername = "localhost";
$username = "root";
$password = "";
    
if (isset($_SESSION['nomAd']) AND isset($_SESSION['adresseAd']) AND isset($_SESSION['idAd']) ) {
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
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="documentcss.css">

    <title>controler docu</title>
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
$query = "SELECT * FROM deposerDocumentAvant ORDER BY id ASC;";
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
            <th style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><strong> nombre de page</strong></th>
            <th style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><strong> nom fichier</strong></th>
            <th style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><strong> resume </strong></th>
            <th style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><strong> télécharger </strong></th>          
             <th style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><center><strong>Action</strong></center></th>
    <tbody>
<?php
    // pour chaque ligne (chaque enregistrement)
    foreach ( $rowAll as $row ) 
    {
        $id=$row['id'];
        $file=$row['file_url'];


        // DONNÉES À AFFICHER dans chaque cellule de la ligne
?>
        <tr>
            <td style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><?php echo $row['id']; ?></td>
            <td style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><?php echo $row['titre']; ?></td>
            <td style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><?php echo $row['genre']; ?></td>
            <td style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><?php echo $row['nombre_page']; ?></td>
            <td style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><?php echo $row['namefichier']; ?></td>
            <td style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><?php echo $row['resume']; ?></td>
            <td style="color: white; font-size: 0.9em;font-weight: 500;color: black;text-align: center"><?php echo "<a style='font-weight: bold; font-size: 0.8em;color: black;height: 38px;padding: 9px ;'  href='".$row['file_url']."'   class='btn btn-primary'>telecharger</a> "; ?></td>
           
            <td>
                    <center>
                     

                         <?php echo "<a style='font-weight: bold; font-size: 0.8em;color: black;height: 38px;padding: 9px ;' class='btn btn-primary' href='accepter.php?id=$id '  onclick='return confirm(\"voulez vous accepter cette demande? \");' >accepter </a> "  ; ?>

                         <?php  echo "<a style='font-weight: bold; font-size: 0.8em;color: black;height: 38px;padding: 9px ;'  href='refuserphp.php?id=$id'   class='btn btn-primary'>refuser</a> "  ;?>

        

                       
                    </center>
                </td>
        </tr></table>
     </from>
        
       
<?php
    }  }  }
 else{ header("Location: acceAdministrateur.php");} ?>

    
