<?php 
include 'Database.php';
if(isset($_GET['id'])){
	$mov = $conn->query("SELECT * FROM movie_details where id =".$_GET['id']);
	foreach($mov->fetch_array() as $k => $v){
		$meta[$k] = $v;
		if($k == 'duration' && !is_numeric($k)){
			$v = explode('.',$v);
			$meta['duration_hour'] = $v[0];
			$v[1] = isset($v[1]) ? $v[1] : 0;
		 	$meta['duration_min'] = 60 * ('.'.$v[1]);

		}
	}
}

?>

<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-movie">
			<div class="form-group">
				<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
				<label for="" class="control-label">Movie Name</label>
				<input type="text" name="title" required="" class="form-control" value="<?php echo isset($meta['movie_name']) ? $meta['movie_name'] : '' ?>">
			</div>
			<div class="form-group">
				<label for="" class="control-label">Description</label>
				<textarea name="description" class="form-control" id="" cols="30" rows="3" required><?php echo isset($meta['decription']) ? $meta['decription'] : '' ?></textarea>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Director</label>
				<input type="text" name="director" required="" class="form-control" value="<?php echo isset($meta['directer']) ? $meta['directer'] : '' ?>">
			</div>
			<div class="form-group">
				<label for="" class="control-label">Category(Action,Adventure,Drama,Comedy,Biographical War, Historical)</label>
				<input type="text" name="category" required="" class="form-control" value="<?php echo isset($meta['categroy']) ? $meta['categroy'] : '' ?>">
			</div>
			<div class="form-group">
				<label for="" class="control-label">Language(English,Hindi,Gujarati)</label>
				<input type="text" name="langauge" required="" class="form-control" value="<?php echo isset($meta['language']) ? $meta['language'] : '' ?>">
			</div>
			<div class="form-group">
				<label for="" class="control-label">Show Time</label>
				<input type="text" name="show" required="" class="form-control" value="<?php echo isset($meta['show']) ? $meta['show'] : '' ?>">
			</div>
			<div class="form-group">
				<label for="" class="control-label">Action(running or upcoming)</label>
				<input type="text" name="action" required="" class="form-control" value="<?php echo isset($meta['action']) ? $meta['action'] : '' ?>">
			</div>
			<div class="form-group row">
				<label for="" class="control-label col-md-12">Duration</label>
				<input type="number" name="duration_hour" required="" class="form-control col-sm-2 offset-md-1 " value="<?php echo isset($meta['duration_hour']) ? $meta['duration_hour'] : '' ?>" max="12" min="0" placeholder="Hour">:
				<input type="number" name="duration_min" required="" class="form-control col-sm-2 "  max="59" min="0" value="<?php echo isset($meta['duration_min']) ? $meta['duration_min'] : '' ?>" placeholder="Min">
			</div>
			<div class="form-group">
				<label for="" class="control-label">Showing Schedule</label>
				<input name="release_date" id="" type="text" class="form-control" value="<?php echo isset($meta['release_date']) ? $meta['release_date'] : '' ?>" required>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Status</label>
				<input name="status" id="" type="text" class="form-control" value="<?php echo isset($meta['status']) ? $meta['status'] : '' ?>" required>
			</div>
			<div class="form-group">
				<img src="../image/<?php echo isset($meta['image']) ? $meta['image'] : '' ?>" alt="" id="cover_img" width="50" height="75">
			</div>
			<div class="form-group input-group">
				<label for="" class="control-label">Cover Image</label>
				<br>
				<div class="input-group-prepend">
				    <span class="input-group-text">Upload</span>
				  </div>
				  <div class="custom-file">
				    <input type="file" name="cover" class="custom-file-input" id="cover-img" onchange="displayImg(this,$(this))">
				    <label class="custom-file-label" for="cover-img">Choose file</label>
				  </div>
			</div>
			
		</form>
	</div>
</div>

<script>
	$('#manage-movie').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_movie',
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