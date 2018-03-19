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
                <li class="menu__li"><a href="" class="menu__a">Главная</a></li>
                <li class="menu__li"><a href="" class="menu__a">Тест</a></li>
            </ul>
        </menu>
    </header>

    <main class="main">
        <form action="" class="form-new" method="post">
            <div class="form-new__block">
                <label for="form-new-input-en">Английский вариант</label>
                <br>
                <input type="text" id="form-new-input-en">
            </div>
            <div class="form-new__block">
                <label for="form-new-input-ru">Русский вариант</label>
                <br>
                <input type="text" id="form-new-input-ru">
            </div>
            <br>
            <input class="submit" type="submit" value="Записать">
        </form>

        <form action="" class="form-search">
            <div class="form-search__block">
                <label for="form-search-input-en">Английская фраза</label>
                <br>
                <input type="text" id="form-search-input-en">
            </div>
            <div class="form-search__block">
                <label for="form-search-input-ru">Русская фраза</label>
                <br>
                <input type="text" id="form-search-input-ru">
            </div>
            <input class="submit" type="submit" value="Перевести">
        </form>
    </main>

    <footer class="footer">

    </footer>
</div>
</body>
</html>