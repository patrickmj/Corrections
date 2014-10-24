<?php
class CorrectionsCorrection extends Omeka_Record_AbstractRecord
{
    public $added;
    public $reviewed;
    public $item_id;
    public $comment;
    public $status;
    public $owner_id;
    
    public function _initializeMixins()
    {
        $this->_mixins[] = new Mixin_Timestamp($this, 'added', null);
        $this->_mixins[] = new Mixin_ElementText($this);
        $this->_mixins[] = new Mixin_Search($this);
        $this->_mixins[] = new Mixin_Owner($this);
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
        
        if (!$this->status) {
            $this->status = 'submitted';
        }
    }
}