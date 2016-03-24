<?php
use yii\bootstrap\Modal;
$this->title = 'Лог - файлы';
?>
<h1><?=$this->title?></h1>
<?php
foreach ($files as $file)
{
    echo $this->render('_file', ['model'=>$file]);
}

Modal::begin([
    'header' => '<h2>Запись в логе</h2>',
    'id'=>'modal',
    'size'=>Modal::SIZE_LARGE,
    'options'=>[
        'style'=>'word-break:break-word;',
    ],
]);

Modal::end();