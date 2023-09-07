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
    <title>liste des cours</title>
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

<div class="container my-5 ">

        <?php
            $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
            $id = $_GET['id'];
            $cours = $conn->query( "SELECT NumCours,Titre,Salle,Coef FROM cours WHERE  MatriculeProfesseur = $id " )->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <h1 class="text-primary text-center" >LISTE DES COURS</h1>
        <table class="table table-bordered border-dark ">
            <thead class="table-dark" >
                <tr>
                    <th scope="col" class="text-center bg-primary text-white" > Num Cours  </th>
                    <th scope="col" class="text-center bg-primary text-white" > Titre      </th>
                    <th scope="col" class="text-center bg-primary text-white" > Salle      </th>
                    <th scope="col" class="text-center bg-primary text-white" > Coeficient </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                    <?php foreach( $cours as $cour ): ?>
                        <tr>
                            <td class="text-center" > <?=      $cour["NumCours"]        ?> </td>
                            <td class="text-center" > <?=      $cour["Titre"   ]        ?> </td>
                            <td class="text-center" > <?=      $cour["Salle"   ]        ?> </td>
                            <td class="text-center" > <?=      $cour["Coef"    ]        ?> </td>
                        </tr>
                    <?php endforeach; ?>
                
            </tbody>

        </table>



</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>