<?php
namespace Application\Model;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Sql\Expression;

class adminModel extends AbstractActionController
{
    public function selectContaracts($id=NULL){
        $map=$this->getServiceLocator()->get('dbHelper');
        $select=$map->getInst()->select('contracts');
        if ($id){
            $select->where->equalTo('contract_id',$id);
            $recordSet=$map->getRowFromSelect($select);
        }else{
            $recordSet=$map->getResultSetFromSelect($select);
        }
        return $recordSet;
    }
    public function contractInfo($filter=null){
        $map=$this->getServiceLocator()->get('dbHelper');
        $select=$map->getInst()->select(array('cp'=>'contract_property'));
        $select->join(array('c'=>'contracts'),"cp.contract_id=c.contract_id",array('price','start_date','end_date'),'left');
        $select->join(array('p'=>'property'),"cp.property_id=p.unic_id",array('unic_id','area'),'left');
    
        if ($filter){
            foreach ($filter as $key=>$filter){
                $select->where->equalTo($key,$filter);
            }
            $recordSet=$map->getResultSetFromSelect($select);
        }else{
            $recordSet=$map->getResultSetFromSelect($select);
        }
    
        return $recordSet;
    }
    public function insertContract($data){
        $map=$this->getServiceLocator()->get('dbHelper');
        if(!count($data))return null;
    
        $insertdata['type']         = $data['type'];
        $insertdata['start_date']   = $data['start_date'];
        $insertdata['end_date']     = $data['end_date'];
        $insertdata['rent']         = (is_int($data['rent']))?$data['rent']:0;
        $insertdata['price']        = (is_int($data['price']))?$data['price']:0;
    
        $insert     =   $map->getInst()->insert('contracts')
        ->values($insertdata);
        $statement  =   $map->getInst()->prepareStatementForSqlObject($insert);
        $general_id =   $statement->execute()->getGeneratedValue();
        return $general_id;
    }
    public function updateContract($data){
        $map=$this->getServiceLocator()->get('dbHelper');
        if(!count($data))return null;
        $updateDataId               = $data['id'];
        $updateData['type']         = $data['type'];
        $updateData['start_date']   = $data['start_date'];
        $updateData['end_date']     = $data['end_date'];
        $updateData['rent']         = $data['rent'];
        $updateData['price']        = $data['price'];
    
        $update=$map->getInst()->update('contracts')
        ->set($updateData);
        $update->where->equalTo('id', $updateDataId);
        $statement=$map->getInst()->prepareStatementForSqlObject($update);
        $result=$statement->execute();
    }
    
    public function selectProperty($id=NULL){
        $map=$this->getServiceLocator()->get('dbHelper');
        $select=$map->getInst()->select(array('cp'=>'contract_property'));
        $select->join(array('c'=>'contracts'),"cp.ctr_id=c.contract_id",array('price','start_date','end_date','type'),'left');
        $select->join(array('p'=>'property'),"cp.property_id=p.unic_id",array('*'),'left');
        if ($id){
            $select->where->equalTo('property_id',$id);
            $recordSet=$map->getRowFromSelect($select);
        }else{
            $recordSet=$map->getResultSetFromSelect($select);
        }
        return $recordSet;
    }
    public function propertyInfo($filter=null,$type=null){
        $map=$this->getServiceLocator()->get('dbHelper');
        $select=$map->getInst()->select(array('cp'=>'contract_property'));
        $select->join(array('c'=>'contracts'),"cp.ctr_id=c.contract_id",array('price','start_date','end_date'),'left');
        $select->join(array('p'=>'property'),"cp.property_id=p.unic_id",array('*'),'left');
    
        if ($filter){
            foreach ($filter as $key=>$filter){
                $select->where->equalTo($key,$filter);
            }
            //$select->where->lessThanOrEqualTo('end_date',date('Y-m-d'));
        }
        if ($type) return $recordSet=$map->getRowFromSelect($select);
    
        return $map->getResultSetFromSelect($select);
    }
    
    public function insertProperty($data){
        $map=$this->getServiceLocator()->get('dbHelper');
        if(!count($data))return null;
        
        $insertdata['unic_id']      = $data['unic_id'];
        $insertdata['area']         = $data['area'];
    
        $insert     =   $map->getInst()->insert('property')
        ->values($insertdata);
        $statement  =   $map->getInst()->prepareStatementForSqlObject($insert);
        $id =   $statement->execute()->getGeneratedValue();
        if ($id)
        $asign_id=$this->asignProperty($data);
        if ($asign_id)
        return $asign_id;
        
    }
    public function asignProperty($data){
        
        $map=$this->getServiceLocator()->get('dbHelper');
        if(!count($data))return null;
    
        $insertdata['ctr_id']         = $data['contract_id'];
        $insertdata['property_id']         = $data['unic_id'];
    
        $insert     =   $map->getInst()->insert('contract_property')
        ->values($insertdata);
        $statement  =   $map->getInst()->prepareStatementForSqlObject($insert);
        $general_id =   $statement->execute()->getGeneratedValue();
        return $data['unic_id'];
    }
    /* public function getProperty($filter=null,$type=null){
        $map=$this->getServiceLocator()->get('dbHelper');
        $select=$map->getInst()->select(array('cp'=>'contract_property'));
    
        if ($filter){
            foreach ($filter as $key=>$filter){
                $select->where->equalTo($key,$filter);
            }
        }
        if ($type) return $recordSet=$map->getRowFromSelect($select);
    
        return $map->getResultSetFromSelect($select);
    } */
    public function selectOuner($filter=null,$type=null){
        $map=$this->getServiceLocator()->get('dbHelper');
        $select=$map->getInst()->select(array('o'=>'ouner'));
        $select->join(array('po'=>'property_ouner'),"po.ouner_id=o.ouner_id",array('part','property_id'));
        $select->group('name');
        if ($filter){
            foreach ($filter as $key=>$filter){
                
                if ($key=='property_id'){
                    $select->where->notEqualTo($key,$filter);
                }else{
                    $select->where->equalTo($key,$filter);
                }
            }
        }
        $select->group('ouner_id');
        if ($type)
            return $map->getRowFromSelect($select);
    
            return $map->getResultSetFromSelect($select);
    }
    public function ounerInfo($filter=null,$type=null){
        $map=$this->getServiceLocator()->get('dbHelper');
        $select=$map->getInst()->select(array('o'=>'ouner'));
        $select->join(array('po'=>'property_ouner'),"po.ouner_id=o.ouner_id",array('part','property_id'));
        $select->group('name');
        if ($filter){
            foreach ($filter as $key=>$filter){
                $select->where->equalTo($key,$filter);
            }
        }
        if ($type)
            return $map->getRowFromSelect($select);
        
        return $map->getResultSetFromSelect($select);
    }
    public function insertOuner($data){
        $map=$this->getServiceLocator()->get('dbHelper');
        if(!count($data))return null;
    
        $insertdata['name']         = $data['name'];
        $insertdata['egn']          = $data['egn'];
    
        $insert     =   $map->getInst()->insert('property')
        ->values($insertdata);
        $statement  =   $map->getInst()->prepareStatementForSqlObject($insert);
        $id =   $statement->execute()->getGeneratedValue();
        if ($id)
            $asign_id=$this->asignProperty($data);
            if ($asign_id)
                return $asign_id;
    
    }
    public function asignOuner($data){
    
        $map=$this->getServiceLocator()->get('dbHelper');
        if(!count($data))return null;
    
        $insertdata['property_id']          = $data['property_id'];
        $insertdata['ouner_id']             = $data['ouner_id'];
        $insertdata['part']                 = $data['part'];
    
        $insert     =   $map->getInst()->insert('property_ouner')
        ->values($insertdata);
        $statement  =   $map->getInst()->prepareStatementForSqlObject($insert);
        $general_id =   $statement->execute()->getGeneratedValue();
        return $data['property_id'];
    }
}
?>