<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;


/**
 * {0}
 * 
 * @author
 * @version 
 */
class propertyForm extends Form 
{
	/**
	 * The default action - show the home page
	 */
 public function __construct($name=NULL,$db=NULL){
        
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
            'name'=>'contract_id',
            'type'=>'hidden',
            'options'=>array(
            ),
            'attributes'=>array(
                'id'=>'contract_id',
            )
        ));
        $this->add(array(
            'name'=>'type',
            'type'=>'hidden',
            'options'=>array(
            ),
            'attributes'=>array(
                'id'=>'type',
            )
        ));
        $this->add(array(
            'name'=>'unic_id',
            'type'=>'text',
            'options'=>array(
            ),
            'attributes'=>array(
                'id'=>'unic_id',
            )
        ));
        $this->add(array(
            'name'=>'area',
            'type'=>'number',
            'options'=>array(
                'label'=>'Площ в декари',
            ),
            'attributes'=>array(
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
        $this->setInputFilter($this->createInputFilter($db));
    }
    public function createInputFilter($db)
    {
           $filter = new InputFilter();
           $filter->add(array(
               'name' => 'unic_id',
               'required' => true,
               'filters' => array(
                   array(
                       'name' => 'StripTags'
                   ),
               ),
               'validators' => array(
                   array(
                       'name' => 'Db\NoRecordExists',
                       'options' => array(
                           'table' => 'property',
                           'field' => 'unic_id',
                           'adapter' => $db,
                           'message'   => 'Record exist',
                       )
                   ),
           
                   array(
                       'name' => 'NotEmpty'
                   ),
               )
           ));
           $filter->add(array(
                'name' => 'csrf',
                'validators' => array(
                    array(
                        'name' => 'csrf',
                    ),
                )
            ));
            return $filter;
    }
}
