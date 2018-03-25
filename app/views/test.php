<?php
/**
 * @var \app\models\Word $wordEn
 */
?>

<form action="" class="test">
    <span>
        <?php
        if ($wordEn) {
            echo $wordEn->getValue();
        }
        ?>
    </span>
    <input type="text">
    <br>
    <input class="submit" type="submit" value="Проверить">
</form>