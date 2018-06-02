<?php

namespace frontend\modules\pay;


class Module extends \yii\base\Module
{

    public function init()
    {
        parent::init();
        $this->controllerNamespace = 'frontend\modules\pay\controllers';
        
    }
}
