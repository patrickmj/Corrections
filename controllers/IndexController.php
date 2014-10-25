<?php
class Corrections_IndexController extends Omeka_Controller_AbstractActionController
{

    public function init()
    {
        $this->_helper->db->setDefaultModelName('CorrectionsCorrection');
    }

    public function addAction()
    {
        require CORRECTIONS_DIR . '/forms/Correction.php';
        $this->view->addHelperPath(CORRECTIONS_DIR . '/helpers', 'Corrections_View_Helper_');
        $itemId = $this->getParam('item_id');
        $item = $this->_helper->db->getTable('Item')->find($itemId);
        $this->view->item = $item;
        $elements = $this->getElements();
        $this->view->elements = $elements;
        $captcha = Omeka_Captcha::getCaptcha();
        $this->view->captchaScript = $captcha->render(new Zend_View);
        $csrf = new Omeka_Form_SessionCsrf;
        $this->view->csrf = $csrf;
        parent::addAction();
    }

    public function correctAction()
    {
        $id = $this->getParam('id');
        $correction = $this->_helper->db->getTable('CorrectionsCorrection')->find($id);
        $item = $correction->getItem();
        $item->setReplaceElementTexts(false);
        $view = get_view();
        $elTexts = $view->allElementTexts($correction, array('return_type' => 'array'));
        //the array just gives the text, not the array that goes into setting element texts
        $elTexts = $this->reformatElTexts($elTexts);
        print_r($elTexts);
        $item->addElementTextsByArray($elTexts);
        $item->save();
        $correction->status = 'reviewed';
        $correction->reviewed = date('Y-m-d H:i:s');
        $correction->save();
        $this->_helper->flashMessenger(__("Thank you for the correction. It is under review."), 'success');
        $this->_helper->redirector->gotoUrl("items/show/{$correction->item_id}");
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

    protected function reformatElTexts($elTexts)
    {
        foreach ($elTexts as $elSet => $elements) {
            foreach ($elements as $element => $texts) {
                foreach ($texts as $index => $text) {
                    $elTexts[$elSet][$element][$index] = array(
                            'text' => $text,
                            'html' => false
                            );
                }
            }
        }
        return $elTexts;
    }
    
    protected function validateCaptcha() {
        // ReCaptcha ignores the first argument.
        if ($this->captcha and !$this->captcha->isValid(null, $_POST)) {
            $this->_helper->flashMessenger(__('Your CAPTCHA submission was invalid, please try again.'), 'error');
            return false;
        }
    }

    protected function _redirectAfterAdd($record)
    {
       $this->_helper->redirector->gotoUrl("items/show/{$record->item_id}");
    }
}