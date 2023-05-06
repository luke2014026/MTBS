<style>
	td img{
		width: 50px;
		height: 75px;
		margin:auto;
	}
	td p {
		margin: 0
	}
</style>
<?php include ('Database.php') ?>
<div class="container-fluid">
	<div class="row">
		<div class="card col-md-12 mt-3">
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Email Id</th>
							<th class="text-center">Movie Name</th>
							<th class="text-center">Card_number #</th>
							<th class="text-center">Price</th>
							<th class="text-center">Reserved Info</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 7;
						$movie = $conn->query("SELECT * FROM `record` WHERE PRICE BETWEEN 99 AND 2200");
						while($row=$movie->fetch_assoc()){
						 ?>
						 <tr>
						 	<td><?php echo $row['booking_id'] ?></td>
						 	<td><?php echo ucwords($row['email']) ?></td>
						 	<td><?php echo $row['movie'] ?></td>
						 	<td><?php echo $row['card_number'] ?></td>
							<td><?php echo $row['PRICE'] ?></td>
						 	<td>
						 		<p><small><b>Theater:</b> <?php echo $row['theater'] ?></small></p>
						 		<p><small><b>Seat Group:</b> <?php echo $row['seat'] ?></small></p>
						 		<p><small><b>qty:</b> <?php echo $row['totalseat'] ?></small></p>
						 		<p><small><b>Date:</b> <?php echo date("D-m-y",strtotime($row['payment_date'])) ?></small></p>
						 		<p><small><b>Time:</b> <?php echo $row['show_time'] ?></small></p>
						 	</td>
						 	
						 	
						 </tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<script>
	$('table').dataTable();
	$('#new_movie').click(function(){
		uni_modal('New Movie','manage_movie.php');
	})
	$('.edit_movie').click(function(){
		uni_modal('Edit Movie','manage_movie.php?id='+$(this).attr('data-id'));
	})
	$('.delete_movie').click(function(){
		_conf('Are you sure to delete this data?','delete_movie' , [$(this).attr('data-id')])
	})

	function delete_movie($id=''){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_movie',
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