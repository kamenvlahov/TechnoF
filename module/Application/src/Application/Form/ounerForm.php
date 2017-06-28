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
class ounerForm extends Form implements InputFilterProviderInterface
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
            'name'=>'name',
            'type'=>'text',
            'options'=>array(
                'label'=>''
            ),
            'attributes'=>array(
                'id'=>'name',
            )
        ));
        $this->add(array(
            'name'=>'egn',
            'type'=>'text',
            'options'=>array(
                'label'=>''
            ),
            'attributes'=>array(
                'id'=>'egn',
            )
        ));
        $this->add(array(
            'name'=>'phone',
            'type'=>'text',
            'options'=>array(
                'label'=>''
            ),
            'attributes'=>array(
                'id'=>'phone',
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
                'label'=>''
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
