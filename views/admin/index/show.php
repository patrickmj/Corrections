<?php
echo head(array('title' => 'correction'));
$item = $corrections_correction->getItem();
?>

<?php if (metadata($corrections_correction, 'status') == 'submitted'): ?>
<a href="<?php echo url("/corrections/index/correct/id/{$corrections_correction->id}"); ?>">
<?php echo __('Accept correction for "%s"', metadata($item, array('Dublin Core', 'Title'))); ?></a>
<?php endif; ?>
<ul>
<li>On: <?php echo link_to($item, 'show', metadata($item, array('Dublin Core', 'Title'))); ?> </li>
<li>Added: <?php echo metadata($corrections_correction, 'added'); ?></li>
<li>Status: <?php echo metadata($corrections_correction, 'status'); ?></li>
<?php if ($reviewed = metadata($corrections_correction, 'reviewed')): ?>
<li>Reviewed on: <?php echo $reviewed; ?></li>
<?php endif; ?>
<?php if ($owner = $corrections_correction->getOwner() ): ?>
<li>From: <?php echo link_to($owner, 'show', metadata($owner, 'name')); ?></li>
<?php else: ?>
    <?php if ($corrections_correction->may_contact): ?>
    <li>From: <a href='mailto:<?php echo metadata($corrections_correction, 'email'); ?>'><?php echo metadata($corrections_correction, 'email'); ?></a> (May Contact)</li>
    <?php else: ?>
    <li>From: <?php echo metadata($corrections_correction, 'email'); ?>(May Not Contact)</li>
    <?php endif; ?>
<?php endif; ?>


</ul>

<p>
Comment: 
<?php echo metadata($corrections_correction, 'comment'); ?>
</p>

<?php 
//var_dump($corrections_correction);
echo all_element_texts($corrections_correction);
?>


<?php echo foot(); ?>