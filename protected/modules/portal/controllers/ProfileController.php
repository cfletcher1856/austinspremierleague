<?php

class ProfileController extends PortalController
{
    public function actionIndex()
    {
        $player = Yii::app()->user->getUser();
        $profile = $player->profile;

        if(isset($_POST['Player']))
        {
            $player->attributes=$_POST['Player'];
            if($player->save()){
                Yii::app()->user->setFlash('success', 'Profile Updated');
                $this->redirect(array('//portal'));
            }
        }

        if(isset($_POST['Profile']))
        {
            $profile->attributes=$_POST['Profile'];
            if($profile->save()){
                Yii::app()->user->setFlash('success', 'Profile Updated');
                $this->redirect(array('//portal'));
            }
        }

        $this->render('index', array(
            'player' => $player,
            'profile' => $profile
        ));
    }
}
