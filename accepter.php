<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$_SESSION['idClient']=$_GET['id'];
if (isset($_SESSION['nomAd']) AND isset($_SESSION['adresseAd']) AND isset($_SESSION['idAd']) ) {
    

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
        $sql = "create TABLE IF NOT EXISTS deposerDocument(
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                adresse VARCHAR(70),
                titre VARCHAR(70),
                genre VARCHAR(70),
                nombre_page VARCHAR(70),
                namefichier VARCHAR(70),
                file_url VARCHAR(70),
                resume VARCHAR(70));
                ";

        $conn->exec($sql);
        } catch (PDOException $e) {
        exit("Erreur:" . $e->getMessage());
        }



$reqmail = $conn->prepare("SELECT * FROM deposerDocumentAvant WHERE id =? ");//toujours premiérerement il faut préparer la requét
                   $reqmail->execute(array($_SESSION['idClient']));
                   $mailexist = $reqmail->rowCount();//compter les colonnes trouvé
                   if($mailexist == 1) {
                   $userinfo = $reqmail->fetch();
                   $adresse = $userinfo['adresse'];
                    $titre = $userinfo['titre'];
                     $genre = $userinfo['genre'];
                      $nombre_page = $userinfo['nombre_page'];
                       $namefichier = $userinfo['namefichier'];
                       $file_url = $userinfo['file_url'];
                       $resume = $userinfo['resume'];

$req = "INSERT into deposerDocument(`adresse`,`titre` ,`genre` ,`nombre_page` , `namefichier`, `file_url`,`resume`)
VALUES (:aadresse,:atitre,:agenre,:anombre_page,:anamefichier,:afile_url,:aresume)";
$stmt = $conn->prepare($req);
$stmt->bindParam(':aadresse', $adresse, PDO::PARAM_STR);
$stmt->bindParam(':atitre', $titre, PDO::PARAM_STR);
$stmt->bindParam(':agenre', $genre, PDO::PARAM_STR);
$stmt->bindParam(':anombre_page', $nombre_page, PDO::PARAM_STR);
$stmt->bindParam(':anamefichier', $namefichier, PDO::PARAM_STR);
$stmt->bindParam(':afile_url', $file_url, PDO::PARAM_STR);
$stmt->bindParam(':aresume', $resume, PDO::PARAM_STR);
$stmt->execute();

try {
       $message="votre document de titre ".$titre." est déposé avec succès";
        $sql1 = "create TABLE IF NOT EXISTS messageClient(
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                adresse VARCHAR(70),
                message VARCHAR(70));
                ";

        $conn->exec($sql1);
        } catch (PDOException $e) {
        exit("Erreur:" . $e->getMessage());
        }
 $req1 = "INSERT into messageClient(`adresse`,`message`)
VALUES (:aadresse,:amessage)";
$stmt = $conn->prepare($req1);
$stmt->bindParam(':aadresse', $adresse, PDO::PARAM_STR);
$stmt->bindParam(':amessage', $message, PDO::PARAM_STR);

$stmt->execute();
header("Location: controlerDocument.php");




}


}
 else{ header("Location: acceAdministrateur.php");} ?>





?>