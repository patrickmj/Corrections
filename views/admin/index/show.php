<?php
echo head(array('title' => 'correction'));

?>

<p>
<?php echo metadata($corrections_correction, 'comment'); ?>
</p>

<p>
<?php echo metadata($corrections_correction, 'status'); ?>
</p>
<p>
Reviewed on: <?php echo metadata($corrections_correction, 'reviewed'); ?>
</p>
<?php 
//var_dump($corrections_correction);
echo all_element_texts($corrections_correction);
?>


<?php echo foot(); ?>