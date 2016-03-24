<?php

namespace zabachok\logreader\helpers;

class ConfigHelper
{
    public static function parseConfig($sources)
    {
        $files = [];
        foreach ($sources as $name => $source)
        {
            $file = ['name'=>null,];
            if(!is_numeric($name))
            {
                $file['name'] = $name;
            }
            $path = \Yii::getAlias($source);
            if(is_dir($path))
            {

            }else{

            }
        }
        return $files;
    }

    public static function isAllowedFile($files, $file)
    {

    }
}