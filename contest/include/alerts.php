
<!-- Begin generated alerts -->

<div class="col-sm-1" id="alerts">
<?php
if (isset($has_alert)) {
	if ($has_alert === true) {
?>

<div class="alert alert-<?php echo $alert_class; ?> alert-dismissable">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<h4><?php echo $alert_subject; ?></h4>
<?php echo $alert_body; ?>
</div>

<?php
	}
}
?>
</div>

<!-- End generated alerts -->

