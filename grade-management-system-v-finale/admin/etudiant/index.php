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

    <title>etudiant</title>
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


    <div class="container my-5 pt-4">
            
            <div class="mb-2  d-flex justify-content-between    " >
                <a class="btn bg-primary mb-2 p-3" href="ajoutEtd.php" role="button">AJOUTER UN ETUDIANT</a>
                <div class="d-flex justify-content-around w-75 " > <h1 class=" text-center text-primary" >LISTE DES ETUDIANTS</h1></div>
            </div>


            
            <table class="table border border-primary  rounded  ">
                <thead  >
                    <tr>
                        <th scope="col" class="text-center bg-primary text-white" >Code d'etudiant        </th>
                        <th scope="col" class="text-center bg-primary text-white" >Nom                    </th>
                        <th scope="col" class="text-center bg-primary text-white" >Date de naissance      </th>
                        <th scope="col" class="text-center bg-primary text-white" >Num tele               </th>
                        <th scope="col" class="text-center bg-primary text-white" >Email                  </th>
                        <th scope="col" class="text-center bg-primary text-white" >Action                 </th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                        <?php
                            $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
                            $etudiants = $conn->query( "SELECT * FROM etudiant " )->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                    
                        <?php foreach( $etudiants as $etudiant ): ?>
                            <tr>
                                <td class="text-center" > <?= $etudiant["CodeEtudiant"]               ?> </td>
                                <td class="text-center" > <?= $etudiant["Nom"]                        ?> </td>
                                <td class="text-center" > <?= $etudiant["Date_naiss"]                 ?> </td>
                                <td class="text-center" > <?= $etudiant["Tel"]                        ?> </td>
                                <td class="text-center" > <?= $etudiant["mail"]                       ?> </td>
                                <td class="text-center" > 
                                    <a class="btn btn-success" href="updateEtd.php?id=<?= $etudiant["CodeEtudiant"] ?>" role="button">MODIFIER</a>
                                    <a class="btn btn-danger" onclick="return confirm( 'comfirmer la suppression' ) " href="suppEtd.php?id=<?= $etudiant["CodeEtudiant"] ?>" role="button">SUPPRIMER</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    
                </tbody>

            </table>

    </div>
    
    <script src="../../javescrpt.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>