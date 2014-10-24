<?php
echo head(array('title' => 'correction'));

?>

<p>
<?php echo metadata($corrections_correction, 'comment'); ?>
</p>

<p>
<?php echo metadata($corrections_correction, 'status'); ?>
</p>

<?php 
//var_dump($corrections_correction);
echo all_element_texts($corrections_correction);
?>


<?php echo foot(); ?>