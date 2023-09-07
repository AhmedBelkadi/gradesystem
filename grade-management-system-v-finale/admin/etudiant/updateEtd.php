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
    <title>update etudiant</title>
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
                            <a class="nav-link  text-info dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Etudiants
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php">Liste des Etudiants</a></li>
                                <li><a class="dropdown-item" href="ajoutEtd.php">Ajouter Etudiant</a></li>

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
                            <a class="nav-link  text-white dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Professeurs
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../professeur/index.php">Liste des professeurs</a></li>
                                <li><a class="dropdown-item" href="../professeur/ajoutPrf.php">Ajouter professeur</a></li>
                                <li><a class="dropdown-item" href="../professeur/filtrCrsParProf.php">Filtrer cour par professeur</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <div><a class="btn btn-primary btn-danger " href="../deconexion.php" role="button">Deconnexion</a></div>
            </div>
    </nav>

    <div class="container ">
            <form method="post"class="d-flex flex-column justify-content-center align-items-center vh-100" >
                <div class="border border-2 border-secondary rounded-5 p-5 w-50">
                    
                    <?php
                        $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
                        $sqlStmt = $conn->prepare( "SELECT * FROM etudiant WHERE CodeEtudiant = ? ");  
                        $sqlStmt->execute([ $_GET['id'] ]);
                        $etdExact = $sqlStmt->fetch(PDO::FETCH_ASSOC) ;

                        if( isset( $_POST['modifier'] ) ) : 
                            $email = $_POST['mail'];
                            $nom = $_POST['Nom'];
                            $numTele = $_POST['tele'];
                            $Date_naiss = $_POST['Date_naiss'];
                            if(  !empty( $email ) && !empty( $nom  ) && !empty( $numTele ) &&  !empty( $Date_naiss ) ){

                                $sqlStmt = $conn->prepare( "UPDATE etudiant SET Nom = ? , Date_naiss = ? , Tel = ? , mail = ? WHERE CodeEtudiant = ? ");
                                $sqlStmt->execute( [  $nom , $Date_naiss , $numTele , $email , $_GET['id'] ] );
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
                        <label  class="form-label">Code d'etudiant</label>
                        <input disabled value="<?= $etdExact['CodeEtudiant'] ?>" type="text" class="form-control"  aria-describedby="emailHelp" name="CodeEtudiant" > 
                    </div>

                    <div class="mb-3">
                        <label  class="form-label" >Nom</label>
                        <input type="text" value="<?= $etdExact['Nom'] ?>" name="Nom" class="form-control" >
                    </div>

                    <div class="mb-3">
                        <label  class="form-label" >date de naissance</label>
                        <input type="date" value="<?= $etdExact['Date_naiss'] ?>" name="Date_naiss" class="form-control" >
                    </div>

                    <div class="mb-3">
                        <label  class="form-label" >Num Tele</label>
                        <input type="text" value="<?= $etdExact['Tel'] ?>" name="tele" class="form-control" >
                    </div>

                    <div class="mb-3">
                        <label  class="form-label" >email</label>
                        <input type="email" value="<?= $etdExact['mail'] ?>" name="mail" class="form-control" >
                    </div>
                    
                    <input type="submit" value="modifier" class="btn btn-success w-100" name="modifier" >
                </div>

            </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>