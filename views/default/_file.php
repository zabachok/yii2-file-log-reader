<div class="">
    <h4>
        <a href="/logreader/default/view?file=<?=$model->path.'/'.$model->filename?>">
        <span class="text-muted"><?=$model->path?>/</span><?=$model->filename?>
        </a>
    </h4>
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