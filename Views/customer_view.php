<?php

    /**
    * The Customer page view
    */
    class CustomerView
    {

        private $modelObj;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->modelObj = $model;

            //print "Customer - ";
        }

        public function orders()
        {
            print "Orders";
            $orders = $this->controller->orders();
            echo '<ul>';
            foreach(  $orders as $order)
            {
                echo "<li>
                        <ul>
                            <li>CustomerID: $order->CustomerID</li>
                            <li>CustomerName: $order->CustomerName </li>
                            <li>Address: $order->Address</li>
                            <li>City: $order->City</li>
                            <li>PostalCode: $order->PostalCode</li>
                            <li>Country: $order->Country</li>
                            <li>OrderID: $order->OrderID</li>
                            <li>EmployeeID: $order->EmployeeID </li>
                            <li>OrderDate: $order->OrderDate</li>
                            <li>ShipperID: $order->ShipperID</li>
                        </ul>
                      </li>";
            }
            echo '</ul>';
        }

		public function reviewBillingInformation()
		{
			/*
			1
			Alfreds Futterkiste
			Maria Anders
			Obere Str. 57
			Berlin
			12209
			Germany
			*/
			
			echo "<h1>Review Billing Information</h1>";
			
			$myInfos = $this->controller->reviewBillingInformation();
			
			foreach ($myInfos as $myInfo)
			{
				echo "<table>
					<tr><td>CustomerID</td><td>$myInfo->CustomerID</td></tr>
                    <tr><td>CustomerName</td><td>$myInfo->CustomerName</td></tr>
                    <tr><td>ContactName</td><td>$myInfo->ContactName</td></tr>
					<tr><td>Address</td><td>$myInfo->Address</td></tr>
                    <tr><td>City</td><td>$myInfo->City</td></tr>
                    <tr><td>PostalCode</td><td>$myInfo->PostalCode</td></tr>
                    <tr><td>Country</td><td>$myInfo->Country</td></tr>
				</table>";
			}
			
			echo "<br>";
			echo "<a href='editBillingInformation'>edit</a>";
		}
		
		
		public function editBillingInformation()
		{
			echo "<h1>Edit Billing Information</h1>";
			$myInfos = $this->controller->editBillingInformation();
			
			foreach ($myInfos as $myInfo)
			{
			
					$customerID = $myInfo->CustomerID;
					$customerName = $myInfo->CustomerName; 
					$contactName = $myInfo->ContactName;
					$address = $myInfo->Address;
					$city = $myInfo->City;
					$postalCode = $myInfo->PostalCode;
					$country = $myInfo->Country;
				
			}
			
			echo "
			
			<form action='insertNewBillingInformation' method='post'>
			<table>
			<tr><td>Customer Name</td><td><input type='text' name='customername' value='$customerName'></td></tr>
			
			<tr><td>Contact name</td> <td><input type='text' name='contactname' value='$contactName'></td></tr>
			
			<tr><td>Address</td> <td><input type='text' name='address' value='$address'></td></tr>
			
			<tr><td>City</td> <td><input type='text' name='city' value='$city'></td></tr>
			
			<tr><td>Postal Code</td> <td><input type='text' name='postalcode' value='$postalCode'></td></tr>
			
			<tr><td>Country</td> <td><input type='text' name='country' value='$country'></td></tr>
			
			<tr><td></td><td><input type='submit' value='Submit'></td></tr>
			</table>
			</form>
			
				";
		}
		
		public function insertNewBillingInformation()
		{
			if ($_POST['customername'])
			{
				$this->controller->insertNewBillingInformation('CustomerName', $_POST['customername']);
			}
			if ($_POST['contactname'])
			{
				$this->controller->insertNewBillingInformation('ContactName', $_POST['contactname']);
			}
			if ($_POST['address'])
			{
				$this->controller->insertNewBillingInformation('Address', $_POST['address']);
			}
			if ($_POST['city'])
			{
				$this->controller->insertNewBillingInformation('City', $_POST['city']);
			}
			if ($_POST['postalcode'])
			{
				$this->controller->insertNewBillingInformation('PostalCode', $_POST['postalcode']);
			}
			if ($_POST['country'])
			{
				$this->controller->insertNewBillingInformation('Country', $_POST['country']);
			}
			
			echo "<script language='javascript'>
			window.location.href = 'reviewBillingInformation'
			</script>";
		}
		
        // public function today()
        // {
        //     return $this->controller->current();
        // }


    }