<?php

namespace zabachok\logreader\controllers;

use Yii;
use yii\web\Controller;
use zabachok\logreader\models\LogFile;
use zabachok\logreader\models\Reader;

class DefaultController extends Controller
{

    public function actionIndex()
    {
//        $reader = new Reader(Yii::getAlias('@app/runtime/logs/app.log'));
//        print_r($reader->getRow()->attributes);
//        return 3;
        $files = [];
        foreach ($this->module->dirs as $dir)
        {

            $path = Yii::getAlias($dir);
            if(is_dir($path))
            {
                $list = scandir($path);
                foreach ($list as $item)
                {
                    if (preg_match('|\.log$|', $item))
                    {
                        $model = new Reader($path, $item);
                        if($model !== false) $files[] = $model;
                    }
                }
            }
        }

        usort($files, [LogFile::className(), 'sort']);

        return $this->render('index', [
            'files' => $files,
        ]);
    }


}