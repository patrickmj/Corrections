<?php

queue_css_string('input.add-element {display: none;}');
echo head();

?>

<?php 
//echo $form;
?>
<?php echo flash(); ?>

<form method='post'>

<?php 
foreach ($elements as $element) {
    echo $this->elementForm($element, $corrections_correction);
}
?>


<div class="field">
    <div class="two columns alpha">
        <label for='comment'>Comments</label>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation"></p>
        <div class="input-block">
            <textarea cols='50' rows='3' name='comment'></textarea>
        </div>
    </div>
</div>

<?php 
echo $captchaScript;
echo $this->formSubmit('submit', __('Submit Correction'));
?>

<input type='hidden' name='item_id' value='<?php echo $item->id; ?>' />
</form>
<?php echo foot(); ?>