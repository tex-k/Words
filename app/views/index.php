<?php
/**
 * @var array $words
 * @var \app\models\Word $wordEn
 * @var \app\models\Word $wordRu
 */
?>
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
        <input name="en" type="text" id="form-search-input-en" value="<?= ($wordEn) ? $wordEn->getValue() : '' ?>">
        <span>
            <?php
            if ($wordEn) {
                $translation = $wordEn->getTranslate();
                for ($i = 0; $i < count($translation); $i++) {
                    echo $translation[$i] . ((count($translation) > ($i + 1)) ? ', ' : '');
                }
            }
            ?>
        </span>
    </div>
    <div class="form-search__block">
        <label for="form-search-input-ru">Русская фраза</label>
        <br>
        <input name="ru" type="text" id="form-search-input-ru" value="<?= ($wordRu) ? $wordRu->getValue() : '' ?>">
        <span>
            <?php
            if ($wordRu) {
                $translation = $wordRu->getTranslate();
                for ($i = 0; $i < count($translation); $i++) {
                    echo $translation[$i] . ((count($translation) > ($i + 1)) ? ', ' : '');
                }
            }
            ?>
        </span>
    </div>
    <input class="submit" type="submit" value="Перевести">
</form>

<div class="new-words">
    <div class="new-words__words">
        <?php
        if ($words != 'nowords') {
            foreach ($words as $key => $value) {
                echo $key . ' - ' . $value . '<br>';
            }
        }
        ?>
    </div>
</div>
<div class="clr"></div>
<a href="/?c=word&a=clear" class="clear">Очистить</a>