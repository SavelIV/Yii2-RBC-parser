<?php

namespace frontend\components;
use Yii;

/**
 * Get shorter string (frontend/config/params: shortTextLimit=200)
 *
 * @author Igor
 */
class StringHelper {
    
    private $limit;
    
    public function __construct() {
        $this->limit = Yii::$app->params['shortTextLimit'];
    }
    
    public function getShort($string, $limit = null)
    {
        if ($limit === null){
            $limit = $this->limit;
        }
        return substr($string,0,$limit);
    }
}