<?php
include 'spajanje.php';

$poruka = "";

if (isset($_POST['register'])) {
    $ime = trim($_POST['ime']);
    $prezime = trim($_POST['prezime']);
    $username = trim($_POST['username']);
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ($pass1 !== $pass2) {
        $poruka = "<p style='color: red;'>Lozinke se ne podudaraju!</p>";
    } else {
        $query = "SELECT id FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $poruka = "<p style='color: red;'>Korisničko ime je već zauzeto!</p>";
            mysqli_stmt_close($stmt);
        } else {
            mysqli_stmt_close($stmt);

            $hashed_password = password_hash($pass1, PASSWORD_BCRYPT);
            $level = 0;

            $query = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, level) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "ssssi", $ime, $prezime, $username, $hashed_password, $level);

            if (mysqli_stmt_execute($stmt)) {
                $poruka = "<p style='color: green;'>Registracija uspješna! <a href='administrator.php'>Prijavite se ovdje</a>.</p>";
            } else {
                $poruka = "<p style='color: red;'>Greška prilikom registracije: " . mysqli_error($dbc) . "</p>";
            }
            mysqli_stmt_close($stmt);
        }
    }
}
mysqli_close($dbc);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuroTrails - Registracija</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <span class="logo-main">EURO</span><span class="logo-sub">TRAILS</span>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="kategorija.php?id=Srednja Europa">SREDNJA EUROPA</a></li>
                    <li><a href="kategorija.php?id=Regija i Jug">REGIJA & JUG</a></li>
                    <li><a href="administrator.php">ADMINISTRACIJA</a></li>
                    <li><a href="unos.html">UNOS</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="content-wrapper">
        <section class="form-section">
            <h2 class="section-title-form">Registracija korisnika</h2>
            
            <?php echo $poruka; ?>

            <form action="registracija.php" method="POST">                
                <div class="form-item">
                    <label for="ime">Ime</label>
                    <input type="text" id="ime" name="ime" class="form-field-textual" required>
                </div>

                <div class="form-item">
                    <label for="prezime">Prezime</label>
                    <input type="text" id="prezime" name="prezime" class="form-field-textual" required>
                </div>

                <div class="form-item">
                    <label for="username">Korisničko ime</label>
                    <input type="text" id="username" name="username" class="form-field-textual" required>
                </div>

                <div class="form-item">
                    <label for="pass1">Lozinka</label>
                    <input type="password" id="pass1" name="pass1" class="form-field-textual" required>
                </div>

                <div class="form-item">
                    <label for="pass2">Ponovite lozinku</label>
                    <input type="password" id="pass2" name="pass2" class="form-field-textual" required>
                </div>

                <div class="form-item button-group">
                    <button type="submit" name="register" class="btn-submit">Registriraj se</button>
                </div>
            </form>
        </section>
    </main>

    <footer class="main-footer">
        <p>&copy; 2026 Sven Grgić | Kontakt: <a href="mailto:sgrgic1@tvz.hr">sgrgic1@tvz.hr</a></p>
    </footer>

</body>
</html>