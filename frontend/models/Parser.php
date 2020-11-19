<?php

namespace frontend\models;

use Yii;
use GuzzleHttp\Client;

/**
 * author Igor
 */

class Parser
{
    /**
     * @param integer $max
     * @return array
     */
    public static function getNewsList($max)
    {
        $max = intval ($max);

        // создаем экземпляр класса
        $client = new Client();
        // отправляем запрос к странице
        $res = $client->request('GET', 'https://www.rbc.ru');
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        // подключаем phpQuery
        $document = \phpQuery::newDocumentHTML($body);
        //получаем список новостей
        $list = $document->find(".js-news-feed-list");
        // удалим рекл. блок из списка
        $pq = pq($list);
        $pq->find('.js-news-feed-banner')->remove();

        $tags = $pq->find('.news-feed__item');
        foreach ($tags as $key => $el) {
            //pq аналог $ в jQuery
            $el = pq($el);
            // считываем заголовок

            $links[$key] = $el->attr("href");
        }

        // выполняем проход циклом по списку
        foreach ($pq as $key => $elem) {
            //pq аналог $ в jQuery
            $elem = pq($elem);
            // считываем заголовокStringHelper.php

            $news = [
                "href" => $links,
                "text" => explode("\n\n", trim($elem->find(".news-feed__item__title")->text())),
                "data" => explode("\n", trim($elem->find(".news-feed__item__date-text")->text())),
            ];

        }
        
//        if(!empty($news) && is_array ($news)){
//                for ($i = 0; $i < $max; $i++) {
//                    $news['text'][$i] = Yii::$app->stringHelper->getShort($news['text'][$i]);
//                }
//        }
        return $news;
    }
    
    /**
     * 
     * @param integer $id
     * @return array|false
     */
    public static function getNewsItemById($id)
    {
        $id = intval($id);
        $sql = 'SELECT * FROM news WHERE id =' .$id;
        
        return Yii::$app->db->createCommand($sql)->queryOne(); 
        
    }
}