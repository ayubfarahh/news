<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/styles.css" />
    <meta name="summary" content="Assignment 2024" />
    <title>Northampton News - Admin</title>
</head>
<body>
    <header>
        <section>
            <h1>Northampton News - Admin Panel</h1>
        </section>
    </header>
    <nav>
        <ul>
            <li><a href="/admin/index.php">Home</a></li>
            <li><a href="/admin/articles.php">Edit Articles</a></li>
            <li><a href="/admin/categories.php">Edit Categories</a>
            </li>
            <li><a href="/admin/contact.php">Contact Admin</a></li>
        </ul>
    </nav>
    <img src="/images/banners/randombanner.php" />
    <main>
        <?= $output; ?>
    </main>
    <footer>
        &copy; Northampton News Admin <?= date('Y'); ?>
    </footer>
</body>
</html>
