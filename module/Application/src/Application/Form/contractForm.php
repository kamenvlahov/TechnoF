<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;


/**
 * {0}
 * 
 * @author
 * @version 
 */
class contractForm extends Form implements InputFilterProviderInterface
{
	/**
	 * The default action - show the home page
	 */
 public function __construct($name=NULL){
        
        parent::__construct('formid');
        
        
        $this->setAttribute('method', 'POST');
        $this->setAttribute('action', '');
        $this->setAttribute('id', 'formid');
        $this->add(array(
            'name'=>'id',
            'type'=>'hidden',
            'options'=>array(
            ),
            'attributes'=>array(
                'id'=>'id',
            )
        ));
        $this->add(array(
            'name'=>'type',
            'type'=>'select',
            'options'=>array(
                'label'=>'Тип на договора',
                'value_options'=>array(
                    'rent'=>'аренда',
                    'ounership'=>'собственост'
                )
            ),
            'attributes'=>array(
                //'class'=>'browser-default',
                'onchange'=>'function type()'
            )
        ));
        $this->add(array(
            'name'=>'start_date',
            'type'=>'date',
            'options'=>array(
                'label'=>'Начална дата'
            ),
            'attributes'=>array(
                 'class'=>'datepicker',
            )
        ));
        $this->add(array(
            'name'=>'end_date',
            'type'=>'date',
            'options'=>array(
                'label'=>'Крайна дата'
            ),
            'attributes'=>array(
                'class'=>'datepicker',
            )
        ));
        $this->add(array(
            'name'=>'rent',
            'type'=>'number',
            'options'=>array(
                'label'=>'Рента на декар - ако договорът е тип аренда'
            ),
            'attributes'=>array(
                'id'=>'rent',
            )
        ));
        $this->add(array(
            'name'=>'price',
            'type'=>'number',
            'options'=>array(
                'label'=>'Цена - за която е бил сключен договора за собственост.'
            ),
            'attributes'=>array(
                'id'=>'price',
            )
        ));
        $this->add(array(
            'name'=>'csrf',
            'type'=>'csrf',
        ));
        $this->add(array(
            'name'=>'submit',
            'type'=>'submit',
            'options'=>array(
            ),
            'attributes'=>array(
            )
        ));
    }
public function getInputFilterSpecification()
    {
        return array(
            array(
                'name'=>'csrf',
                'validators' => array (
                    array(
                        'name' => 'csrf'
                    )
                )
            ),
        );
    }
}
