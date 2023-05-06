<?php 
include 'Database.php';
if(isset($_GET['id'])){
	$mov = $conn->query("SELECT * FROM theater_show where movie_id =".$_GET['id']);
	foreach($mov->fetch_array() as $k => $v){
		$meta[$k] = $v;
	}
}

?>

<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-theater">
			<div class="form-group">
				<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
				<label for="" class="control-label">Theater Time</label>
				<input type="text" name="show" required="" class="form-control" value="<?php echo isset($meta['show']) ? $meta['show'] : '' ?>">
				<label for="" class="control-label">Theater Number</label>
				<input type="number" name="theater" required="" class="form-control" value="<?php echo isset($meta['theater']) ? $meta['theater'] : '' ?>">
			</div>
			
		</form>
	</div>
</div>

<script>
	$('#manage-theater').submit(function(e){
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