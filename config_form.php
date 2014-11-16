<div class="field">
    <div class="two columns alpha">
        <label><?php echo __('Email'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation"><?php echo __('Email address to be notified about corrections (defaults to site admin)'); ?></p>
        <div class="input-block">
        <input type='text' value='<?php echo get_option('corrections_email'); ?>' name='corrections_email' />
        </div>
    </div>
</div>

<div class="field">
    <div class="two columns alpha">
        <label><?php echo __('Default text'); ?></label>    
    </div>
    <div class="inputs five columns omega">
        <p class="explanation"><?php echo __('Text for invitation to suggesting a correction'); ?></p>
        <div class="input-block">
        <input type='text' value='<?php echo get_option('corrections_text'); ?>' name='corrections_text' />
        </div>
    </div>
</div>

<p><?php echo __('Check the metadata fields that you want to make correctable by the public.'); ?></p>
<?php
$elTable = get_db()->getTable('Element');
$data = $elTable->findPairsForSelectForm();
$view = get_view();
$correctableElements = json_decode(get_option('corrections_elements'), true);

$values = array();
if(is_array($correctableElements)) {
    foreach($correctableElements as $elSet=>$elements) {
        foreach($elements as $element) {
            $elObject = $elTable->findByElementSetNameAndElementName($elSet, $element);
            $values[] = $elObject->id;
        }
    }
}

?>
<?php 
if (get_option('show_element_set_headings') ) {
    foreach($data as $elSet=>$options) {
        echo "<div class='field'>";
        echo "<h2>$elSet</h2>";
        echo $view->formMultiCheckbox('element_sets', $values, null, $options, '');
        echo "</div>";
    }
} else {
    echo "<div class='field no-headings'>";
    echo $view->formMultiCheckbox('element_sets', $values, null, $data, '');
    echo "</div>";
}
