<?php
/**
 * @var string $content
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<div class="container">
    <header class="header">
        <menu class="menu">
            <ul class="menu__ul">
                <li class="menu__li"><a href="/" class="menu__a">Главная</a></li>
                <li class="menu__li"><a href="/?a=test" class="menu__a">Тест</a></li>
            </ul>
        </menu>
    </header>

    <main class="main">
        <?= $content ?>
    </main>

    <footer class="footer">

    </footer>
</div>
</body>
</html>