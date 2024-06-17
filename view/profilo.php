<?php
session_start();
include_once '../control/conn.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['email'])) { // Verifica l'email anziché l'username
    echo 'Accesso non autorizzato!';
    exit();
}


$email = $_SESSION['email'];

// Utilizzare una query preparata
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
if (!$stmt) {
    printf("Errore nella preparazione della query: %s", $conn->error);
    exit();
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Nessun utente trovato";
    exit();
}
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
    <!-- Il tuo header va qui -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">Homepage</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="pkb.php">PKB table</a></li>
                    <li class="nav-item"><a class="nav-link" href="../control/ruoli.php">Area Feedback</a></li>
                </ul>
                <div>
                    <?php if (isset($_SESSION['username'])) : ?>
                    <!-- Se l'utente è loggato mostra il nome utente con profilo e azione di logout -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php">Home</a></li>
                            <li><a class="dropdown-item" href="../model/logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <?php else : ?>
                    <!-- Se l'utente non è loggato allora mostra i bottoni di registrazione e login -->
                    <button class="btn btn-outline-dark mx-2" type="button" data-bs-toggle="modal"
                        data-bs-target="#loginModal">Login</button>
                    <button class="btn btn-outline-dark" type="button" data-bs-toggle="modal"
                        data-bs-target="#registerModal">Register</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <!-- Qui mostri i dati dell'utente -->
    <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
        <div class="card p-4"> <div class=" image d-flex flex-column justify-content-center align-items-center">
            <button class="btn btn-secondary"> <img src="../img/profile.png" alt="" height="100" width="100" /></button>
            <span class="name mt-3"><strong><?php echo htmlspecialchars($user['name']); ?> <?php echo htmlspecialchars($user['surname']); ?></strong></span>
            <div class="d-flex flex-row justify-content-center align-items-center mt-3">
                <span class="idd1">Email: <?php echo htmlspecialchars($user['email']); ?></span> <span><i class="fa fa-copy"></i></span>
            </div>
            <div class="d-flex flex-row justify-content-center align-items-center mt-3">
                <span class="number">Genere: <?php echo htmlspecialchars($user['gender']); ?></span>
            </div>
            <div class="d-flex flex-row justify-content-center align-items-center mt-3">
                <span class="number">Ruolo: <?php echo htmlspecialchars($user['role']); ?></span>
            </div>
            <div class="d-flex flex-row justify-content-center align-items-center mt-3">
                <form action="../model/deleteAccount.php" method="POST">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                    <button type="submit" class="btn btn-danger">Elimina account</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white"></p>
        </div>
    </footer>
    <!-- Il resto del tuo HTML va qui -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
