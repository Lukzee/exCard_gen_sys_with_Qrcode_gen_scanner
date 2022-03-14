<?php 


   include('qrlib.php'); 
    
    // outputs image directly into browser, as PNG stream 
	$rand=rand(123445,12345677);
    QRcode::png($rand);
	
	