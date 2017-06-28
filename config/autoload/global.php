<?php

use Application\Form\propertyForm;
use Zend\Db\Adapter\Adapter;

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
        'controllers'       => include __DIR__ . '/controller.config.php' ,
        'router'            => array('routes' => include __DIR__ . '/route.config.php'),
        'service_manager' => array(
          'factories' => array(
            'db_adapter' =>  function($serviceManager) {
                
            $config = $serviceManager->get('Configuration');
            $dbAdapter = new Adapter($config['db']);
            return $dbAdapter;
            },
            'propertyForm'=>function($serviceManager) {
            $form = new propertyForm('propertyForm',$serviceManager->get('db_adapter'));
            return $form;
            }
        ),
          'invokables'=>array(
                'DbHelper'=>'Application\Model\dbHelper',
                'adminMap'=>'Application\Model\adminModel',
                'propertisMap'=>'Application\Model\propertisModel',
            )
         ),
        'module_layouts' => array(
            'Application' 	=> 'layout/layout.phtml',
        ),
);
