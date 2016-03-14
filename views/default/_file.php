<div class="">
    <h4><span class="text-muted"><?=$model->path?>/</span><?=$model->filename?></h4>
    <?php

    $iterator = 0;
    $snipet = $model->getRow();
    while(!is_null($snipet) && $iterator < 3)
    {
        echo $this->render('_log_line', [
            'model'=>$snipet,
        ]);
        $snipet = $model->getRow();
        $iterator++;
    }
    ?>
</div>