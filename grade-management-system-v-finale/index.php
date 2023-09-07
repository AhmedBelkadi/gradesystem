<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="./style.css">
    <title>login admin</title>
</head>
<body>


    <div class="container  vh-100">

        <form method="post" class=" d-flex flex-column justify-content-center align-items-center vh-100">

            <div class=" text-center text-primary" > 
                    <h1>ESPACE ADMIN</h1>
            </div>
            
            <div class="border border-2 border-secondary rounded-5 p-5 w-50">

                <?php
                    if( isset( $_POST['submit'] ) ) :
                        $pass = $_POST['pass'];
                        $email = $_POST['email'];
                        $conn = new PDO( 'mysql:host=localhost;dbname=notes' , 'root' , '' );
                        $sqlStmt = $conn->prepare( "SELECT * FROM admin WHERE email = ? AND password = ? " );
                        $sqlStmt->execute( [ $email , $pass ] );
                        if( $sqlStmt->rowCount() >= 1 ){
                            session_start();
                            $_SESSION["type-user"] = "admin" ;
                            header( 'location:./admin/index.php' );
                        }else{
                ?>
                        <div class="alert alert-danger text-center" role="alert">
                            Email ou  password incorrect !!
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
                            <ul class="navbar-nav  w-100 d-flex justify-content-around align-items-center" id="selectEspace">

                                <li class="nav-item  ">
                                    <!-- <a class="nav-link  border border-2 border-secondary rounded-5 px-3" aria-current="page" href="./etudiant/index.php">ETUDIANT</a> -->
                                    <a class="nav-link border border-2 border-secondary rounded-5 px-3" href="./etudiant/index.php">ETUDIANT</a>
                                </li>            
                                <li class="nav-item ">
                                    <a class="nav-link border border-2 border-secondary rounded-5 px-3" href="./professeur/index.php">PROFESSEUR</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border border-2 border-secondary rounded-5 px-4 bg-info" href="index.php">ADMIN</a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </nav>



                <div class="mb-3  w-100 ">
                    <label  class="form-label">email</label>
                    <input type="text" class="form-control border border-2 border-secondary rounded-5"  aria-describedby="emailHelp" name="email" > 
                </div>
                <div class="mb-3 w-100">
                    <label  class="form-label" >password</label>
                    <input type="password" name="pass" class="form-control border border-2 border-secondary rounded-5" >
                </div>
                <button type="submit" class="btn bg-primary border border-2  rounded-5 w-100" name="submit" >Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    
</body>
</html>