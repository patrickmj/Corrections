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
    echo "<div class='elCorrection' style='border: 1px solid black;'>";
    $elName = $element->name;
    $elSet = $element->getElementSet();
    $elSetName = $elSet->name;
    echo $this->elementForm($element, $corrections_correction);
    echo "<p>" . __('Current data for %s', $elSetName . ' ' . $elName) . "</p>";
    echo "<p>" . metadata($item, array($elSetName, $elName)) . "</p>";
    echo "</div>";
}
?>


<div class="field">
    <div class="two columns alpha">
        <label for='comment'><?php echo __('Comments'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation"></p>
        <div class="input-block">
            <textarea cols='50' rows='3' name='comment'></textarea>
        </div>
    </div>
</div>


<div class="field">
    <div class="two columns alpha">
        <label for='email'><?php echo __('Email'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation"></p>
        <div class="input-block">
            <input type='text' name='email' />
        </div>
    </div>
</div>


<div class="field">
    <div class="two columns alpha">
        <label for='may_contact'><?php echo __('Can we contact you?'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation"><?php echo __('Check this box if it is okay for us to contact you about this correction.'); ?></p>
        <div class="input-block">
            <input type='checkbox' value='1' name='may_contact' />
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