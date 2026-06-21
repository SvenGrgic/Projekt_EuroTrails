<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'spajanje.php';
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>EuroTrails - Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logo"><span class="logo-main">EURO</span><span class="logo-sub">TRAILS</span></div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php" class="active">HOME</a></li>
                    <li><a href="kategorija.php?id=Srednja Europa">SREDNJA EUROPA</a></li>
                    <li><a href="kategorija.php?id=Regija i Jug">REGIJA & JUG</a></li>
                    <li><a href="administrator.php">ADMINISTRACIJA</a></li>
                    <li><a href="unos.html">UNOS</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="content-wrapper">
        <section class="category-section">
            <h2 class="category-title title-musica">SREDNJA EUROPA</h2>
            <div class="grid-container">
                <?php
                $query = "SELECT * FROM putopisi WHERE arhiva=0 AND kategorija='Srednja Europa' ORDER BY id DESC";
                $result = mysqli_query($dbc, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<article class="news-card">';
                        echo '  <div class="card-image"><img src="img/' . htmlspecialchars($row['slika']) . '"></div>';
                        echo '  <div class="card-content">';
                        echo '      <h3><a href="clanak.php?id=' . $row['id'] . '">' . htmlspecialchars($row['naslov']) . '</a></h3>';
                        echo '      <p class="date">' . date("d.m.Y.", strtotime($row['datum'])) . '</p>';
                        echo '  </div>';
                        echo '</article>';
                    }
                }
                ?>
            </div>
        </section>

        <section class="category-section">
            <h2 class="category-title title-deportes">REGIJA & JUG</h2>
            <div class="grid-container">
                <?php
                $query = "SELECT * FROM putopisi WHERE arhiva=0 AND kategorija='Regija i Jug' ORDER BY id DESC";
                $result = mysqli_query($dbc, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<article class="news-card">';
                        echo '  <div class="card-image"><img src="img/' . htmlspecialchars($row['slika']) . '"></div>';
                        echo '  <div class="card-content">';
                        echo '      <h3><a href="clanak.php?id=' . $row['id'] . '">' . htmlspecialchars($row['naslov']) . '</a></h3>';
                        echo '      <p class="date">' . date("d.m.Y.", strtotime($row['datum'])) . '</p>';
                        echo '  </div>';
                        echo '</article>';
                    }
                }
                ?>
            </div>
        </section>
    </main>
</body>
</html>
<?php mysqli_close($dbc); ?>