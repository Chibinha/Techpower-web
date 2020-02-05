<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\components\Helper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        echo '<ul class="navbar-nav navbar-right col-"><li><form action="/site/search" method="get" class="navbar-form navbar-left" role="search">
            <div class="form-group">
                <input name="query" type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </form>';

        $menuItems = [
            ['label' => '<span class="glyphicon glyphicon-home"></span> &ensp; Página Inicial', 'url' => ['/site/index']],
            [
                'label' => '<span class="glyphicon glyphicon-align-justify"></span> &ensp; Categorias',
                'items' => Helper::getCategories(),
            ],
            ['label' => '<span class="glyphicon glyphicon-shopping-cart"></span> &ensp; Carrinho', 'url' => ['/site/cart']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Registar', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = [
                'label' => '<span class="glyphicon glyphicon-user"></span> &ensp; A minha conta',
                'items' => [
                    [
                        'label' => '<span class="glyphicon glyphicon-info-sign"></span> &ensp; Informações da Conta',
                        'url' => ['/user/update', 'id' => Helper::getLoggedUser()],
                    ],
                    [
                        'label' => '<span class="glyphicon glyphicon-gift"></span> &ensp; Encomendas',
                        'url' => ['/sale/index', 'id' => Helper::getLoggedUser()],
                    ],
                    [
                        'label' => '<span class="glyphicon glyphicon-remove"></span> &ensp; Logout',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
                ],
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'encodeLabels' => false,
            'items' => $menuItems,
        ]);
        echo '</li></ul>';
        NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>