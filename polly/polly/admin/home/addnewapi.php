<?php
		require_once('../../streams/streams.php');		
		require_once('../../library/dbConnect.php');
				
		session_start();
		if (isset($_POST['type1'])) 
		{
			$type = $_POST['type'];	
			$topic = $_POST['topic'];
			
			$arr = array($type, $topic);
			$json = json_encode($arr);

			//save the json in block chain and return txnid as $transactionId
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://localhost/polly/multichainWeb/publish.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "streamName=$streamSurveyResponse&data=$json");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			// in real life you should use something like:
			// curl_setopt($ch, CURLOPT_POSTFIELDS, 
			//          http_build_query(array('postvar1' => 'value1')));
			// receive server response ...
			$tx = curl_exec ($ch);
			curl_close ($ch);
			
			
			$query="INSERT INTO adminentry(name, type, admin, txid) VALUES ('$topic','$type','1','$tx')";
			if(mysqli_query($con, $query))
			{
				$entryId = mysqli_insert_id($con);
				if ($_POST['dynfields']) 
				{
					foreach( $_POST['dynfields'] as $key => $value ) 
					{
						$options = mysqli_real_escape_string($value);		
						$query2="INSERT INTO `list-item` (entry_id,name) VALUES ('$entryId','$options')";
						mysqli_query($con,$query2);
					}
					
					header("location:addnew.php?token=". $_SESSION['token'] );
				}
			}
?>

		<script type="text/javascript"> alert('Successs type 1.'); 
			window.location= "addnew.php<?php echo '?token='. $_SESSION['token'];?>";
		</script>
	
<?php
		}
		else if (isset($_POST['type3'])) 
		{
			$type = $_POST['type'];	
			$topic = $_POST['topic'];
			
			$arr = array($type, $topic);
			$json = json_encode($arr);

			//save the json in block chain and return txnid as $transactionId
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://localhost/polly/multichainWeb/publish.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "streamName=$streamSurveyResponse&data=$json");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			// in real life you should use something like:
			// curl_setopt($ch, CURLOPT_POSTFIELDS, 
			//          http_build_query(array('postvar1' => 'value1')));
			// receive server response ...
			$tx = curl_exec ($ch);
			curl_close ($ch);
			
			
			$query="INSERT INTO adminentry(name, type, admin, txid) VALUES ('$topic','$type','1','$tx')";
			
			//$type=$_POST['type'];	
			//$topic=$_POST['topic'];
			
			
			//$query="INSERT INTO adminentry(name,type,admin) VALUES ('$topic','$type','1')";
			if(mysqli_query($con,$query))
			{
				$entryId = mysqli_insert_id($con);
				$query2="INSERT INTO `list-item` (entry_id,name) VALUES ('$entryId','Rating')";
				mysqli_query($con,$query2);
				header("location:addnew.php?token=". $_SESSION['token'] );
			}
?>

		<script type="text/javascript"> alert('Successs type 3.'); 
			window.location= "addnew.php<?php echo '?token='. $_SESSION['token'];?>";
		</script>
	
<?php	
		}
        else
        {	
	
?>
		<script type="text/javascript">
			alert('Failed.');
			window.location= "addnew.php<?php echo '?token='. $_SESSION['token'];?>";
		</script>

<?php
		}    


?>
