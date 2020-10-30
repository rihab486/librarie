<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
if (isset($_SESSION['nom']) AND isset($_SESSION['prenom']) AND isset($_SESSION['adresse']) AND isset($_SESSION['id']) ) {
$_SESSION['titre']=$_GET['titre'];
$_SESSION['genre']=$_GET['genre'];
$_SESSION['namefichier']=$_GET['namefichier'];
$_SESSION['file']=$_GET['file'];
$titre=$_SESSION['titre'];
$genre=$_SESSION['genre'];
$namefichier=$_SESSION['namefichier'];
$file_url=$_SESSION['file'];
    if (isset($_SESSION['titre']) AND isset($_SESSION['genre']) AND isset($_SESSION['namefichier']) AND isset($_SESSION['file']) ) {

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
 try {
        $conn = new PDO("mysql:host=localhost;dbname=clientLab", 'root', '');
        $sql = "create TABLE IF NOT EXISTS fichierTelecharge(
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                adresse VARCHAR(70),
                titre VARCHAR(70),
                genre VARCHAR(70),
                namefichier VARCHAR(70))
                ";

        $conn->exec($sql);
        } catch (PDOException $e) {
        exit("Erreur:" . $e->getMessage());
        }


$reqmail = $conn->prepare("SELECT * FROM fichierTelecharge WHERE adresse =? AND titre=? AND genre=? AND namefichier=?  ");//toujours premiérerement il faut préparer la requét
                   $reqmail->execute(array($_SESSION['adresse'],$titre,$genre,$namefichier));
                   $mailexist = $reqmail->rowCount();//compter les colonnes trouvé
                   if($mailexist == 0) {

$req = "INSERT into fichierTelecharge(`adresse`,`titre` ,`genre` , `namefichier`)
VALUES (:aadresse,:atitre,:agenre,:anamefichier)";
$stmt = $conn->prepare($req);
$stmt->bindParam(':aadresse', $_SESSION['adresse'], PDO::PARAM_STR);
$stmt->bindParam(':atitre', $titre, PDO::PARAM_STR);
$stmt->bindParam(':agenre', $genre, PDO::PARAM_STR);

$stmt->bindParam(':anamefichier', $namefichier, PDO::PARAM_STR);


$stmt->execute();}
echo '<a href="'.$_SESSION['file'].'">télécharger</a><br>';



?>
<?php
    }  
 else{ header("Location: acceClient.php");}
  }  
 else{ header("Location: acceClient.php");} ?>
