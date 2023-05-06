<?php 
include 'db_connect.php';
if(isset($_GET['id'])){
	$mov = $conn->query("SELECT * FROM theater_show where movie_id =".$_GET['id']);
	foreach($mov->fetch_array() as $k => $v){
		$meta[$k] = $v;
	}
}

?>

<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-seat">
			<div class="form-group">
				<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
				<label for="" class="control-label">Theater Time</label>
				<select name="theater_id" required="" class="custom-select browser-default" >
					<option value=""></option>
					<?php 
					$theater = $conn->query("SELECT * FROM theater_show limit 6");
					while($row = $theater->fetch_assoc()):
					?>
					<option value="<?php echo $row['movie_id'] ?>" <?php echo isset($meta['id']) && $meta['id'] == $row['movie_id'] ? 'selected' :'' ?>><?php echo $row['show'] ?></option>
				<?php endwhile; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="" class="control-label">Theater Number</label>
				<select name="theater" required="" class="custom-select browser-default" >
					<option value=""></option>
					<?php 
					$theater = $conn->query("SELECT * FROM theater_show limit 6 where theater BETWEEN 1 AND 2");
					while($row = $theater->fetch_assoc()):
					?>
					<option value="<?php echo $row['movie_id'] ?>" <?php echo isset($meta['id']) && $meta['id'] == $row['movie_id'] ? 'selected' :'' ?>><?php echo $row['theater'] ?></option>
				<?php endwhile; ?>
				</select>
			</div>
			
		</form>
	</div>
</div>

<script>
	$('#manage-seat').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_theater',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.','success')
					setTimeout(function(){
						location.reload()
					},1500)
					// end_load()
				}
			}
		})

	})
			function displayImg(input,_this) {
			    if (input.files && input.files[0]) {
			        var reader = new FileReader();
			        reader.onload = function (e) {
			        	$('#cover_img').attr('src', e.target.result);
            			_this.siblings('label').html(input.files[0]['name'])
            			_this.siblings('input[name="fname"]').val('<?php echo strtotime(date('y-m-d H:i:s')) ?>_'+input.files[0]['name'])
            			var p = $('<p></p>')
			            
			        }

			        reader.readAsDataURL(input.files[0]);
			    }
			}
</script>