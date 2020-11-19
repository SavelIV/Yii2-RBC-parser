<?php


namespace frontend\controllers;

use frontend\models\Parser;
use yii\web\Controller;
use Yii;

class ParserController extends Controller
{
    public function actionParse()
    {

        $max = Yii::$app->params['maxNewsInList'];

        $news = Parser::getNewsList($max);


        // вывод списка новостей с главной страницы в представление
        return $this->render('parse', ['news' => $news]);
    }

}