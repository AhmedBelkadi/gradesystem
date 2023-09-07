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
    <title>filtre</title>
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
                        <a class="nav-link  text-white dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cours
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../cours/index.php">Liste des cours</a></li>
                            <li><a class="dropdown-item" href="../cours/ajoutCrs.php">Ajouter cour</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  text-info dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

    <div class="container my-5 pt-4">
            <form method="get" >

                <?php
                    $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
                    $Professeurs = $conn->query( "SELECT MatriculeProfesseur,Nom FROM professeur " )->fetchAll(PDO::FETCH_ASSOC);

                    // $where = '';
                    $cours = $conn->query( "SELECT c.NumCours , p.Nom , c.Titre , c.Salle , c.Coef 
                                            FROM cours as c , professeur as p 
                                            WHERE c.MatriculeProfesseur = p.MatriculeProfesseur ")
                                ->fetchAll(PDO::FETCH_ASSOC);
                                
                    if( isset( $_GET['chercher'] ) ) : 
                        $professeurChrch = $_GET['prof'];
                        if( !empty( $professeurChrch ) ){
                            // $where = "AND MatriculeProfesseur = $professeurChrch ";
                            $cours = $conn->query( "SELECT c.NumCours , p.Nom , c.Titre , c.Salle , c.Coef 
                                                    FROM cours as c , professeur as p 
                                                    WHERE c.MatriculeProfesseur = p.MatriculeProfesseur 
                                                    AND c.MatriculeProfesseur = $professeurChrch ")
                                        ->fetchAll(PDO::FETCH_ASSOC);
                        }
                    endif; 
                ?>

                <label  class="form-label px-3">Professeur</label>
                <select class="form-select form-select-lg mb-3 border border-2 border-secondary rounded-5" aria-label=".form-select-lg example" name="prof" >
                    <option value="" >choisir un professeur</option>
                    <?php foreach( $Professeurs as $Professeur ): ?>  
                        <option value=" <?= $Professeur['MatriculeProfesseur'] ?> "> <?= $Professeur['Nom'] ?> </option>";
                    <?php endforeach; ?>
                    
                </select>
                <input type="submit" value="FILTRER" class="btn bg-primary w-100" name="chercher" >

            </form>

            
            <table class="table mt-2 border border-primary">
                <thead>
                    <tr>
                        <th scope="col" class="text-center bg-primary text-white ">num cour</th>
                        <th scope="col" class="text-center bg-primary text-white ">Nom professeur</th>
                        <th scope="col" class="text-center bg-primary text-white ">Titre</th>
                        <th scope="col" class="text-center bg-primary text-white ">Salle</th>
                        <th scope="col" class="text-center bg-primary text-white ">Coef</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    
                        <?php foreach( $cours as $cour ): ?>
                            <tr>
                                <td class="text-center"> <?= $cour["NumCours"] ?> </td>
                                <td class="text-center"> <?= $cour["Nom"]      ?> </td>
                                <td class="text-center"> <?= $cour["Titre"]    ?> </td>
                                <td class="text-center"> <?= $cour["Salle"]    ?> </td>
                                <td class="text-center"> <?= $cour["Coef"]     ?> </td>
                            </tr>
                        <?php endforeach; ?>
                    
                </tbody>

            </table>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>