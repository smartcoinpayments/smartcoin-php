<?php
	class Test_Smartcoin_Shipping extends UnitTestCase {
		function test_calculate_a_shipping_cost_destination_cep_36_600_000() {
			$weight = 0.2; # Kg
	    $origin_cep = 22280100; #RJ - Rio de Janeiro - Botafogo
	    $destination_cep = 36600000; #MG - Bicas
	    $expect_shipping_cost = 1780; #the current value that correios charge for PAC service without deal

	    $shipping_info = \Smartcoin\Shipping::calculator(array('weight' => $weight, 'origin_cep' => $origin_cep,
	    																											 'destination_cep' => $destination_cep));
	    $this->assertEqual($shipping_info['amount'], $expect_shipping_cost);
		}

		function test_calculate_a_shipping_cost_with_different_destination_cep_24_230_153() {
			$weight = 0.2; # Kg
		  $origin_cep = 22280100; #RJ - Rio de Janeiro - Botafogo
		  $destination_cep = 24230153; #RJ - Niterói - Icaraí
		  $expect_shipping_cost = 1480; #the current value that correios charge for PAC service without deal

		  $shipping_info = \Smartcoin\Shipping::calculator(array('weight' => $weight, 'origin_cep' => $origin_cep,
	    																											 'destination_cep' => $destination_cep));
		  $this->assertEqual($shipping_info['amount'], $expect_shipping_cost);
		}
	}
?>