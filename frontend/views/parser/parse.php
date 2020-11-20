<?php

/* @var $this yii\web\View */
/* @var $news frontend\controllers\ParserController */


use yii\helpers\Html;

$this->title = 'Newsfeed';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <a class="btn btn-lg btn-success" href="parser/update">Parse latest news</a>
    <hr>

    <?php foreach ($news as $item): ?>

    <?php $newsLink = Yii::$app->urlManager->createAbsoluteUrl(['news/' . $item['id']]); ?>

    <h1><?php echo Html::a(Html::encode($item['title']), $newsLink); ?></h1>

    <?php echo Html::a(Html::img($item['picture'], ['width'=>'400']), $newsLink); ?>
    <hr>

    <p><?php echo $item['content']; ?>...</p>

    <hr>

<?php endforeach; ?>

</div>




