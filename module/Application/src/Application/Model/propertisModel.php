<?php
namespace Application\Model;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Sql\Expression;

class propertisModel extends AbstractActionController
{
    public function selectContaracts(){
        $map=$this->getServiceLocator()->get('dbHelper');
        $select=$map->getInst()->select(array('po'=>'property_ouner'));
        $select->columns([
            '*'
        ]);
        
         $select->join(array('p'=>'property'),"po.property_id=p.unic_id",array('area'),'left');
         $select->join(array('cp'=>'contract_property'),"cp.property_id=p.unic_id",array('ctr_id'),'left');
         $select->join(array('c'=>'contracts'),"cp.ctr_id=c.contract_id",array('type','rent','start_date','end_date'),'left');
         $select->join(array('o'=>'ouner'),"o.ouner_id=po.ouner_id",array('name','egn'),'left');
         $select->where->equalTo('c.type','rent');
        // $select->where->equalTo('po.ouner_id','2');
        //$select->where->equalTo();
        //$select->group(array('ouner_id'));
        $recordSet=$map->getResultSetFromSelect($select);
        
        return $recordSet;
    }
    public function selectPropertis(){
        $map=$this->getServiceLocator()->get('dbHelper');
        $select=$map->getInst()->select(array('cp'=>'contract_property'));
        $select->columns([
            '*'
        ]);
        $select->join(array('c'=>'contracts'),"cp.ctr_id=c.contract_id",array('type','price','start_date'),'left');
        $select->join(array('p'=>'property'),"cp.property_id=p.unic_id",array('area'),'left');
        $select->where->equalTo('type','ownership');
        $recordSet=$map->getResultSetFromSelect($select);
    
        return $recordSet;
    }
}
?>