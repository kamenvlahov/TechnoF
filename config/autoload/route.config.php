<?php
return array (
    //Application Module
		'home' => array (
				'type' => 'Segment',
				'options' => array (
						'route' => '[/][:action[/:id]]',
						'defaults' => array (
								'controller' => 'Application\Controller\Index',
								'action' => 'index' 
						) 
				) 
		),
    'Contract' => array (
        'type' => 'Segment',
        'options' => array (
            'route' => '/contract[/][:action[/:id]]',
            'defaults' => array (
                'controller' => 'Application\Controller\Contract',
                'action' => 'index'
            )
        )
    ),
    'Property' => array (
        'type' => 'Segment',
        'options' => array (
            'route' => '/property[/][:action[/:id]]',
            'defaults' => array (
                'controller' => 'Application\Controller\Property',
                'action' => 'index'
            )
        )
    ),
    'Ouner' => array (
        'type' => 'Segment',
        'options' => array (
            'route' => '/ouner[/][:action[/:id]]',
            'defaults' => array (
                'controller' => 'Application\Controller\Ouner',
                'action' => 'index'
            )
        )
    ),
    'ReportOuner' => array (
        'type' => 'Segment',
        'options' => array (
            'route' => '/admin/jsonuser.json',
            'defaults' => array (
                'controller' => 'Application\Controller\Reportcontract',
                'action' => 'add'
            )
        )
    ),
    'ReportContract' => array (
        'type' => 'Segment',
        'options' => array (
            'route' => '/admin/jsonuser.json',
            'defaults' => array (
                'controller' => 'Application\Controller\Reportcontract',
                'action' => 'add'
            )
        )
    ),
    
);