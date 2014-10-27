<?php

queue_css_string('input.add-element {display: none;}');
echo head();

?>
<?php echo flash(); ?>

<p>
<?php echo __('You can suggest corrections to the following fields for item '); ?>
<?php echo link_to($item, 'show', metadata($item, array('Dublin Core', 'Title')) . '.' , array('target' => '_blank')); ?>
</p>
<p>
<?php echo __('You can also leave general comments or suggestions in the "comments" section. An administrator will review your contribution.'); ?>
</p>
<p>
<?php echo __('Thank you for taking the time to improve this site!'); ?>
</p>

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