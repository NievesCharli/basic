<?php

use app\models\Genero;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\GeneroSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Generos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genero-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- ❗ Botón crear solo para admin -->
    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
        <?= Html::a(Yii::t('app', 'Create Genero'), ['create'], ['class' => 'btn btn-success']) ?>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idcategoria',
            'nombre',
            'descripcion',

            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Genero $model, $key, $index) {
                    return Url::toRoute([$action, 'idcategoria' => $model->idcategoria]);
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
