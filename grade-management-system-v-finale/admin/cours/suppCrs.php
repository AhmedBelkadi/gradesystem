<?php 

        session_start();
        $_SESSION['type-user'] != "admin" ? header('location:../../'):null;

        $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' ); 
        $sqlStmt = $conn->prepare( "DELETE FROM cours 
                                    WHERE NumCours = ? ");
        $sqlStmt->execute( [ $_GET['id'] ] );
        header("location:index.php ")
    ?>







