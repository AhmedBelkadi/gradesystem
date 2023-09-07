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
    <title>ajouter cour</title>
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
                                    <a class="nav-link  text-white dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Etudiants
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../etudiant/index.php">Liste des Etudiants</a></li>
                                        <li><a class="dropdown-item" href="../etudiant/ajoutEtd.php">Ajouter Etudiant</a></li>

                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link  text-info dropdown-toggle" href="../cours/index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Cours
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="index.php">Liste des cours</a></li>
                                        <li><a class="dropdown-item" href="ajoutCrs.php">Ajouter cour</a></li>
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

    <div class="container pt-4">
            <form method="post" class="d-flex flex-column justify-content-center align-items-center vh-100" >
                <div class="border border-2 border-secondary rounded-5 p-5 w-50">
                    <?php
                    $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
                    $Professeurs = $conn->query( "SELECT MatriculeProfesseur , Nom FROM professeur " )->fetchAll(PDO::FETCH_ASSOC);
                    if (isset($_POST['ajouter'])) :
                        $Salle = $_POST['Salle'];
                        $coef = $_POST['coef'];
                        $prof = $_POST['prof'];
                        $Titre = $_POST['Titre'];
                        $NumCours = $_POST['NumCours'];

                            


                            $checkStmt = $conn->prepare("SELECT NumCours FROM cours WHERE NumCours = ?");
                            $checkStmt->execute([$NumCours]);

                            if ($checkStmt->rowCount() > 0) {
                        ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    Numero du cour deja existe!
                                </div>
                        <?php
                            } else if (!empty( $NumCours ) && !empty( $Salle  ) && !empty( $coef ) && !empty( $prof ) && !empty( $Titre )) {
                                $sqlStmt = $conn->prepare( "INSERT INTO cours VALUES(?,?,?,?,?)");
                                $sqlStmt->execute( [ $NumCours , $Salle , $prof , $Titre , $coef ] );
                                header("location:index.php");

                            } else {
                        ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    tous les champs sont requis !!
                                </div>
                        <?php
                            }
                    endif;
                    ?>
                        <div class="mb-3">
                            <label  class="form-label">Num Cours</label>
                            <input type="text" class="form-control"  aria-describedby="emailHelp" name="NumCours" > 
                        </div>

                        <div class="mb-3">
                            <label  class="form-label" >Titre</label>
                            <input type="text" name="Titre" class="form-control" >
                        </div>

                        <label  class="form-label">Professeur</label>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="prof" >
                            <option value="" >choisir un Professeur</option>
                            <?php 
                            foreach( $Professeurs as $Professeur ){
                                echo "<option value=".$Professeur['MatriculeProfesseur'].">".$Professeur['Nom']."</option>";
                            }
                            ?>
                        </select>

                        <div class="mb-3">
                            <label  class="form-label" >Coefficient</label>
                            <input type="text" name="coef" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label  class="form-label" >Salle</label>
                            <input type="text" name="Salle" class="form-control" >
                        </div>

                        <input type="submit" value="Ajouter" class="btn bg-primary w-100" name="ajouter" >     

                </div>
            </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>