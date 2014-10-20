<?php
class Corrections_IndexController extends Omeka_Controller_AbstractActionController
{
    
    public function init()
    {
        $this->_helper->db->setDefaultModelName('CorrectionsCorrection');
    }
    
    public function addAction()
    {
        $this->view->addHelperPath(CORRECTIONS_DIR . '/helpers', 'Corrections_View_Helper_');
        $itemId = $this->getParam('item_id');
        $item = $this->_helper->db->getTable('Item')->find($itemId);
        $this->view->item = $item;
        
        $this->view->elements = $this->getElements();
        parent::addAction();
    }

    
    public function correctAction()
    {
        $correction = $this->_helper->db->getTable('CorrectionsCorrection')->find();
        $elTexts = $correction->getAllElementTexts();
    }
    
    protected function getElements()
    {
        $elements = array();
        $elTable = $this->_helper->db->getTable('Element');
        $correctableElements = json_decode(get_option('corrections_elements'), true);
        foreach ($correctableElements as $elSet=>$els) {
            foreach ($els as $elName) {
                $el = $elTable->findByElementSetNameAndElementName($elSet, $elName);
                $elements[$el->id] = $el;
            }
        }
        return $elements;
    }
    
    protected function _redirectAfterAdd($record)
    {
       // $this->_helper->redirector('browse');
       $this->_helper->redirector->gotoUrl('items/show/2906');
    }    
}