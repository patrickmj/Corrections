<?php

class Mixin_CorrectionsElementText extends Mixin_ElementText
{
    

    private static $_elementsByRecordType = array();
        

    
    public function getElementById($elementId)
    {
        $this->loadElementsAndTexts(true);
        
        if (!array_key_exists($elementId, $this->_elementsById)) {
            throw new Omeka_Record_Exception(__("Cannot find an element with an ID of '%s'!", $elementId));
        }
        
        return $this->_elementsById[$elementId];
    }
    
    
    private function _getElementRecords()
    {
        $recordTypeName = 'CorrectionsCorrection';
        $elementTable = $this->_record->getTable('Element');
        $select = $elementTable->getSelect();
        $select->where('element_sets.record_type = ? OR element_sets.record_type IS NULL OR element_sets.record_type = "Item Type Metadata"', $recordTypeName);
        $select->order('elements.element_set_id ASC');
        $select->order('ISNULL(elements.order)');
        $select->order('elements.order ASC');
        
        $result = $elementTable->fetchObjects($select);
        return $result;
        //$this->orderElements($select);
        
        //return $this->_record->getTable('Element')->findByRecordType($this->_getRecordType());
    }
    
    public function loadElementsAndTexts($reload = true)
    {
        /*
        if ($this->_recordsAreLoaded and !$reload) {
            return;
        }
        */
        $elementTextRecords = $this->_getElementTextRecords();
        
        $this->_textsByNaturalOrder = $elementTextRecords;
        $this->_textsByElementId = $this->_indexTextsByElementId($elementTextRecords);        
        $this->_loadElements($reload);
        $this->_recordsAreLoaded = false;
    }
    
    private function _getElementTextRecords()
    {
        return $this->_record->getTable('ElementText')->findByRecord($this->_record);
    }
    
    private function _indexTextsByElementId($textRecords)
    {
        $indexed = array();
        foreach ($textRecords as $textRecord) {
            $indexed[$textRecord->element_id][] = $textRecord;
        }
        
        return $indexed;
    }
    
    private function _loadElements($reload = true)
    {
        $recordType = $this->_getRecordType();
        if (!array_key_exists($recordType, self::$_elementsByRecordType) || $reload) {
            $elements = $this->_getElementRecords();
            self::$_elementsByRecordType[$recordType] = $elements;
        } else {
            $elements = self::$_elementsByRecordType[$recordType];
        }

        $this->_elementsBySet = $this->_indexElementsBySet($elements);
        $this->_elementsById = $this->_indexElementsById($elements);
    }
    
    private function _getRecordType()
    {
        return get_class($this->_record);
    }
    
    private function _indexElementsBySet(array $elementRecords)
    {
        $indexed = array();
        foreach($elementRecords as $record) {
            $indexed[$record->set_name][$record->name] = $record;
        }
        return $indexed;        
    }
    
    private function _indexElementsById(array $elementRecords)
    {
        $indexed = array();
        foreach($elementRecords as $record) {
            $indexed[$record->id] = $record;
        }
        return $indexed;
    }
    
}
