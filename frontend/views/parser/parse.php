<?php

/* @var $this yii\web\View */

/* @var $mas frontend\controllers\ParserController */

/* @var $news frontend\controllers\ParserController */


use yii\helpers\Html;

$this->title = 'Parser';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?php for ($i = 0; $i < 15; $i++) { ?>
        <?php $newsLink = Html::encode($news['href'][$i]); ?>

        <h3><?php echo Html::a(Html::encode($news['text'][$i]), $newsLink); ?></h3>

        <p><?php echo Html::encode($news['data'][$i]); ?></p>

        <hr>
    <?php } ?>

</div>




