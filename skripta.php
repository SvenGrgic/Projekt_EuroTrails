<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $date = date('Y-m-d');
    
    $archive = isset($_POST['archive']) ? 1 : 0;

    $image = $_FILES['pphoto']['name'];
    $target = "img/" . basename($image);
    
    if (move_uploaded_file($_FILES['pphoto']['tmp_name'], $target)) {
    } else {
        $image = "placeholder.jpg";
    }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuroTrails - <?php echo htmlspecialchars($title); ?></title>
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
                    <li><a href="index.html" class="active">HOME</a></li>
                    <li><a href="#">DESTINACIJE</a></li>
                    <li><a href="#">SAVJETI</a></li>
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
                <p class="meta-info">AUTOR: Sven</p>
                <p class="meta-info">OBJAVLJENO: <?php echo date("d.m.Y.", strtotime($date)); ?></p>
            </div>
            
            <section class="main-article-image">
                <img src="img/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($title); ?>">
            </section>
            
            <div class="article-body">
                <section class="about">
                    <p><strong><?php echo htmlspecialchars($about); ?></strong></p>
                </section>
                
                <section class="sadrzaj">
                    <p><?php echo nl2br(htmlspecialchars($content)); ?></p>
                </section>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <p>&copy; 2026 Sven Grgić | Kontakt: <a href="mailto:sgrgic1@tvz.hr">sgrgic1@tvz.hr</a></p>
    </footer>

</body>
</html>