<?php

//This function returns a 2-D array named 
//cartData[index][field name] = (partNum, quant, price, weight, picUrl, description)
function getCartData()
{



	return $cartData;
}


//unit test
$ouput = getCartData();
echo $output;

?>