<?php

/* @var $this yii\web\View */
/* @var $item frontend\controllers\ParserController */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'News # '.$item['id'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-9">
        <h1><?php echo $item['title']; ?></h1>
        <hr>
        <?php echo Html::img($item['picture'], ['width'=>'800']); ?>
        <hr>
        <p><?php echo $item['content']; ?></p>
        <hr>
        <a href="<?php echo Url::to(['parser/parse']); ?>" class="btn btn-info">Back to all news</a>
    </div>

</div> 