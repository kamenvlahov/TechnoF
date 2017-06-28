<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\ounerForm;

/**
 * ContractController
 *
 * @author
 *
 * @version
 *
 */
class OunerController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        $map=$this->getServiceLocator()->get('propertisMap');
        $info=$map->selectContaracts('rent');
        return new ViewModel(array(
            'data'=>$info
        ));
        
    }
    public function addAction()
    {
        $propertyId=$this->params('id');
        $form = new ounerForm();
        
        $request =  $this->getRequest();
        if ($request->isPost()){
            $post=$request->getPost();
            $form->setData($post);
            if ($form->isValid()){
                $data=$form->getData();
                $data['type']=$contractInfo['type'];
                $id=$map->insertOuner($data);
                if ($id)
                    return $this->redirect()->toRoute('Ouner',array('action'=>'index','id'=>$contractId));
            }
        }
        return new ViewModel(array('form'=>$form));
    }
}