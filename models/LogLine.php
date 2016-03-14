<?php

namespace zabachok\logreader\models;

use yii\base\Model;

class LogLine extends Model
{
    public $date;
    public $ip;
    public $user_id;
    public $session_id;
    public $level;
    public $category;
    public $text;
    public $index;
    public $firstLine;

    public function attributeLabels()
    {
        return [
            'date'       => 'Дата',
            'ip'         => 'Ip',
            'user_id'    => 'Пользователь',
            'session_id' => 'Сессия',
            'level'      => 'Уровень',
            'category'   => 'Категория',
            'text'       => 'Текст',
            'index'      => 'Индекс',
            'firstLine'=>'Первая строка',
        ];
    }

    public function rules()
    {
        return [
            ['date', 'date'],
            [['index', 'user_id'], 'integer'],
            [['ip', 'session_id', 'level', 'category', 'text', 'firstLine'], 'string'],
        ];
    }

    public function highlight($text)
    {
        return preg_replace([
//            "|'(.+)'|U",
            '| (\/.+)([ $])|U',
            '|php:(\d+)[ $]?|',
            '|(\n)|',
            '|( {4})|'
        ], [
//            '\'<span class="text-warning">$1</span>\'',
            ' <span class="text-primary">$1</span>$2',
            'php:<span class="label label-danger">$1</span>',
            '<br>',
            "&nbsp;&nbsp;&nbsp;&nbsp;"
        ], $text);
    }
}