<?php 

        session_start();
        $_SESSION['type-user'] != "admin" ? header('location:../../'):null;
 
        $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
        $sqlStmt = $conn->prepare( "DELETE FROM etudiant 
                                    WHERE CodeEtudiant = ? ");
        $sqlStmt->execute( [ $_GET['id'] ] );
        header("location:index.php ")
    ?>



