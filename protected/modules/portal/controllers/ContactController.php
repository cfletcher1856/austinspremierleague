<?php

class ContactController extends PortalController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Player', array(
            'criteria' => array(
                'condition' => "active = 1",
                'order' => 'l_name',
            ),
            'pagination' => array(
                'pageSize' => 30,
            )
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider
        ));
    }
}
