<?php
include 'spajanje.php';

if (isset($_POST['delete'])) {
    $id = intval($_POST['id']);
    $query = "DELETE FROM putopisi WHERE id=$id";
    mysqli_query($dbc, $query);
}

if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $title = mysqli_real_escape_string($dbc, $_POST['title']);
    $about = mysqli_real_escape_string($dbc, $_POST['about']);
    $content = mysqli_real_escape_string($dbc, $_POST['content']);
    $category = mysqli_real_escape_string($dbc, $_POST['category']);
    $archive = isset($_POST['archive']) ? 1 : 0;
    
    if (!empty($_FILES['pphoto']['name'])) {
        $image = $_FILES['pphoto']['name'];
        $target = "img/" . basename($image);
        move_uploaded_file($_FILES['pphoto']['tmp_name'], $target);
        $query = "UPDATE putopisi SET naslov='$title', sazetak='$about', tekst='$content', kategorija='$category', slika='$image', arhiva='$archive' WHERE id=$id";
    } else {
        $query = "UPDATE putopisi SET naslov='$title', sazetak='$about', tekst='$content', kategorija='$category', arhiva='$archive' WHERE id=$id";
    }
    
    mysqli_query($dbc, $query);
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
        .admin-wrapper { max-width: 800px; margin: 40px auto; padding: 20px; background: #fff; border: 1px solid #dfd5c6; border-radius: 4px; margin-bottom: 4px; }
        .admin-form { display: flex; flex-direction: column; gap: 10px; margin-bottom: 30px; border-bottom: 3px double #dfd5c6; padding-bottom: 30px; }
    </style>
</head>
<body>

    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <span class="logo-main">EURO</span>
                <span class="logo-sub">TRAILS</span>
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
        <h1 style="color: #3d5a45; margin-bottom: 30px; text-align:center;">Administracijski panel</h1>

        <?php
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
        ?>
    </main>

    <footer class="main-footer">
        <p>&copy; 2026 Sven Grgić | Kontakt: <a href="mailto:sgrgic1@tvz.hr">sgrgic1@tvz.hr</a></p>
    </footer>

</body>
</html>
<?php mysqli_close($dbc); ?>