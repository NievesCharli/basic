<?php

use app\models\Actor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Actors');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="actor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create Actor'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idactor',
            'nombres',
            'apellidos',
            'biografia',

            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Actor $model) {
                    return Url::toRoute([$action, 'idactor' => $model->idactor]);
                },
                'visibleButtons' => [
                    'view' => function () {
                        $role = Yii::$app->user->identity->role ?? null;
                        return $role === 'user' || $role === 'admin';
                    },
                    'update' => function () {
                        $role = Yii::$app->user->identity->role ?? null;
                        return $role === 'admin';
                    },
                    'delete' => function () {
                        $role = Yii::$app->user->identity->role ?? null;
                        return $role === 'admin';
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
