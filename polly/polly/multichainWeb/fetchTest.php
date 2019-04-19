<?php
	// error_reporting(0);
	require_once 'functions.php';
 	 set_multichain_config();
	 
	 
	 $streamName=string_to_txout_bin($_POST['streamName']);
	 $publishtxid=string_to_txout_bin($_POST['publishtxid']);
	 
	 
	 if (no_displayed_error_result($streamItem, multichain('getstreamitem', $streamName, $publishtxid, false)))
			{

			echo $streamItem;
			$binary=pack('H*', $streamItem['data']);
			$size=strlen($binary);
			echo html($binary);
			}
			
?>
			