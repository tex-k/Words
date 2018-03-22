<form action="/?c=word&a=record" class="form-new" method="post">
    <div class="form-new__block">
        <label for="form-new-input-en">Английский вариант</label>
        <br>
        <input name="en" type="text" id="form-new-input-en" required>
    </div>
    <div class="form-new__block">
        <label for="form-new-input-ru">Русский вариант</label>
        <br>
        <input name="ru" type="text" id="form-new-input-ru" required>
    </div>
    <br>
    <input class="submit" type="submit" value="Записать">
</form>

<form action="/?c=word&a=translate" class="form-search" method="post">
    <div class="form-search__block">
        <label for="form-search-input-en">Английская фраза</label>
        <br>
        <input name="en" type="text" id="form-search-input-en">
    </div>
    <div class="form-search__block">
        <label for="form-search-input-ru">Русская фраза</label>
        <br>
        <input name="ru" type="text" id="form-search-input-ru">
    </div>
    <input class="submit" type="submit" value="Перевести">
</form>