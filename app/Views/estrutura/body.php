<body>
	<table border="1">
		<thead>
			<tr>
				<th>id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Deleted</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users as $user): ?>
				<tr>
					<td><?=$user["id"]?></td>
					<td><?=$user["name"]?></td>
					<td><?=$user["email"]?></td>
					<td><?=$user["deleted_at"]?></td>
				</tr>
			<?php endforeach?>
		</tbody>
	</table>
</body>