<p>Check the metadata fields that you want to make correctable by the public.</p>
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

if (get_option('show_element_set_headings') ) {
    foreach($data as $elSet=>$options) {
        echo "<div class='field'>";
        echo "<h2>$elSet</h2>";
        echo $view->formMultiCheckbox('element_sets', $values, null, $options, '');
        echo "</div>";
    }
} else {
    foreach($data as $elSet=>$options) {
        echo "<div class='field'>";
        echo $view->formMultiCheckbox('element_sets', $values, null, $options, '');
        echo "</div>";
    }
}
