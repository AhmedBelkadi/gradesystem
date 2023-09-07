<?php 

    session_start();
    $_SESSION['type-user'] != "admin" ? header('location:../'):null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="../style.css">
    <title>page d'acceuil</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-primary fixed-top">
            <div class="container">
                <a class="navbar-brand text-white" href="index.php">LOGO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item ">
                            <a class="nav-link active text-info " aria-current="page" href="index.php">Acceuil</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link  text-white dropdown-toggle" href="etudiant/index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Etudiants
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="etudiant/index.php">Liste des Etudiants</a></li>
                                <li><a class="dropdown-item" href="etudiant/ajoutEtd.php">Ajouter Etudiant</a></li>

                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link  text-white dropdown-toggle" href="cours/index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Cours
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="cours/index.php">Liste des cours</a></li>
                                <li><a class="dropdown-item" href="cours/ajoutCrs.php">Ajouter cour</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  text-white dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Professeurs
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="professeur/index.php">Liste des professeurs</a></li>
                                <li><a class="dropdown-item" href="professeur/ajoutPrf.php">Ajouter professeur</a></li>
                                <li><a class="dropdown-item" href="professeur/filtrCrsParProf.php">Filtrer cour par professeur</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <div><a class="btn btn-primary btn-danger " href="./deconexion.php" role="button">Deconnexion</a></div>
            </div>
    </nav>


    <div class="container my-5 pt-4">
            <h1 class=" text-center" >LISTE DES NOTES DES ETUDIANTS</h1>

            <form method="post" >

                <?php
                    $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
                    $cours = $conn->query( "SELECT NumCours , Titre FROM cours " )->fetchAll(PDO::FETCH_ASSOC);


                    $notes = $conn->query( "SELECT e.CodeEtudiant , e.Nom , c.NumCours , c.Titre , c.Coef , exm.Note 
                                            FROM cours AS c , examen AS exm , etudiant AS e
                                            WHERE c.NumCours = exm.NumCours AND exm.CodeEtudiant = e.CodeEtudiant" )
                                    ->fetchAll(PDO::FETCH_ASSOC);
                    
                    if( isset( $_POST['chercher'] ) ) : 
                        $courChrch = $_POST['cour'];
                        if( !empty( $courChrch ) ){
                            $notes = $conn->query( "SELECT e.CodeEtudiant , e.Nom , c.NumCours , c.Titre , c.Coef , exm.Note 
                                                    FROM cours AS c , examen AS exm , etudiant AS e
                                                    WHERE c.NumCours = exm.NumCours AND exm.CodeEtudiant = e.CodeEtudiant
                                                    AND exm.NumCours = $courChrch " )
                                          ->fetchAll(PDO::FETCH_ASSOC);
                        }
                    endif; 
                ?>

                <select class="form-select form-select-lg mb-3 border border-primary border-2 rounded-5 " aria-label=".form-select-lg example" name="cour" >

                    <option  value="" >choisir un cour</option>
                    <?php foreach( $cours as $cour ): ?>  
                        <option value=" <?= $cour['NumCours'] ?> "> <?= $cour['Titre'] ?> </option>";
                    <?php endforeach; ?>

                </select>
                <input type="submit" value="FILTRER PAR COUR" class="btn bg-primary w-100" name="chercher" >

            </form>

            <table class="mt-3 table border border-primary  rounded ">

                <thead class=""  >
                    <tr >
                        <th scope="col" class="text-center bg-primary text-white " >   CodeEtudiant   </th>
                        <th scope="col" class="text-center bg-primary text-white" >       Nom        </th>
                        <th scope="col" class="text-center bg-primary text-white" >       cour       </th>
                        <th scope="col" class="text-center bg-primary text-white" >       Coef       </th>
                        <th scope="col" class="text-center bg-primary text-white" >       Note       </th>

                    </tr>
                </thead>

                <tbody >

                        <?php foreach( $notes as $note ): ?>
                            <tr>
                                <td class="text-center" > <?= $note["CodeEtudiant"]   ?> </td>
                                <td class="text-center" > <?= $note["Nom"]            ?> </td>         
                                <td class="text-center" > <?= $note["Titre"]          ?> </td>
                                <td class="text-center" > <?= $note["Coef"]           ?> </td>
                                <td class="text-center" > <?= $note["Note"]           ?> </td>

                            </tr>
                        <?php endforeach; ?>
                </tbody>

            </table>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>