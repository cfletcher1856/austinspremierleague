<?php

class DefaultController extends PortalController
{
	public function actionIndex()
	{
        $data = Widget::getWidgetData();
        // echo "<pre>";print_r($data);echo "</pre>";
		$this->render('index', array(
            'data' => $data
        ));
	}
}
