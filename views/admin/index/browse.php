<?php

echo head(array('title' => 'Corrections'));

?>

<div id='primary'>


<?php echo flash(); 
echo item_search_filters();
?>


<?php echo pagination_links(); ?>

<ul class="quick-filter-wrapper">
    <li><a href="#" tabindex="0"><?php echo __('Status'); ?></a>
    <ul class="dropdown">
        <li><span class="quick-filter-heading"><?php echo __('Status') ?></span></li>
        <li><a href="<?php echo url('corrections'); ?>"><?php echo __('View All') ?></a></li>
        <li><a href="<?php echo url('corrections', array('status' => 'submitted')); ?>"><?php echo __('Submitted'); ?></a></li>
        <li><a href="<?php echo url('corrections', array('status' => 'reviewed')); ?>"><?php echo __('Reviewed'); ?></a></li>
    </ul>
    </li>
</ul>

<p style='clear: both' >
<?php echo __("Corrections are additive. No data will be deleted or replaced. After accepting a
        correction, review it on the item page and edit there to confirm the decision.
        "); ?>
</p>
    <table>
    <thead>
    <tr><th><?php echo __('Item'); ?></th><th><?php echo __('Correction');?></th></tr>
    </thead>
    <tbody>
    <?php foreach(loop('corrections_correction') as $correction):?>
    <?php $item = $correction->getItem(); ?>
    <tr>
    <td>
    <?php echo link_to($item, 'show', metadata($item, array('Dublin Core', 'Title'))); ?>
    <?php echo all_element_texts($item); ?>
    </td>
    <td>
    <?php if (metadata($correction, 'status') == 'submitted'): ?>
    <a target="_blank" href="<?php echo url("/corrections/index/correct/id/{$correction->id}"); ?>"><?php echo __('Accept revision for "%s"', metadata($item, array('Dublin Core', 'Title'))); ?></a>
    <?php else: ?>
    <a target="_blank" href="<?php echo url("/corrections/index/show/id/{$correction->id}"); ?>"><?php echo __('View correction'); ?></a>
    <?php endif; ?>
    <p>
    <?php echo metadata($correction, 'comment'); ?>
    </p>
    
    <?php echo all_element_texts($correction); ?>
    </td>
    </tr>
    
    <?php endforeach; ?>
    
    </tbody>
    
    </table>
</div>

<?php echo foot(); ?>