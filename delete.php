<?php
	include_once('connection.php');
	include "config.php";

	if(isset($_GET['ID'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM tbl_form WHERE ID = '".$_GET['ID']."'";

			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Question deleted successfully' : 'Something went wrong. Cannot delete Question';

			if($sql){
				global $client,$durum;
				$params = [
					'index' => 'sorular',
					'type' => '_doc',
					'id' => $_GET['ID'],
					];
				
			  	$response = $client->delete($params);
			}
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Select question to delete first';
	}

	header('location: index.php');
