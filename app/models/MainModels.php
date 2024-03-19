<?php

namespace app\models;

use app\core\BaseModel;
use app\lib\UserOperations;

class MainModels extends BaseModel
{

    public function getListMain()
    {
        $result = null;

        $main = $this->select('
        SELECT * FROM goods
         LEFT JOIN (SELECT coming.good_id, COALESCE(com.sum, 0) - COALESCE(sub.sum, 0) as count
                    FROM coming
                             LEFT JOIN (SELECT SUM(count) as sum, good_id
                                        FROM coming
                                        where is_coming = 1
                                        group by good_id) as com on com.good_id = coming.good_id
                             LEFT JOIN (SELECT SUM(count) as sum, good_id
                                        FROM coming
                                        where is_coming = 0
                                        group by good_id) as sub on sub.good_id = coming.good_id
                    GROUP BY good_id) as com on com.good_id = goods.id
        where com.count > 0;
        ');
        if (!empty($main)) {
            $result = $main;
        }
        return $result;
    }

}