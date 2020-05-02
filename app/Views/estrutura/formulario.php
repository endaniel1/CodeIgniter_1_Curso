<?php
if (isset($user)) {
    //echo $user;
    //reciviso aqui las variables de user
    $name  = $user["name"];
    $email = $user["email"];
} else {
    $name  = "";
    $email = "";
}
?>
<div class="container">
	<?=form_open("/home/guardar")?>
		<?php if (isset($user)): ?>
			<?=form_hidden("id", $user["id"])?>
		<?php endif?>
		<div class="form-group">
			<?=form_label("Nombre", "name")?>
			<?=form_input(["type" => "text", "name" => "name", "placeholder" => "Nombre", "required" => "required", "class" => "form-control", "value" => $name])?>
			<br>
			<?=form_label("Correo", "email")?>
			<?=form_input(["type" => "email", "name" => "email", "placeholder" => "Correo", "required" => "required", "class" => "form-control", "value" => $email])?>
			<br>
			<?=form_submit("guardar", "Guardar", "class='btn btn-primary'")?>
			<a href="<?=base_url()?>" class="btn btn-warning">Cancelar</a>
		</div>
	<?=form_close()?>
</div>
