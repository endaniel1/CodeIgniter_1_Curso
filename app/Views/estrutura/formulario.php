<?=form_open("/home/guardar")?>

	<?=form_label("Nombre", "name")?>
	<?=form_input(["type" => "text", "name" => "name", "placeholder" => "Nombre", "required" => "required"])?>
	<br>
	<?=form_label("Correo", "email")?>
	<?=form_input(["type" => "email", "name" => "email", "placeholder" => "Correo", "required" => "required"])?>
	<br>
	<?=form_submit("guardar", "Guardar")?>

<?=form_close()?>