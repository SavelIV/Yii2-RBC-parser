<?php

/* @var $this yii\web\View */
/* @var $max frontend\controllers\ParserController */
/* @var $news frontend\controllers\ParserController */


use yii\helpers\Html;

$this->title = 'Parser';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

<!--    --><?php //for ($i = 0; $i <= $max; $i++) { ?>
<!--        --><?php //$newsLink = Html::encode($news[$i][1]); ?>
<!---->
<!--        <h3>--><?php //echo Html::a(Html::encode($news[$i][0]), $newsLink); ?><!--</h3>-->
<!--        --><?php //echo Html::img( $news[$i][1], ['width'=>'400']); ?>
<!---->
<!--        <p>--><?php //echo Html::encode($news[$i][2]); ?><!--</p>-->
<!---->
<!--        <hr>-->
<!--    --><?php //} ?>

    <?php foreach ($news as $item): ?>

    <?php $newsLink = Yii::$app->urlManager->createAbsoluteUrl(['news/' . $item['id']]); ?>

    <h1><?php echo Html::a(Html::encode($item['title']), $newsLink); ?></h1>

    <?php echo Html::a(Html::img($item['picture'], ['width'=>'400']), $newsLink); ?>

    <p><?php echo $item['content']; ?>...</p>

    <hr>

<?php endforeach; ?>

</div>




