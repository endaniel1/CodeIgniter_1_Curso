<body>
	<div class="container">
		<div class="row">
			<a href="<?=base_url()?>/nuevo" class="btn btn-info">Nuevo</a>
		</div>
		<div class="table table-hover">
			<table class="" align="center">
				<thead>
					<tr>
						<th scope="col">id</th>
						<th scope="col">Name</th>
						<th scope="col">Email</th>
						<th scope="col">Deleted</th>
						<th scope="col" colspan="2">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($users): ?>
						<?php foreach ($users as $user): ?>
							<tr scope="row">
								<td><?=$user["id"]?></td>
								<td><?=$user["name"]?></td>
								<td><?=$user["email"]?></td>
								<td><?=$user["deleted_at"]?></td>
								<td>
									<a href="<?=base_url()?>/miControlador/editar/<?=$user["id"]?>" class="btn btn-warning">
										<li class='fa fa-pencil-square-o'></li>
									</a>
								<td>
									<a href="<?=base_url()?>/miControlador/borrar/<?=$user["id"]?>" class="btn btn-danger">
										<li class='fa fa-trash'></li>
									</a>
								</td>
							</tr>
						<?php endforeach?>
					<?php endif?>
				</tbody>
			</table>
			<div class="container ">
				<div class="col-lg-12 text-center">
					<?=$paginator->links()?>
				</div>
			</div>
		</div>
	</div>
</body>