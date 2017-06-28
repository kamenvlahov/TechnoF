<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\contractForm;

/**
 * ContractController
 *
 * @author
 *
 * @version
 *
 */
class ContractController extends AbstractActionController
{
    /**
     * Договори със следните данни:

        a. Тип
        
        i. аренда
        
        ii. собственост
        
        b. Начална дата
        
        c. Крайна дата
        
        d. Рента на декар - ако договорът е тип аренда
        
        e. Цена - за която е бил сключен договора за собственост.
     */
    public function indexAction()
    {
        $map=$this->getServiceLocator()->get('adminMap');
        $data=$map->selectContaracts();
        return new ViewModel(array('data'=>$data));
    }
    public function addAction()
    {
        $form    =  new contractForm('contractForm');
        $request =  $this->getRequest();
        $map=$this->getServiceLocator()->get('adminMap');
        if ($request->isPost()){
            $post=$request->getPost();
            $form->setData($post);
            if ($form->isValid()){
                $data=$form->getData();
                $id=$map->insertContract($data);
                if ($id)
                return $this->redirect()->toRoute('Contract',array('action'=>'view','id'=>$id));
            }
        }
        return new ViewModel(array('form'=>$form));
    }
    public function editAction()
    {
        $contractId     =   $this->params('id');
        $form           =   new contractForm('contractForm');
        $map            =   $this->getServiceLocator()->get('adminMap');
        $ContractData   =   $map->selectContaracts($contractId);
        $form->setData($ContractData);
        
        $request =  $this->getRequest();
        if ($request->isPost()){
            $post=$request->getPost();
            $form->setData($post);
            if ($form->isValid()){
                $data=$form->getData();
                $map->updateContract($data);
                return $this->redirect()->toRoute('Contract',array('action'=>'view','id'=>$data['id']));
            }
        }
        
         return new ViewModel(array('ContractData'=>$ContractData,'form'=>$form));
    }
    public function viewAction()
    {
        $contractId     = $this->params('id');
        $map            = $this->getServiceLocator()->get('adminMap');
        $contractInfo   = $map->selectContaracts($contractId);
        $propertyData   = $map->propertyInfo(array('ctr_id'=>$contractId));
        
        return new ViewModel(array('contractInfo'=>$contractInfo,'propertyData'=>$propertyData));
    }
}