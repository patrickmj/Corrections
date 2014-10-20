<?php

echo head(array('title' => 'Corrections'));

?>
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
<a href=""><?php echo __('Accept revision for %s', metadata($item, array('Dublin Core', 'Title'))); ?></a>
<?php echo all_element_texts($correction); ?>
</td>
</tr>

<?php endforeach; ?>

</tbody>

</table>


<?php echo foot(); ?>