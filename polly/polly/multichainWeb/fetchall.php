<?php
	// error_reporting(0);
	require_once 'functions.php';
 	 set_multichain_config();
	 
	 $streamName=string_to_txout_bin($_POST['streamName']);
	 	 
	 if (no_displayed_error_result($streamItems, multichain('liststreamitems', $streamName, false)))
			{

			$arr = array();
			//echo json_encode($streamItem);
			foreach( $streamItems as $item ) 
			{
				$binary=pack('H*', $item['data']);
				$arr.array_push(json_encode($binary));
				echo html($binary);
			}

echo json_encode($arr);
			//$binary=pack('H*', $streamItem['data']);
			//$size=strlen($binary);
			//echo html($binary);
			}
			
?>
			