<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Add Form</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
		<h1 class="page-header text-center">Add Form</h1>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> New</a>
				<table class="table table-bordered table-striped" style="margin-top:20px;">
					<thead>
						<th>ID</th>
						<th>Title</th>
						<th>Question</th>
						<th>Answer</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php
						//include our connection
						include_once('connection.php');

						$database = new Connection();
						$db = $database->open();
						$db->query("SET CHARACTER SET utf8");
						try {
							$sql = 'SELECT * FROM tbl_form';
							foreach ($db->query($sql) as $row) {
						?>
								<tr>
									<td><?php echo $row['ID']; ?></td>
									<td><?php echo $row['title']; ?></td>
									<td><?php echo $row['question']; ?></td>
									<td><?php echo $row['answer']; ?></td>
									<td>
										<a href="#edit_<?php echo $row['ID']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span>Edit</a>
									</td>
									<td>
										<a href="#delete_<?php echo $row['ID']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span>Delete</a>
									</td>
									<?php include('edit_delete_modal.php'); ?>
								</tr>
						<?php
							}
						} catch (PDOException $e) {
							echo "There is some problem in connection: " . $e->getMessage();
						}

						//close connection
						$database->close();

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php include('add_modal.php'); ?>
	<script src="jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>