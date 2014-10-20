<?php
class CorrectionsCorrection extends Omeka_Record_AbstractRecord
{
    public $added;
    public $corrected;
    public $item_id;
    public $comment;
    
    public function _initializeMixins()
    {
        $this->_mixins[] = new Mixin_Timestamp($this, 'added', null);
        $this->_mixins[] = new Mixin_Timestamp($this, 'corrected', null);
        $this->_mixins[] = new Mixin_ElementText($this);
        $this->_mixins[] = new Mixin_Search($this);
    }
    
    public function getItem()
    {
        return $this->getDb()->getTable('Item')->find($this->item_id);
    }
    
    protected function beforeSave($args)
    {
        if ($args['post']) {
            $post = $args['post'];
            $this->beforeSaveElements($post);
        }
    }
}