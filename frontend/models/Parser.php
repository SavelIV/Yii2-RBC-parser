<?php

namespace frontend\models;

use Yii;
use GuzzleHttp\Client;


/**
 * Parser class
 */
class Parser
{
    const URL = 'https://www.rbc.ru';


    /**
     * @return array array of live parsed news titles and links
     */
    public static function parseList($max)
    {
        $max = intval ($max);

        $client = new Client();
        $res = $client->request('GET', self::URL);
        $body = $res->getBody();
        $document = \phpQuery::newDocumentHTML($body);

        $list = $document->find(".js-news-feed-list");

        $pq = pq($list);
        $pq->find('.js-news-feed-banner')->remove();

        $tags = $pq->find('.news-feed__item');

        $links = self::getLinks($tags);
        $news = self::getNews($links);

        if(!empty($news) && is_array ($news)){
                for ($i = 0; $i < $max; $i++) {
                    $news[$i][2] = Yii::$app->stringHelper->getShort($news[$i][2]);
                }
        }

        return $news;
    }

    /**
     * @param object $tags
     * @return array
     */
    public static function getLinks($tags)
    {
        foreach ($tags as $key => $el) {
            $el = pq($el);
            $links[$key] = $el->attr("href");
        }
        return $links;
    }

    /**
     * @return array array of full parsed news
     */
    public static function getNews($links)
    {
        $client = new Client();

        foreach ($links as $key => $link) {

            $res = $client->request('GET', $link);
            $body = $res->getBody();
            $document = \phpQuery::newDocumentHTML($body);

            $page = $document->find(".article__content");

            $pq = pq($page);
            $pq->find('.article__inline-item__title')->remove();

            $title = $pq->find('h1.article__header__title-in')->text();
            $content = preg_replace('/\s+/', ' ', $pq->find('p')->text());
            $picture = $pq->find('img')->attr('src');

            if ($title && $title != "") {
                Yii::$app->db->createCommand()->upsert('news', [
                    'title' => $title,
                    'picture' => $picture,
                    'content' => $content,
                    'url' => $link
                ])->execute();
            }

            $news[] = [$title, $picture, $content];
        }
        return $news;
    }

    /**
     * @param integer $max
     * @return array
     */
    public static function getNewsList($max)
    {
        $max = intval($max);

        $sql = 'SELECT * FROM news LIMIT ' . $max;

        $result = Yii::$app->db->createCommand($sql)->queryAll();

        if (!empty($result) && is_array($result)) {
            foreach ($result as &$item) {
                $item['content'] = Yii::$app->stringHelper->getShort($item['content']);
            }
        }
        return $result;
    }

    /**
     *
     * @param integer $id
     * @return array|false
     */
    public static function getNewsItemById($id)
    {
        $id = intval($id);
        $sql = 'SELECT * FROM news WHERE id =' . $id;

        return Yii::$app->db->createCommand($sql)->queryOne();

    }
}