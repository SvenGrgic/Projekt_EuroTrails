<?php
include 'spajanje.php';
$kategorija = isset($_GET['id']) ? $_GET['id'] : '';
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuroTrails - <?php echo htmlspecialchars($kategorija); ?></title>
    <link rel="stylesheet" href="style.css">
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
                    <li><a href="kategorija.php?id=Srednja Europa" class="<?php if($kategorija == 'Srednja Europa') echo 'active'; ?>">SREDNJA EUROPA</a></li>
                    <li><a href="kategorija.php?id=Regija i Jug" class="<?php if($kategorija == 'Regija i Jug') echo 'active'; ?>">REGIJA & JUG</a></li>
                    <li><a href="administrator.php">ADMINISTRACIJA</a></li>
                    <li><a href="unos.html">UNOS</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="content-wrapper">
        <section class="category-section">
            <h2 class="category-title title-musica"><?php echo strtoupper(htmlspecialchars($kategorija)); ?></h2>
            <div class="grid-container">
                <?php
                if (!empty($kategorija)) {
                    $query = "SELECT * FROM putopisi WHERE arhiva=1 AND kategorija='$kategorija' ORDER BY id DESC";
                    $result = mysqli_query($dbc, $query);
                    
                    if (mysqli_num_rows($result) == 0) {
                        echo "<p>Nema pronađenih članaka u ovoj kategoriji.</p>";
                    }

                    while($row = mysqli_fetch_array($result)) {
                        echo '<article class="news-card">';
                        echo '  <div class="card-image">';
                        echo '      <img src="img/' . htmlspecialchars($row['slika']) . '" alt="' . htmlspecialchars($row['naslov']) . '">';
                        echo '  </div>';
                        echo '  <div class="card-content">';
                        echo '      <h3><a href="clanak.php?id=' . $row['id'] . '">' . htmlspecialchars($row['naslov']) . '</a></h3>';
                        echo '      <p class="date">' . date("d. m. Y.", strtotime($row['datum'])) . '</p>';
                        echo '  </div>';
                        echo '</article>';
                    }
                } else {
                    echo "<p>Kategorija nije odabrana.</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <p>&copy; 2026 Sven Grgić | Kontakt: <a href="mailto:sgrgic1@tvz.hr">sgrgic1@tvz.hr</a></p>
    </footer>

</body>
</html>
<?php mysqli_close($dbc); ?>