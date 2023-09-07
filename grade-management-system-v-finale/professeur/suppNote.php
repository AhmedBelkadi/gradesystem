<?php 

    session_start();
    $_SESSION['type-user'] != "prf" ? header('location:./'):null;

?>
<?php 
        $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
        $sqlStmt = $conn->prepare( "DELETE FROM examen 
                                    WHERE CodeEtudiant = ? 
                                    AND NumCours = ? ");
        var_dump($_GET);
        $sqlStmt->execute( [ $_GET['idEtd'] , $_GET['idCrs'] ] );
        header("location:prfPageV2.php ")
    ?>  