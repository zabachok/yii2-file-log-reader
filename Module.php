<?php

namespace zabachok\logreader;

use Yii;
use zabachok\logreader\helpers\ConfigHelper;

class Module extends \yii\base\Module
{

    public $controllerNamespace = 'zabachok\logreader\controllers';

    public $sources = [];
    public $files;

    public function init()
    {
        $array = [
            'class'=>'Module',
            'sources'=>[
                '@backend/runtime/logs', // dir
                '@backend/runtime/logs/app.log', //file
                'My log' => '/web/zabachok.net/www/runtime/logs/app.log',//named file
            ],
        ];
//        $a = ConfigHelper::parseConfig($array);
//        print_r($a);
    }

}
