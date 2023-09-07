<?php 

    session_start();
    $_SESSION['type-user'] != "prf" ? header('location:./'):null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <title>modifier un note d'etudiant</title>
</head>
<body>


    <nav class="navbar navbar-expand-lg bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand text-white" href="../acceuil.php">LOGO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div><a class="btn btn-primary btn-danger " href="./deconexion.php" role="button">Deconnexion</a></div>
        </div>
    </nav>


    <div class="container ">
            <form method="post" class="d-flex flex-column justify-content-center align-items-center vh-100">

                <?php
                    $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
                    // session_start(); 
                    $professeur = $_SESSION["prf"];
                    $x = $professeur['MatriculeProfesseur'] ;
                    $CodeEtudiantList = $conn->query( "SELECT CodeEtudiant , Nom FROM etudiant " )->fetchAll(PDO::FETCH_ASSOC);
                    $NumCoursList = $conn->query( "SELECT NumCours , Titre FROM cours WHERE MatriculeProfesseur = $x " )->fetchAll(PDO::FETCH_ASSOC);
                    if( isset( $_POST['modifer'] ) ) : 
                        var_dump($_GET);
                        $dateExm = $_POST['dateExm'];
                        $Note = $_POST['Note'];
                        $CodeEtudiant = $_GET['idEtd'];
                        $NumCours = $_GET['idCrs'];
    
                        if( !empty( $dateExm ) && !empty( $Note  ) && !empty( $NumCours ) && !empty( $CodeEtudiant)  ){
                            $sqlStmt = $conn->prepare( "UPDATE examen AS exm SET exm.Note = ? , exm.Date = ? WHERE exm.CodeEtudiant = ? AND exm.NumCours = ? ");
                            $sqlStmt->execute( [ $Note , $dateExm , $CodeEtudiant , $NumCours ] );
                            header("location:prfPageV2.php");
                        }else{
                ?>
                            <div class="alert alert-danger" role="alert">
                                tous les champs sont requis !!
                            </div>
                <?php
                        }

                    endif; 
                ?>

                <div class="border border-2 border-secondary rounded-5 p-5 w-50">
                    <label  class="form-label">etudiant</label>
                    <select disabled class="form-select form-select-lg mb-3" name="CodeEtudiant" aria-label=".form-select-lg example"  >
                        <?php 
                            foreach( $CodeEtudiantList as $CodeEtudiant ){
                                echo  "<option value=" .$CodeEtudiant['CodeEtudiant']. " > ".$CodeEtudiant['Nom']." </option>" ;
                            }
                        ?>
                    </select>

                    <label  class="form-label">cours</label>
                    <select disabled class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="NumCours" >
                        <?php 
                        foreach( $NumCoursList as $NumCours ){
                            echo "<option value=".$NumCours['NumCours'].">".$NumCours['Titre']."</option>";
                        }
                        ?>
                    </select>

                    <div class="mb-3">
                        <label  class="form-label">Date d'examen</label>
                        <input type="date" class="form-control"  aria-describedby="emailHelp" name="dateExm" > 
                    </div>

                    <div class="mb-3">
                        <label  class="form-label" >Note d'etudiant</label>
                        <input type="number" name="Note" class="form-control" >
                    </div>
                    
                    <input type="submit" value="modifer" class="btn btn-success w-100" name="modifer" >

                </div>

            </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>