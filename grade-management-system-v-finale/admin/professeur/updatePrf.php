<?php 

    session_start();
    $_SESSION['type-user'] != "admin" ? header('location:../../'):null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="../../style.css">
    <title>update professeur</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-primary fixed-top">
                <div class="container">
                    <a class="navbar-brand text-white" href="../index.php">LOGO</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                            <li class="nav-item ">
                                <a class="nav-link active text-white " aria-current="page" href="../index.php">Acceuil</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link  text-white dropdown-toggle" href="../etudiant/index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Etudiants
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../etudiant/index.php">Liste des Etudiants</a></li>
                                    <li><a class="dropdown-item" href="../etudiant/ajoutEtd.php">Ajouter Etudiant</a></li>

                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link  text-white dropdown-toggle" href="../cours/index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Cours
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../cours/index.php">Liste des cours</a></li>
                                    <li><a class="dropdown-item" href="../cours/ajoutCrs.php">Ajouter cour</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link  text-info dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Professeurs
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="./index.php">Liste des professeurs</a></li>
                                    <li><a class="dropdown-item" href="./ajoutPrf.php">Ajouter professeur</a></li>
                                    <li><a class="dropdown-item" href="./filtrCrsParProf.php">Filtrer cour par professeur</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <div><a class="btn btn-primary btn-danger " href="../deconexion.php" role="button">Deconnexion</a></div>
                </div>
    </nav>

    <div class="container">
            <form method="post" class="d-flex flex-column justify-content-center align-items-center vh-100">

                <div class="border border-2 border-secondary rounded-5 p-5 w-50">
                        <?php
                            $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
                            $sqlStmt = $conn->prepare( "SELECT * FROM professeur WHERE MatriculeProfesseur = ? ");  
                            $sqlStmt->execute([ $_GET['id'] ]);
                            $profExact = $sqlStmt->fetch(PDO::FETCH_ASSOC) ;

                            if( isset( $_POST['modifier'] ) ) : 
                                $nom = $_POST['nom'];
                                $numTele = $_POST['tele'];
                                if(  !empty( $nom  ) && !empty( $numTele )  ){

                                    $sqlStmt = $conn->prepare( "UPDATE professeur SET Nom = ? , Tel = ? WHERE MatriculeProfesseur = ? ");
                                    $sqlStmt->execute( [  $nom , $numTele , $_GET['id'] ] );
                                    header("location:index.php");

                                }else{
                        ?>
                                    <div class="alert alert-danger text-center" role="alert">
                                        tous les champs sont requis !!
                                    </div>
                        <?php
                                }
                            endif; 
                        ?>
                        <div class="mb-3">
                            <label  class="form-label">MatriculeProfesseur</label>
                            <input  disabled type="number" class="form-control"  value="<?= $profExact['MatriculeProfesseur'] ?>"  aria-describedby="emailHelp" name="matProf" > 
                        </div>

                        <div class="mb-3">
                            <label  class="form-label" >Nom</label>
                            <input type="text" value="<?= $profExact['Nom'] ?>"  name="nom" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label  class="form-label" >Num Tele</label>
                            <input type="text"  value="<?= $profExact['Tel'] ?>" name="tele" class="form-control" >
                        </div>
                        
                        <input type="submit" value="modifier" class="btn btn-success w-100" name="modifier" >
                </div>



            </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>