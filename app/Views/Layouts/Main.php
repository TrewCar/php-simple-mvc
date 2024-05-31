<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="<?=auto_version("/assets/css/styles.css")?>">
</head>
<body class="site-wrapper">
<header>
    <h1>My Website</h1>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
        </ul>
    </nav>
</header>

<main>
    <?php echo $content; ?>
</main>

<footer>
    <p>&copy; 2024 My Website</p>
</footer>

<script src="<?=auto_version("/assets/js/scripts.js")?>"></script>
</body>
</html>