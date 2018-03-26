<?php
/**
 * @var \app\models\Word $wordEn
 * @var \app\models\Word $wordRu
 * @var \app\models\Word $word
 */
?>

<div class="switcher">
    <div class="switcher__label_1">английский</div>

    <a href="/?c=page&a=test&p=<?= (($_GET['p'] == 'en') ? 'ru' : 'en') ?>" class="switcher__switch switch" id="switch">
        <div class="switch__handle" id="switch-handle"></div>
    </a>

    <div class="switcher__label_2">русский</div>
</div>

<div class="clr"></div>

<span>
        <?php
        if (($_GET['p'] == 'en') && ($wordEn)) {
            $word = $wordEn;
        } else if (($_GET['p'] == 'ru') && ($wordRu)) {
            $word = $wordRu;
        }

        if ($word) {
            echo $word->getValue();
        }
        ?>
</span>
<input type="text" name="translate" id="translate-input">
<br>
<button class="submit" id="check">Проверить</button>

<script>
    document.getElementById('check').onclick = function () {
        var translateInput = document.getElementById('translate-input').value;
        <?php
        $json = json_encode($word->getTranslate());
        ?>
        var translate = eval('<?= $json; ?>');
        var equal = 0;

        translate.forEach(function (word) {
            if (translateInput === word) {
                equal++;
            }
        });

        if (equal > 0) {
            document.getElementById('translate-input').style.borderColor = 'green';
        } else {
            document.getElementById('translate-input').style.borderColor = 'red';
        }
    };
</script>

<script>
    var lang = '<?= $_GET['p'];?>';

    if (lang === 'en') {
        document.getElementById('switch-handle').style.float = 'left';
    } else {
        document.getElementById('switch-handle').style.float = 'right';
    }
</script>