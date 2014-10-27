<?php

//require(PLUGIN_DIR . '/Corrections/forms/Correction.php');
define('CORRECTIONS_DIR', PLUGIN_DIR . '/Corrections');

class CorrectionsPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array(
        'install',
        'uninstall',
        'public_items_show',
        'config',
        'config_form'
        );
    
    protected $_filters = array(
        'admin_navigation_main'
        );
    
    public function hookInstall($args)
    {
        $db = get_db();
        $sql = "
            CREATE TABLE IF NOT EXISTS `$db->CorrectionsCorrection` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              `reviewed` timestamp NULL,
              `item_id` int(10) NOT NULL,
              `comment` text COLLATE utf8_unicode_ci,
              `status` tinytext NULL,
              `owner_id` int(10) NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
        
        ";
        $db->query($sql);
        
        set_option(json_encode(array()));
    }
    
    public function hookUninstall($args)
    {
        
    }
    
    public function hookPublicItemsShow($args)
    {
        $item = $args['item'];
        echo self::correctionLink($item);
    }
    
    public static function correctionLink($item, $text = 'FixItFixItFixIt!')
    {
        $link = link_to('Corrections_IndexController',
                        'add',
                        'FixItFixItFixIt',
                         array(),
                         array('item_id' => $item->id)
                );
        $url = url('corrections/index/add/item_id/' . $item->id);
        return "<a href='$url'>$text</a>";
        return $link;
    }
    
    public function hookConfigForm($args)
    {
        include 'config_form.php';
    }
    
    public function hookConfig($args)
    {   
        $post = $args['post'];
        $elements = array();
        $elTable = get_db()->getTable('Element');
        foreach($post['element_sets'] as $elId) {
            $element = $elTable->find($elId);
            $elSet = $element->getElementSet();
            if(!array_key_exists($elSet->name, $elements)) {
                $elements[$elSet->name] = array();
            }
            $elements[$elSet->name][] = $element->name;
        }
        set_option('corrections_elements', json_encode($elements));
    }
    
    public function filterAdminNavigationMain($nav)
    {
        $nav['Corrections'] = array(
                'label' => __('Corrections'),
                'uri' => url('corrections',
                 array('status' => 'submitted')));
        return $nav;
    }
}