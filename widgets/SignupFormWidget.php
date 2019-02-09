<?php

namespace app\widgets;

use app\models\SignupForm;
use Yii;
use yii\base\Widget;

class SignupFormWidget extends Widget {

    public function run() {
        if (Yii::$app->user->isGuest) {
            $model = new SignupForm();
            return $this->render('signupFormWidget', [
                'model' => $model,
            ]);
        } else {
            return ;
        }
    }

}