<?php
/**
 * @var \app\models\Word $wordEn
 */
?>

<span>
        <?php
        if ($wordEn) {
            echo $wordEn->getValue();
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
        $json = json_encode($wordEn->getTranslate());
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