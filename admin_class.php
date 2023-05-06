<?php
session_start();
Class Action {
	private $db;

	public function __construct() {
   	include 'Database.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	}

	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM admin where FIRST_name = '".$username."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			// var_dump($_SESSION);
			return 1;
		}else{
			return 2;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function save_movie(){
		extract($_POST);
		$data = " movie_name = '".$title."' ";
		$data .= ", decription = '".$description."' ";
		$data .= ", directer = '".$director."' ";
		$data .= ", categroy = '".$category."' ";
		$data .= ", language = '".$langauge."' ";
		$data .= ", show = '".$show."' ";
		$data .= ", action = '".$action."' ";
		$data .= ", release_date = '".$release_date."' ";
		$data .= ", status = '".$status."' ";
		
		$duration =  $duration_hour .'.'.(($duration_min / 60) * 100);
		$data .= ", duration = '".$duration."' ";
		


		if($_FILES['cover']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'],'../image/'. $fname);
			$data .= ", image = '".$fname."' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO movie_details set". $data);
			if($save)
				return 1;
		}else{
			$save = $this->db->query("UPDATE movie_details set ". $data." where id =".$id);
			if($save)
				return 1;
		}
	}
	function delete_movie(){
		extract($_POST);
		$delete  = $this->db->query("DELETE FROM movie_details where movie_id =".$id);
		if($delete)
			return 1;
	}
	function delete_theater(){
		extract($_POST);
		$delete  = $this->db->query("DELETE FROM theater_show where movie_id =".$id);
		if($delete)
			return 1;
	}
	
	function save_theater(){
		extract($_POST);
		$data = ", show = '".$theater_id."' ";
		$data .= ", theater = '".$theater."' ";
		if(empty($id))
		$save = $this->db->query("INSERT INTO theater_show set ".$data." ");
		else
		$save = $this->db->query("UPDATE theater_show set ".$data." where movie_id = ".$id);
		if($save)
			return 1;

	}
	function delete_seat(){
		extract($_POST);
		$delete  = $this->db->query("DELETE FROM feedback where customer_id =".$id);
		if($delete)
			return 1;
	}
	function save_reserve(){
		extract($_POST);
		$data = " movie_id = '".$movie_id."' ";
		$data .= ", ts_id = '".$seat_group."' ";
		$data .= ", lastname = '".$lastname."' ";
		$data .= ", firstname = '".$firstname."' ";
		$data .= ", contact_no = '".$contact_no."' ";
		$data .= ", qty = '".$qty."' ";
		$data .= ", `date` = '".$date."' ";
		$data .= ", `time` = '".$time."' ";

		$save = $this->db->query("INSERT INTO books set ".$data);
		if($save)
			return 1;
	}
}