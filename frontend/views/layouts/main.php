<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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

    ?>
    <form class="navbar-form navbar-left" action="/action_page.php">
        <div class="form-group has-feedback search">
            <input type="text" class="form-control" placeholder="Procurar..." />
            <i class="glyphicon glyphicon-search form-control-feedback"></i>
        </div>
    </form>   
    <?php

    $menuItems = [        
        ['label' => '<span class="glyphicon glyphicon-home"></span> &ensp; Página Inicial', 'url' => ['/site/index']],
        ['label' => '<span class="glyphicon glyphicon-align-justify"></span> &ensp; Categorias',
        'items' => [
            [
                'label' => 'Categoria 1',
                'url' => ['/site/userpage'],
            ],  
            [
                'label' => 'Categoria 2',
                'url' => ['/site/userpage'],
            ],  
            [
                'label' => 'Categoria 3',
                'url' => ['/site/userpage'],
            ],  
            [
                'label' => 'Categoria 4',
                'url' => ['/site/userpage'],
            ],  
            [
                'label' => 'Categoria 5',
                'url' => ['/site/userpage'],
            ],  
            [
                'label' => 'Categoria 6',
                'url' => ['/site/userpage'],
            ], 
        ],
    ],
        ['label' => '<span class="glyphicon glyphicon-shopping-cart"></span> &ensp; Carrinho', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => '<span class="glyphicon glyphicon-user"></span> &ensp; A minha conta',
            'items' => [
                [
                    'label' => '<span class="glyphicon glyphicon-list"></span> &ensp; Painel da Conta',
                    'url' => ['/site/userpage'],
                ],
                [
                    'label' => '<span class="glyphicon glyphicon-info-sign"></span> &ensp; Informações da Conta',
                    'url' => ['/site/index'],
                ],
                [
                    'label' => '<span class="glyphicon glyphicon-home"></span> &ensp; Endereços',
                    'url' => ['/site/index'],
                ],
                [
                    'label' => '<span class="glyphicon glyphicon-gift"></span> &ensp; Encomendas',
                    'url' => ['/site/index'],
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
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
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

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
