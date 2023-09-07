<?php 

    session_start();
    $_SESSION['type-user'] != "etd" ? header('location:index.php'):null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="../style.css">

    <title>Document</title>
</head>
<body>


<nav class="navbar navbar-expand-lg bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand text-white" href="../acceuil.php">LOGO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div><a class="btn btn-primary btn-danger " href="./deconnexion.php" role="button">Deconnexion</a></div>
        </div>
    </nav>

<div class="container my-5 pt-5 ">
        <?php 
            // session_start(); 
            $etudiant = $_SESSION["etd"];
            $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
            $x = $etudiant['CodeEtudiant'] ;
            $notes = $conn->query( "SELECT Titre , Coef , Note 
                                          FROM cours AS c , examen AS exm
                                          WHERE c.NumCours = exm.NumCours 
                                          AND exm.CodeEtudiant = $x " )->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <H1 class="text-center text-primary " > bonjour <?= $etudiant['Nom'] ?> votre notes est : </H1>
        <table class="table table-bordered border-dark ">
            <thead class="table-dark" >
                <tr>
                    <th scope="col" class="text-center bg-primary text-white" >Titre</th>
                    <th scope="col" class="text-center bg-primary text-white" >Coef</th>
                    <th scope="col" class="text-center bg-primary text-white" >Note</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                    <?php foreach( $notes as $note ): ?>
                        <tr>
                            <td class="text-center" > <?= $note["Titre"]   ?> </td>
                            <td class="text-center" > <?= $note["Coef"]    ?> </td>
                            <td class="text-center" > <?= $note["Note"]    ?> </td>
                        </tr>
                    <?php endforeach; ?>
                
            </tbody>

        </table>

</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>