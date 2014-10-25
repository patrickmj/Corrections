<?php
class Corrections_Form_Correction extends Omeka_Form
{
    protected $els;
    protected $item;
    
    public function init()
    {
        parent::init();
        foreach ($this->els as $element) {
            $this->view->elementForm($element);
        }
            
        $this->addElement('Text', 'foo');
    }
    
    public function setEls($elements)
    {
        $this->els = $elements;
    }
    
    public function setItem($item)
    {
        $this->item = $item;
    }
}