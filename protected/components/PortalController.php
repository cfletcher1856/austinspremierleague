<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class PortalController extends CController
{
        /**
         * @var mixed the default tooltip for every controller.
         * if you give to this parameter a boolean false value instead of an array,
         * the controller will not be displayed in the permission menagement view.
         * for more information view the documentation in the userGroups module.
         */
        public static $_permissionControl = array('read' => false, 'write' => false, 'admin' => false);
        /**
         * @var string the default layout for the controller view. Defaults to '//layouts/column1',
         * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
         */
        public $layout='//layouts/portal';
        /**
         * @var array context menu items. This property will be assigned to {@link CMenu::items}.
         */
        // public $menu=array();
        public $menu=array(
            array('label' => 'Actions'),
            array('label'=>'My Profile', 'icon' => 'user','url'=>array('//portal/profile')),
            array('label'=>'Players Contact', 'icon' => 'phone','url'=>array('//portal/contact')),
            array('label'=>'Division 1 Scoresheet', 'icon' => 'file-alt','url'=>array('//scoresheets/division1.pdf'), 'linkOptions' => array('target'=>'_blank')),
            array('label'=>'Division 2 Scoresheet', 'icon' => 'file-alt','url'=>array('//scoresheets/division2.pdf'), 'linkOptions' => array('target'=>'_blank')),
            array('label'=>'Division 3 Scoresheet', 'icon' => 'file-alt','url'=>array('//scoresheets/division3.pdf'), 'linkOptions' => array('target'=>'_blank')),
        );
        /**
         * @var array the breadcrumbs of the current page. The value of this property will
         * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
         * for more details on how to specify this property.
         */
        public $breadcrumbs=array();

        public $page_header;
        public $sub_header;
}
