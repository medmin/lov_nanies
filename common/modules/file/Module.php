<?php

namespace common\modules\file;


class Module extends \yii\base\Module
{


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        // custom initialization code goes here
        $this->controllerNamespace = 'common\modules\file\controllers';
    }
}
