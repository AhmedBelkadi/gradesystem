<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="../style.css">
    <title>login professeur</title>
</head>
<body>


    <div class="container  vh-100">

        <form method="post" class=" d-flex flex-column justify-content-center align-items-center vh-100">

            <div class=" text-center text-primary" > 
                    <h1>ESPACE PROFESSEUR</h1>
            </div>
            
            <div class="border border-2 border-secondary rounded-5 p-5 w-50">

                <?php 
                    if( isset( $_POST['submit'] ) ) : 
                        $MatriculeProfesseur = $_POST['MatriculeProfesseur'];
                        $Tel = $_POST['Tel'];
                        $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' );
                        $sqlStmt = $conn->prepare( "SELECT * FROM professeur WHERE MatriculeProfesseur = ? AND Tel = ? " );
                        $sqlStmt->execute( [ $MatriculeProfesseur , $Tel ] );
                        if( $sqlStmt->rowCount() >= 1 ){
                            session_start();
                            $_SESSION["type-user"] = "prf" ;
                            $_SESSION["prf"] = $sqlStmt->fetch(PDO::FETCH_ASSOC) ;
                            header( 'location:prfPageV2.php ' );

                        }else{
                ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Matricule du professeur ou num tele incorrect !!
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

                                <li class="nav-item  ">
                                    <a class="nav-link border border-2 border-secondary rounded-5 px-3" href="../etudiant/index.php">ETUDIANT</a>

                                </li>            
                                <li class="nav-item">
                                    <a class="nav-link border border-2 border-secondary rounded-5 px-3 bg-info" href="index.php">PROFESSEUR</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border border-2 border-secondary rounded-5 px-4" href="../index.php">ADMIN</a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </nav>


                <div class="mb-3  w-100 ">
                    <label  class="form-label">Matricule Professeur</label>
                    <input type="text" class="form-control border border-2 border-secondary rounded-5"  aria-describedby="emailHelp" name="MatriculeProfesseur" > 
                </div>

                <div class="mb-3 w-100">
                    <label  class="form-label" >numero du telephone</label>
                    <input type="text" name="Tel" class="form-control border border-2 border-secondary rounded-5" >
                </div>
                
                <button type="submit" class="btn bg-primary border border-2  rounded-5 w-100" name="submit" >Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    
</body>
</html>