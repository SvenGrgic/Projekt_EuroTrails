<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'spajanje.php';

$title = isset($_POST['title']) ? $_POST['title'] : 'Nema naslova';
$about = isset($_POST['about']) ? $_POST['about'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : 'Srednja Europa';
$archive = isset($_POST['archive']) ? 1 : 0;
$date = date('Y-m-d');

if (isset($_FILES['pphoto']) && $_FILES['pphoto']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['pphoto']['name'];
    $target = "img/" . basename($image);
    move_uploaded_file($_FILES['pphoto']['tmp_name'], $target);
} else {
    $image = "placeholder.jpg";
}

$query = "INSERT INTO putopisi (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) 
          VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($dbc, $query);

mysqli_stmt_bind_param($stmt, "ssssssi", $date, $title, $about, $content, $image, $category, $archive);

$result = mysqli_stmt_execute($stmt);

if (!$result) {
    die("Greška pri upisu u bazu: " . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);
mysqli_close($dbc);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>EuroTrails - <?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logo"><span class="logo-main">EURO</span><span class="logo-sub">TRAILS</span></div>
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
                <p class="category-label-preview"><?php echo htmlspecialchars($category); ?></p>
                <h1 class="article-headline"><?php echo htmlspecialchars($title); ?></h1>
                <p class="meta-info">OBJAVLJENO: <?php echo date("d.m.Y."); ?></p>
            </div>
            <section class="main-article-image">
                <img src="img/<?php echo htmlspecialchars($image); ?>" alt="">
            </section>
            <div class="article-body">
                <p><strong><?php echo htmlspecialchars($about); ?></strong></p>
                <p><?php echo nl2br(htmlspecialchars($content)); ?></p>
            </div>
        </section>
    </main>
</body>
</html>