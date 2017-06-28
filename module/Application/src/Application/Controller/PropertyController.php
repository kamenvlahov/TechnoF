<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\propertyForm;
use Application\Form\ounerForm;

/**
 * ContractController
 *
 * @author
 *
 * @version
 *
 */
class PropertyController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction(){
        $map=$this->getServiceLocator()->get('propertisMap');
        $info=$map->selectPropertis();
        return new ViewModel(array(
            'data'=>$info
        ));
    }
    public function addAction()
    {
        $contractId=$this->params('id');
        $map=$this->getServiceLocator()->get('adminMap');
        $form=$this->getServiceLocator()->get('propertyForm');
        $form->get('contract_id')->setValue($contractId);
        
        $contractInfo=$map->selectContaracts($contractId);
        
        if (!count($contractInfo))
            return $this->redirect()->toRoute('Contract',array('action'=>'view','id'=>$id));
        
            $request =  $this->getRequest();
            if ($request->isPost()){
                $post=$request->getPost();
                $form->setData($post);
                if ($form->isValid()){
                    $data=$form->getData();
                    $data['type']=$contractInfo['type'];
                    $id=$map->insertProperty($data);
                    if ($id){
                       if ($contractInfo['type']!='rent'){
                            return $this->redirect()->toRoute('Property',array('action'=>'index','id'=>$contractId));
                        }else{
                            return $this->redirect()->toRoute('Property',array('action'=>'view','id'=>$id));
                        }
                    }    
                }
            }
        
        return new ViewModel(array('form'=>$form,'contractInfo'=>$contractInfo));
    }
    public function viewAction()
    {
        $propertyId     = $this->params('id');
        $map            = $this->getServiceLocator()->get('adminMap');
        
            $propertyInfo   = $map->selectProperty($propertyId);
            
            if (!count($propertyInfo))
            return $this->redirect()->toRoute('Contract',array('action'=>'view','id'=>$id));
            $listOuners=null;
            $form=null;
            if ($propertyInfo['type']=='rent'){
                
                $listOuners      = $map->ounerInfo(array('property_id'=>$propertyId));
                foreach ($listOuners as $test){
                }
                
                $post=$this->params()->fromPost();
                $form=new ounerForm();
            }
            
            return new ViewModel(
                array(
                    'listOuners'     =>$listOuners,
                    'propertyInfo'   =>$propertyInfo,
                    'form'           =>$form
            ));
    }
}