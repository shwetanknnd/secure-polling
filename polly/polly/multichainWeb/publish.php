<?php
	error_reporting(1);
	require_once 'functions.php';
	
 	 set_multichain_config();

?>
<?php


	 $data=string_to_txout_bin($_POST['data']);

	 $streamName=string_to_txout_bin($_POST['streamName']);

	 if (no_displayed_error_result($publishtxid, multichain(
			'publishfrom', '1BWPzNwofpPbHh9WY7vWVaUK4nX5niGD79EtYB', $streamName, '', bin2hex($data)
		))){

		echo $publishtxid;

	}
		
?>

			