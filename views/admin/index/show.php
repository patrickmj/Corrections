<?php
echo head(array('title' => 'correction'));
$item = $corrections_correction->getItem();
?>

<?php if (metadata($corrections_correction, 'status') == 'submitted'): ?>
<ul>
    <li>
    <a href="<?php echo url("/corrections/index/correct/id/{$corrections_correction->id}"); ?>">
    <?php echo __('Accept correction for "%s"', metadata($item, array('Dublin Core', 'Title'))); ?></a>
    <li>
    <a href="<?php echo url("/corrections/index/reject/id/{$corrections_correction->id}"); ?>">
    <?php echo __('Reject correction for "%s"', metadata($item, array('Dublin Core', 'Title'))); ?></a>
    </li>
</ul>
<?php endif; ?>

<ul>
<li><?php echo __('On:'); ?> <?php echo link_to($item, 'show', metadata($item, array('Dublin Core', 'Title'))); ?> </li>
<li><?php echo __('Added:'); ?> <?php echo metadata($corrections_correction, 'added'); ?></li>
<li><?php echo __('Status:'); ?> <?php echo metadata($corrections_correction, 'status'); ?></li>
<?php if ($reviewed = metadata($corrections_correction, 'reviewed')): ?>
<li><?php echo __('Reviewed on:'); ?> <?php echo $reviewed; ?></li>
<?php endif; ?>
<?php if ($owner = $corrections_correction->getOwner() ): ?>
<li><?php echo __('From:'); ?> <?php echo link_to($owner, 'show', metadata($owner, 'name')); ?></li>
<?php else: ?>
    <?php if ($corrections_correction->may_contact): ?>
    <li><?php echo __('From:'); ?> <a href='mailto:<?php echo metadata($corrections_correction, 'email'); ?>'><?php echo metadata($corrections_correction, 'email'); ?></a><?php echo __('(Allowed To Contact)'); ?> </li>
    <?php else: ?>
    <li><?php echo __('From:'); ?> <?php echo metadata($corrections_correction, 'email'); ?> <?php echo __('(May Not Contact)')?></li>
    <?php endif; ?>
<?php endif; ?>
</ul>

<p>
<?php echo __('Comment:'); ?>
<?php echo metadata($corrections_correction, 'comment'); ?>
</p>

<?php 
echo all_element_texts($corrections_correction);
?>
<?php echo foot(); ?>