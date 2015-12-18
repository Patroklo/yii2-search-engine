<?php
/** @var \yii\data\ActiveDataProvider $dataProvider */

echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => '_listItem',
    'layout' => "{items}\n{pager}",
]) ?>
