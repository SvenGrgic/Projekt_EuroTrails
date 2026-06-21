<?php
include 'spajanje.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM putopisi WHERE id=$id";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);

if(!$row) {
    die("Članak ne postoji.");
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuroTrails - <?php echo htmlspecialchars($row['naslov']); ?></title>
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
                    <li><a href="kategorija.php?id=Srednja Europa">SREDNJA EUROPA</a></li>
                    <li><a href="kategorija.php?id=Regija i Jug">REGIJA & JUG</a></li>
                    <li><a href="administrator.php">ADMINISTRACIJA</a></li>
                    <li><a href="unos.html">UNOS</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="content-wrapper single-article-view">
        <section>
            <div class="row">
                <p class="category-label-preview"><?php echo htmlspecialchars($row['kategorija']); ?></p>
                <h1 class="article-headline"><?php echo htmlspecialchars($row['naslov']); ?></h1>
                <p class="meta-info">AUTOR: Sven</p>
                <p class="meta-info">OBJAVLJENO: <?php echo date("d.m.Y.", strtotime($row['datum'])); ?></p>
            </div>
            
            <section class="main-article-image">
                <img src="img/<?php echo htmlspecialchars($row['slika']); ?>" alt="<?php echo htmlspecialchars($row['naslov']); ?>">
            </section>
            
            <div class="article-body">
                <section class="about">
                    <p><strong><?php echo htmlspecialchars($row['sazetak']); ?></strong></p>
                </section>
                
                <section class="sadrzaj">
                    <p><?php echo nl2br(htmlspecialchars($row['tekst'])); ?></p>
                </section>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <p>&copy; 2026 Sven Grgić | Kontakt: <a href="mailto:sgrgic1@tvz.hr">sgrgic1@tvz.hr</a></p>
    </footer>

</body>
</html>
<?php mysqli_close($dbc); ?>