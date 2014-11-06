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
        <li><a href="<?php echo url('corrections', array('status' => 'accepted')); ?>"><?php echo __('Accepted'); ?></a></li>
        <li><a href="<?php echo url('corrections', array('status' => 'rejected')); ?>"><?php echo __('Rejected'); ?></a></li>
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
    <p>
    <?php echo __('Status: %s', metadata($correction, 'status'));?>
    </p>
    <ul>
        <?php if (metadata($correction, 'status') == 'submitted'): ?>
        <li>
        <a href="<?php echo url("/corrections/index/correct/id/{$correction->id}"); ?>">
        <?php echo __('Accept correction for "%s"', metadata($item, array('Dublin Core', 'Title'))); ?></a>
        </li>
        <li>
        <a href="<?php echo url("/corrections/index/reject/id/{$correction->id}"); ?>">
        <?php echo __('Reject correction for "%s"', metadata($item, array('Dublin Core', 'Title'))); ?></a>
        </li>
        <?php endif; ?>
        <li>
        <a href="<?php echo url("/corrections/index/show/id/{$correction->id}"); ?>">
        <?php echo __('View correction'); ?></a>
        </li>
    </ul>
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