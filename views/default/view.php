<?php
$this->title = $model->filename;
?>
    <h1><?= $this->title ?></h1>
<?php
$iterator = 0;
$snipet = $model->getRow();
while (!is_null($snipet) && $iterator < 100)
{
    echo $this->render('_log_line', [
        'model' => $snipet,
    ]);
    $snipet = $model->getRow();
    $iterator++;
}
