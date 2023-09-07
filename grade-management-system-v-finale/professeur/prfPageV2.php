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
    <link rel="stylesheet" href="../style.css">
    <title>professeur page</title>
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

    <div class="container my-5 p-4">

            <form method="post" >

                <?php
                    // session_start(); 
                    $professeur = $_SESSION["prf"];
                    $x = $professeur['MatriculeProfesseur'] ;
                    $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
                    $cours = $conn->query( "SELECT NumCours , Titre FROM cours WHERE MatriculeProfesseur = $x " )->fetchAll(PDO::FETCH_ASSOC);


                    $notes = $conn->query( "SELECT e.CodeEtudiant , e.Nom , c.NumCours , c.Titre , c.Coef , exm.Note 
                                            FROM cours AS c , examen AS exm , etudiant AS e
                                            WHERE c.NumCours = exm.NumCours AND exm.CodeEtudiant = e.CodeEtudiant
                                            AND c.MatriculeProfesseur = $x " )
                                    ->fetchAll(PDO::FETCH_ASSOC);
                    
                    if( isset( $_POST['chercher'] ) ) : 
                        $courChrch = $_POST['cour'];
                        if( !empty( $courChrch ) ){
                            $notes = $conn->query( "SELECT e.CodeEtudiant , e.Nom , c.NumCours , c.Titre , c.Coef , exm.Note 
                                                    FROM cours AS c , examen AS exm , etudiant AS e
                                                    WHERE c.NumCours = exm.NumCours AND exm.CodeEtudiant = e.CodeEtudiant
                                                    AND c.MatriculeProfesseur = $x 
                                                    AND exm.NumCours = $courChrch " )
                                          ->fetchAll(PDO::FETCH_ASSOC);
                        }
                    endif; 
                ?>

                <H1 class="text-center text-primary" > Bonjour Mr <?= $professeur['Nom'] ?> voici les notes de votre etudiants </H1>
                <!-- <h1>Filtrer les notes par cour</h1> -->
                <div class="text-center ">
                    <a class="btn bg-primary mb-2 w-100" href="ajoutNote.php" role="button">AJOUTER UN NOTE</a>
                </div>
                <!-- <label  class="form-label">cours</label> -->
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
                        <th scope="col" class="text-center bg-primary text-white" >      Action      </th>

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
                                <td class="text-center" > 
                                    <a  
                                        class="btn btn-success" 
                                        href="updateNote.php?idEtd=<?= $note["CodeEtudiant"]?>&idCrs=<?= $note["NumCours"]?>"
                                        role="button">
                                        MODIFIER
                                    </a>
                                    <a  
                                        class="btn btn-danger" 
                                        href="suppNote.php?idEtd=<?= $note["CodeEtudiant"]?>&idCrs=<?= $note["NumCours"]?>"
                                        role="button"
                                        onclick="return confirm( 'comfirmer la suppression' ) ">
                                        SUPPRIMER
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                </tbody>

            </table>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>