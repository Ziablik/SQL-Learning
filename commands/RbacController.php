<?php
/**
 * Created by PhpStorm.
 * User: Ziablik
 * Date: 31.01.2019
 * Time: 19:18
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "createQuest"
        $createQuest = $auth->createPermission('createQuest');
        $createQuest->description = 'Create a quest';
        $auth->add($createQuest);

        // добавляем разрешение "completeQuest"
        $completeQuest = $auth->createPermission('completeQuest');
        $completeQuest->description = 'Complete the quest';
        $auth->add($completeQuest);

        // добавляем роль "student" и даём роли разрешение "createQuest"
        $student = $auth->createRole('student');
        $auth->add($student);
        $auth->addChild($student, $completeQuest);

        // добавляем роль "teacher" и даём роли разрешение "createQuest"
        // а также все разрешения роли "student"
        $teacher = $auth->createRole('teacher');
        $auth->add($teacher);
        $auth->addChild($teacher, $createQuest);
        $auth->addChild($teacher, $student);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($student, 2);
        $auth->assign($teacher, 1);
    }
}