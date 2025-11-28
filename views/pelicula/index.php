<?php

use app\models\Pelicula;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\PeliculaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Peliculas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelicula-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- BOTÓN CREAR SOLO PARA ADMIN -->
    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
        <?= Html::a('Create Pelicula', ['create'], ['class' => 'btn btn-success']) ?>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'   => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'portada',
                'format'    => 'html',
                'value'     => function (Pelicula $model) {
                    if ($model->portada)
                        return Html::img(Yii::getAlias('@web') . '/portadas/' . $model->portada, ['style' => 'width: 50px']);
                    return null;
                }
            ],

            'titulo',
            'sinopsis',
            'anio',

            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Pelicula $model, $key, $index) {
                    return Url::toRoute([$action, 'idpelicula' => $model->idpelicula]);
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
