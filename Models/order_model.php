<?php 
declare(strict_types=1);

class OrderModel extends Model
{
  public function __construct()
  {
      $this->table_name = "orders";
      parent::__construct($this);
  }

  /**
   * Gets the customer order by the customer's order id
   * @return Data collection from orders, orderdetails, categories, and suppliers table.
   */
  public function getOrderById() 
  {
    $orderDetails = $this->oneToMany('orderdetails', 'OrderID', 'OrderID')
                          ->where('orders.CustomerID', '=', $_SESSION['user_id'])
                          ->get();

    // Adding Additional Properties To $orderDetails data collection
    $product_model = new ProductModel();
    $supplier_model = new SupplierModel();
    foreach($orderDetails as $od) {
      $pd = $product_model->oneToOne('categories', 'CategoryID', 'CategoryID')
                          ->where('ProductID', '=', $od->ProductID)
                          ->single(['CategoryName', 'ProductName', 'SupplierID', 'Unit', 'Price']);
  
      $od->CategoryName = $pd->CategoryName;
      $od->ProductName  = $pd->ProductName;
      $od->Unit         = $pd->Unit;
      $od->Price        = $pd->Price;
      $od->SupplierName = $supplier_model->where('SupplierID', '=', $pd->SupplierID)
                                         ->single()
                                         ->SupplierName;
    }

    return $orderDetails;

  }

  public function orders()
  {
    return $this->get();
  }

}