
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="../style.css">
    <title>login d'etudiant</title>
</head>
<body>


    <div class="container vh-100 ">




        <form method="post" class=" d-flex flex-column justify-content-center align-items-center vh-100" >

            <div class=" text-center text-primary" > 
                    <h1>ESPACE ETUDIANT</h1>
            </div>
            
            <div class="border border-2 border-secondary rounded-5 p-5 w-50">


                <?php 
                    if( isset( $_POST['submit'] ) ) : 
                        $CodeEtudiant = $_POST['CodeEtudiant'];
                        $Date_naiss = $_POST['Date_naiss'];
                        $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' );
                        $sqlStmt = $conn->prepare( "SELECT * FROM etudiant WHERE CodeEtudiant = ? AND Date_naiss = ? " );
                        $sqlStmt->execute( [ $CodeEtudiant , $Date_naiss ] );
                        if( $sqlStmt->rowCount() >= 1 ){
                            session_start();
                            $_SESSION["type-user"] = "etd" ;
                            $_SESSION["etd"] = $sqlStmt->fetch(PDO::FETCH_ASSOC) ;
                            header( 'location:infoEtd.php ' );
                        }else{
                ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Code Etudiant ou Date de naissance incorrect !!
                            </div>  
                <?php
                             }
                     endif; 
                ?>

                <div class=" text-center " > 
                        <h1>Connexion</h1>
                        <h2>vous êtes ?</h2>
                </div>
                <nav class="navbar navbar-expand-lg bg-body-tertiary ">
                    <div class="container-fluid  ">

                        <div class="collapse navbar-collapse  " id="navbarNav">
                            <ul class="navbar-nav  w-100 d-flex justify-content-around align-items-center">

                                <li class="nav-item ">
                                    <a class="nav-link border border-2 border-secondary rounded-5 px-3 bg-info" href="index.php">ETUDIANT</a>
                                </li>            
                                <li class="nav-item">
                                    <a class="nav-link border border-2 border-secondary rounded-5 px-3" href="../professeur/index.php">PROFESSEUR</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border border-2 border-secondary rounded-5 px-4" href="../index.php">ADMIN</a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </nav>


                <div class="mb-3">
                    <label  class="form-label">Code d'etudiant</label>
                    <input type="text" class="form-control border border-2 border-secondary rounded-5 "  aria-describedby="emailHelp" name="CodeEtudiant" > 
                </div>
                <div class="mb-3">
                    <label  class="form-label" >Date de naissance</label>
                    <input type="date" name="Date_naiss" class="form-control border border-2 border-secondary rounded-5 " >
                </div>
                <button type="submit" class="btn bg-primary border border-2  rounded-5 w-100" name="submit" >Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    
</body>
</html>