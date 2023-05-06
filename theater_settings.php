<style>
	td img{
		width: 50px;
		height: 75px;
		margin:auto;
	}
</style>
<?php include ('Database.php') ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-block btn-sm btn-primary col-sm-2" type="button" id="new_group"><i class="fa fa-plus"></i> Theater Timings</button>
		</div>
	</div>
	<div class="row">
		<div class="card col-md-7 mt-7">
			<div class="card-header">
				<large>Theaters</large>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Show Timings</th>
							<th class="text-center">Theater</th>
							<th class="text-center">Action</th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$theater = $conn->query("SELECT * FROM theater_show limit 6");
						while($row=$theater->fetch_assoc()){
						 ?>
						 <tr>
						 	<td><?php echo $row['movie_id'] ?></td>
						 	<td><?php echo $row['show'] ?></td>
							<td><?php echo $row['theater'] ?></td>
						 	<td>
						 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary btn-sm">Action</button>
								  <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_theater" href="javascript:void(0)" data-id = '<?php echo $row['movie_id'] ?>'>Edit</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_theater" href="javascript:void(0)" data-id = '<?php echo $row['movie_id'] ?>'>Delete</a>
								  </div>
								</div>
								</center>
						 	</td>
						 </tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	<div class="card col-md-7 mt-3 ml-3">
			<div class="card-header">
				<large>Feedback</large>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Name</th>
							<th class="text-center">Email</th>
							<th class="text-center">Message</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$theater = $conn->query("SELECT * FROM feedback order by name asc,customer_id asc ");
						while($row=$theater->fetch_assoc()){
						 ?>
						 <tr>
						 	<td><?php echo $row['customer_id'] ?></td>
						 	<td><?php echo $row['name'] ?></td>
						 	<td><?php echo $row['email'] ?></td>
						 	<td><?php echo $row['massage'] ?></td>
						 	<td>
						 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary btn-sm">Action</button>
								  <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item delete_seat" href="javascript:void(0)" data-id = '<?php echo $row['customer_id'] ?>'>Delete</a>
								  </div>
								</div>
								</center>
						 	</td>
						 </tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</div>

</div>


<script>
	
	$('#new_group').click(function(){
		uni_modal('New Theater Timings','manage_seat.php');
	})
	$('.edit_theater').click(function(){
		uni_modal('Theater settings','manage_theater.php?id='+$(this).attr('data-id'));
	})
	$('.delete_theater').click(function(){
		_conf('Are you sure to delete this data?','delete_theater' , [$(this).attr('data-id')])
	})
	
	$('.delete_seat').click(function(){
		_conf('Are you sure to delete this data?','delete_seat' , [$(this).attr('data-id')])
	})

	function delete_theater($id=''){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_theater',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully deleted",'success');
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	}
	function delete_seat($id=''){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_seat',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully deleted",'success');
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	}
</script>