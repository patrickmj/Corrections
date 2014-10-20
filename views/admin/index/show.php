<?php
echo head();

?>

<?php foreach(loop('corrections_correction') as $correction):?>
<?php echo metadata('corrections_correction', 'item_id'); ?>

<?php endforeach; ?>


<?php echo foot(); ?>