<?php if (!isset($pageTitle)) { $pageTitle = 'Σύστημα Διαχείρισης Κυλικείου'; } ?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="overlay"></div>
    <header class="site-header">
        <div class="container nav-wrap">
            <div>
                <h1>Σύστημα Διαχείρισης Κυλικείου</h1>
                <p>Εργαστηριακή εφαρμογή σε XAMPP </p>
            </div>
            <nav>
                <a href="index.php">Αρχική</a>
                <a href="products.php">Προϊόντα</a>
                <a href="orders.php">Παραγγελίες</a>
            </nav>
        </div>
    </header>
    <main class="container main-content">
