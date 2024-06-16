<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it" xml:lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Project X wiki</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">Homepage</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <?php if (isset($_SESSION['email'])) : ?>
                <!-- Se l'utente è loggato permette l'accesso alle pagine -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="pkb.php">PKB table</a></li>
                        <li class="nav-item"><a class="nav-link" href="../control/ruoli.php">Area Feedback</a></li>
                    </ul>
                    <div>
                    <?php else : ?>
                        <!-- Se l'utente non è loggato mostra un pop up di errore -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                                <li class="nav-item"><a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#errorModal">PKB table</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="modal" data-bs-target="#errorModal">Area Feedback</a></li>
                            </ul>
                            <div>
                            <?php endif; ?>
                            <!-- Error Modal -->
                            <div class="modal fade" id="errorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Errore!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Non sei ancora loggato o registrato</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (isset($_SESSION['username'])) : ?>
                                <!-- Se l'utente è loggato mostra il nome utente con profilo e azione di logout -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="profilo.php">Profilo</a></li>
                                        <li><a class="dropdown-item" href="../model/logout.php">Logout</a></li>
                                    </ul>
                                </div>
                            <?php else : ?>
                                <!-- Se l'utente non è loggato allora mostra i bottoni di registrazione e login -->
                                <button class="btn btn-outline-dark mx-2" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                                <button class="btn btn-outline-dark" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                            <?php endif; ?>
                            </div>

                            <!-- Login Modal -->
                            <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="loginModalLabel">Login</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Login form -->
                                            <form action="../model/login.php" method="POST" id="loginForm">
                                                <div class="mb-3">
                                                    <label for="loginEmail" class="form-label">Email</label>
                                                    <input type="email" name="LoginEmail" class="form-control" id="loginEmail" placeholder="Enter your email" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="loginPassword" class="form-label">Password</label>
                                                    <input type="password" name="LoginPassword" class="form-control" id="loginPassword" placeholder="Enter your password" required>
                                                </div>
                                                <div class="alert alert-danger d-none" id="loginError" role="alert"></div>
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Register Modal -->
                        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="registerModalLabel">Register</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Register form -->
                                        <form action="../model/register.php" method="POST">
                                            <div class="mb-3">
                                                <label for="registerName" class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" id="registerName" placeholder="Enter your name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="registerSurname" class="form-label">Surname</label>
                                                <input type="text" name="surname" class="form-control" id="registerSurname" placeholder="Enter your surname" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="registerGender" class="form-label">Gender</label>
                                                <select class="form-select" name="gender" id="registerGender" required>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="registerEmail" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="registerEmail" placeholder="Enter your email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="registerPassword" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" id="registerPassword" placeholder="Enter your password" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="registerRole" class="form-label">Role</label>
                                                <select class="form-select" name="role" id="registerRole" required>
                                                    <option value="user">User</option>
                                                    <option value="developer">Developer</option>
                                                    <option value="engineer">Engineer</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Register</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </nav>

    <?php if (isset($_SESSION['username'])) : ?>
        <!-- Se l'utente è loggato, notifica l'avvenuto login con un banner -->
        <div class="alert alert-success" role="alert">
            <strong>Utente loggato con successo, benvenuto\a <?php echo $_SESSION['username'] ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php else : ?>
        <!-- Se l'utente non è ancora loggato o registrato, segnala di compiere login o registrazione -->
        <div class="alert alert-warning" role="alert">
            <strong>Attenzione! Non sei ancora registrato o non hai effettuato il login con le tue credenziali</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <!-- Section-->
    <section class="py-5">
        <div class=" px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"></h5>
                                <!-- Product price-->
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"></div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"></div>
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"></h5>
                                <!-- Product reviews-->

                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through"></span>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"></div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"></div>
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"></h5>
                                <!-- Product price-->
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"></div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"></h5>
                                <!-- Product reviews-->

                                <!-- Product price-->
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white"></p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>