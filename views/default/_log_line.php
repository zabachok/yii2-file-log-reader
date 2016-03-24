<?php
/**
 * @var \zabachok\logreader\models\LogLine $model
 */

$levelClass = [
    'error'   => 'danger',
    'warning' => 'warning',
    'info'    => 'info',
    'trace'   => 'default',
    'profile' => 'primary',
];

?>
<div class="well well-sm">
    <div class="pull-right">
        <span class="label label-primary"><?= $model->session_id ?></span>
        <span class="label label-success"><?= $model->user_id ?></span>
    </div>
    <?= $model->index ?> <b><?= $model->date ?></b>
    <span class="label label-<?= $levelClass[$model->level] ?>"><?= $model->level ?></span>
    <span class="label label-default"><?= $model->category ?></span>
    <?=Yii::$app->formatter->asRelativeTime(strtotime($model->date))?>
    <div>
        <div style="display: none;" class="text">
            <?= $model->highlight($model->text) ?>
        </div>
        <p style="word-break:break-word;" onclick="$('.modal-body').html($(this).parent().find('.text').html());$('.modal').modal('show');"><?= $model->highlight($model->firstLine) ?></p>

    </div>
</div>