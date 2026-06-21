<?php
session_start();
include 'spajanje.php';

$error_poruka = "";
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT id, ime, prezime, lozinka, level FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['lozinka'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['ime'] = $row['ime'];
            $_SESSION['prezime'] = $row['prezime'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['korisnik'] = $username;
        } else {
            $error_poruka = "pogresna_lozinka";
        }
    } else {
        $error_poruka = "nepostojeci_korisnik";
    }
    mysqli_stmt_close($stmt);
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: administrator.php");
    exit();
}

if (isset($_POST['delete']) && isset($_SESSION['level']) && $_SESSION['level'] > 0) {
    $id = intval($_POST['id']);
    $query = "DELETE FROM putopisi WHERE id = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

if (isset($_POST['update']) && isset($_SESSION['level']) && $_SESSION['level'] > 0) {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']) ? 1 : 0;
    
    if (!empty($_FILES['pphoto']['name'])) {
        $image = $_FILES['pphoto']['name'];
        $target = "img/" . basename($image);
        move_uploaded_file($_FILES['pphoto']['tmp_name'], $target);
        
        $query = "UPDATE putopisi SET naslov=?, sazetak=?, tekst=?, kategorija=?, slika=?, arhiva=? WHERE id=?";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "sssssii", $title, $about, $content, $category, $image, $archive, $id);
    } else {
        $query = "UPDATE putopisi SET naslov=?, sazetak=?, tekst=?, kategorija=?, arhiva=? WHERE id=?";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "ssssii", $title, $about, $content, $category, $archive, $id);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuroTrails - Administracija</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-wrapper { max-width: 800px; margin: 40px auto; padding: 20px; background: #fff; border: 1px solid #dfd5c6; border-radius: 4px; }
        .admin-form { display: flex; flex-direction: column; gap: 10px; margin-bottom: 30px; border-bottom: 3px double #dfd5c6; padding-bottom: 30px; }
        .msg-container { text-align: center; margin: 50px auto; max-width: 600px; padding: 30px; background: #fff; border: 1px solid #dfd5c6; border-radius: 4px; }
    </style>
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
                    <li><a href="administrator.php" class="active">ADMINISTRACIJA</a></li>
                    <li><a href="unos.html">UNOS</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="content-wrapper">
        <?php
        if (!isset($_SESSION['korisnik'])) {
            if ($error_poruka == "nepostojeci_korisnik" || $error_poruka == "pogresna_lozinka") {
                echo "<div class='msg-container'>";
                echo "<p style='color:red; font-weight:bold; margin-bottom:15px;'>Korisničko ime i/ili lozinka nisu ispravni. Morate se prvo registrirati.</p>";
                echo "<a href='registracija.php' class='btn-submit' style='text-decoration:none; padding:10px 20px; display:inline-block;'>Forma za registraciju</a>";
                echo "</div>";
            }
        ?>
            <section class="form-section" style="margin-top: 40px;">
                <h2 class="section-title-form">Prijava u administraciju</h2>
                <form action="administrator.php" method="POST">
                    <div class="form-item">
                        <label for="username">Korisničko ime:</label>
                        <input type="text" id="username" name="username" class="form-field-textual" required>
                    </div>
                    <div class="form-item">
                        <label for="password">Lozinka:</label>
                        <input type="password" id="password" name="password" class="form-field-textual" required>
                    </div>
                    <div class="form-item button-group">
                        <button type="submit" name="login" class="btn-submit">Prijavi se</button>
                    </div>
                </form>
            </section>
        <?php
        } 
if (isset($_SESSION['korisnik']) && $_SESSION['level'] == 0) {
            echo "<div class='msg-container'>";
            echo "<h2 style='color: #556b2f;'>Bok, " . htmlspecialchars($_SESSION['ime']) . " " . htmlspecialchars($_SESSION['prezime']) . "!</h2>";
            echo "<p style='color: red; margin: 20px 0; font-weight: bold;'>Nemate administratorska prava za pristup ovoj stranici.</p>";
            echo "<a href='administrator.php?logout=true' class='btn-reset' style='text-decoration:none; padding:8px 15px; display:inline-block;'>Odjavi se</a>";
            echo "</div>";
        } 
if (isset($_SESSION['korisnik']) && $_SESSION['level'] > 0) {
            echo "<div style='text-align:right; max-width:800px; margin:0 auto 20px auto;'>";
            echo "Prijavljen administrator: <strong>" . htmlspecialchars($_SESSION['korisnik']) . "</strong> | <a href='administrator.php?logout=true' style='color:red;'>Odjava</a>";
            echo "</div>";
            echo "<h1 style='color: #3d5a45; margin-bottom: 30px; text-align:center;'>Administracijski panel</h1>";

            $query = "SELECT * FROM putopisi ORDER BY id DESC";
            $result = mysqli_query($dbc, $query);
            
            if(mysqli_num_rows($result) == 0) {
                echo "<p style='text-align:center;'>Nema unesenih vijesti u bazi podataka.</p>";
            }

            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="admin-wrapper">
                    <form action="administrator.php" method="POST" enctype="multipart/form-data" class="admin-form">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        
                        <div class="form-item">
                            <label>Naslov članka:</label>
                            <input type="text" name="title" class="form-field-textual" value="<?php echo htmlspecialchars($row['naslov']); ?>" required>
                        </div>

                        <div class="form-item">
                            <label>Kratki sadržaj:</label>
                            <textarea name="about" rows="2" class="form-field-textual" maxlength="50" required><?php echo htmlspecialchars($row['sazetak']); ?></textarea>
                        </div>

                        <div class="form-item">
                            <label>Sadržaj putopisa:</label>
                            <textarea name="content" rows="6" class="form-field-textual" required><?php echo htmlspecialchars($row['tekst']); ?></textarea>
                        </div>

                        <div class="form-item">
                            <label>Slika (trenutna: <?php echo htmlspecialchars($row['slika']); ?>):</label>
                            <input type="file" name="pphoto">
                        </div>

                        <div class="form-item">
                            <label>Regija / Kategorija:</label>
                            <select name="category" class="form-field-textual" required>
                                <option value="Srednja Europa" <?php if($row['kategorija'] == 'Srednja Europa') echo 'selected'; ?>>Srednja Europa</option>
                                <option value="Regija i Jug" <?php if($row['kategorija'] == 'Regija i Jug') echo 'selected'; ?>>Regija & Jug</option>
                            </select>
                        </div>

                        <div class="form-item checkbox-item">
                            <label>
                                <input type="checkbox" name="archive" value="1" <?php if($row['arhiva'] == 1) echo 'checked'; ?>>
                                Arhiviraj (sakrij s početne stranice)
                            </label>
                        </div>

                        <div class="form-item button-group">
                            <button type="submit" name="delete" class="btn-reset" onclick="return confirm('Jeste li sigurni da želite obrisati ovaj članak?');">Obriši</button>
                            <button type="submit" name="update" class="btn-submit">Spremi izmjene</button>
                        </div>
                    </form>
                </div>
            <?php
            }
        }
        ?>
    </main>

    <footer class="main-footer">
        <p>&copy; 2026 Sven Grgić | Kontakt: <a href="mailto:sgrgic1@tvz.hr">sgrgic1@tvz.hr</a></p>
    </footer>

</body>
</html>
<?php mysqli_close($dbc); ?>