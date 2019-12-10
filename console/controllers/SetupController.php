<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class SetupController extends Controller
{
    public function actionInit()
    {
        if (!file_exists(Yii::getAlias('@frontend') . '/web/images/')) {
            if (mkdir(Yii::getAlias('@frontend') . '/web/images/')) {
                echo "Pasta criada\n";
            } else {
                echo "Erro ao criar pasta";
            }
        }
    }
}
