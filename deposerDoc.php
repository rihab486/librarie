<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
if (isset($_SESSION['nom']) AND isset($_SESSION['prenom']) AND isset($_SESSION['adresse']) AND isset($_SESSION['id']) ) {

        try {
                $dbco = new PDO("mysql:host=$servername", $username, $password);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $sql = "CREATE DATABASE IF NOT EXISTS clientLab";
                $dbco->exec($sql);
                $conn = new PDO("mysql:host=localhost;dbname=clientLab", 'root', '');
        
                
        } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
        }

        try {
        $conn = new PDO("mysql:host=localhost;dbname=clientLab", 'root', '');
        $sql = "create TABLE IF NOT EXISTS deposerDocumentAvant(
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

if ( empty($_POST['titre']) AND empty($_POST['genre']) AND empty($_POST['number']) AND empty($_FILES['fichier']) AND empty($_POST['resume']) ) {  }

elseif (!empty($_POST['titre']) AND !empty($_POST['genre']) AND !empty($_POST['number']) AND !empty($_FILES['fichier']) AND !empty($_POST['resume'])  ) {
            $file_name=$_FILES['fichier']['name'];
            $file_extention= strrchr($file_name, ".");
            $file_tmp_name=$_FILES['fichier']['tmp_name'];
            $file_dest='files/'.$file_name;
            $extentions_autorisees = array('.pdf','.PDF' );
            
               
            $reqmail = $conn->prepare("SELECT * FROM deposerDocumentAvant WHERE adresse =? AND titre=? AND genre=? namefichier=? AND file_url=? AND resume=? ");//toujours premiérerement il faut préparer la requét
                   $reqmail->execute(array($_SESSION['adresse'],$_POST['titre'],$_POST['genre'],$file_name,$file_dest, $_POST['resume']));
                   $mailexist = $reqmail->rowCount();//compter les colonnes trouvé
                   if($mailexist == 0) {
                   if (in_array($file_extention, $extentions_autorisees)) {
                   if (move_uploaded_file($file_tmp_name, $file_dest)) {
        

// Insertion du message à l'aide d'une requête préparée
$req = "INSERT into deposerDocumentAvant(`adresse`,`titre` ,`genre` ,`nombre_page` , `namefichier`, `file_url`,`resume`)
VALUES (:aadresse,:atitre,:agenre,:anombre_page,:anamefichier,:afile_url,:aresume)";
$stmt = $conn->prepare($req);
$stmt->bindParam(':aadresse', $_SESSION['adresse'], PDO::PARAM_STR);
$stmt->bindParam(':atitre', $_POST['titre'], PDO::PARAM_STR);
$stmt->bindParam(':agenre', $_POST['genre'], PDO::PARAM_STR);
$stmt->bindParam(':anombre_page', $_POST['number'], PDO::PARAM_STR);
$stmt->bindParam(':anamefichier', $file_name, PDO::PARAM_STR);
$stmt->bindParam(':afile_url', $file_dest, PDO::PARAM_STR);
$stmt->bindParam(':aresume', $_POST['resume'], PDO::PARAM_STR);
$stmt->execute();

$err= "fichier envoyé avec succés";
            
        }else{
            $erreur= "une erreur lors de l'envoi";
        }
        
    }else{
        $erreur= "seuls les fichiers PDF svp";
    }
}



} else {
echo  "Tous les champs doivent être complétés !";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styl.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>



    
        <div class="title">déposez votre document</div>
         <form method="POST" action="deposerDoc.php" enctype="multipart/form-data">
              
              <div class="parent-div">
              <button class="btn-upload">Choisir le fichier</button>
              <input type="file" name="fichier" />
              </div><br><br>


        <input style="" type= "text" name="titre"   id="nom" placeholder="Titre de document"  /></div><br>
        
        <input  type= "text" name ="genre" class="form-control" id="prenom" placeholder="genre de document "  /><br>
       
        <input type="number" name ="number" id="number" placeholder="nombre de pages" ></br> 
       
         <textarea   name="resume" placeholder="votre résumé pour le contenu "> </textarea>
          

          
   
            
             <input type="submit" value="Envoyer"  />
             <input type="reset" value="remplir de nouveau"  />

         </form>

          
            
   
   
      <?php
if(isset($erreur)) {
echo '<center><font style="color:red ;font-weight: 500;font-size: 0.78em;">'.$erreur."</font></center><br>";
}
elseif(isset($err)){
 echo '<center><font style="color:green ;font-weight: 500;font-size: 0.78em;">'.$err."</font></center><br>";   
}
?><img src="compte.jpg" alt="logo" width="100%" height="40%" >
<h6> LIBRAIRIE.TN</h6> 
<?php
    }  
 else{ header("Location: acceClient.php");} ?>

</div>
</div>
</div>
    
</body>
</html>
