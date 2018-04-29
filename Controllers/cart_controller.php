<?php 
declare(strict_types=1);

class CartController
{


    private $view;
    private $model;

    public function __construct()
    {
        $this->view = new CartView();
        $this->model = new CartModel();
    }


    public function displayCart()
    {
        
        $product = new ProductModel();
        $products = $product->get();
        $items = [];
        $items['product'] = [];
        $items['quantity'] = [];
        $cart = null;
        $guest = null;
        $callCookie = false;
        if(isset($_SESSION['user_id']))
        {
            $cart = $this->getUserCart();
            $guest = $this->getGuestCart();

            $prodMod = new ProductModel();
            $prod = $prodMod->get();
            $length = count($prod);
            
            foreach ($prod as $p) { 
                $cart[$p->ProductID] += $guest[$p->ProductID];
                $guest[$p->ProductID] = 0;
            }
            
            $callCookie = true;
           
            setcookie('user_cart_'.$_SESSION['user_id'],json_encode($cart) , time() + (86400 * 30), "/");
            setcookie('guest_cart', json_encode($guest) , time() + (86400 * 30), "/");


        }
        else
        {
            $cart = $this->getGuestCart();
            setcookie('guest_cart', json_encode($cart) , time() + (86400 * 30), "/");
        }

        foreach ($products as $p) {
            $id = $p->ProductID;
            if(isset($cart[$id]))
            {
                if($cart[$id]>0)
                {

                    array_push($items['product'],$p);
                    array_push($items['quantity'],[$id => $cart[$id]]);
                }
            }
        }

        $this->view->items($items);

      
        

    }

    public function addCart($id)
    {

        if(isset($_SESSION['user_id']))
        {
            $prodModel = new ProductModel();
            $inStock = $prodModel->where('ProductID','=',$id)->single();
            $items = $this->getUserCart();
            $items[$id]+=1;
            if($inStock->Quantity>=$items[$id])
            {

            }else{
                $items[$id] = $inStock->Quantity; 
            }

            setcookie('user_cart_'.$_SESSION['user_id'], json_encode($items) , time() + (86400 * 30), "/");
        }
        else
        {
            $prodModel = new ProductModel();
            $inStock = $prodModel->where('ProductID','=',$id)->single();
            $items = $this->getGuestCart();
            $items[$id]+=1;
            if($inStock->Quantity>=$items[$id])
            {

            }else{
                $items[$id] = $inStock->Quantity; 
            }
               
            setcookie('guest_cart', json_encode($items) , time() + (86400 * 30), "/");
        }

      header('Location: ./products');
  }






private function createGuestCartIfNotExists()
{


    $product = new ProductModel();
    $products= $product->get();
    $items = [];
    foreach($products as $p) { 
        $items[$p->ProductID] = 0;
    }

    return $items;
}


private function createUserCartIfNotExists()
{


    $product = new ProductModel();            
    $products = $product->get();
    $cart = [];
    foreach($products as $p) { 
        $cart[$p->ProductID] = 0;
    }
    return $cart;
}

public function displayCheckout()
{
    $userModel = new UserModel();
    $user_info = $userModel->oneToOne('customers', 'user_id', 'CustomerID')
    ->where('customers.UserID', '=', $_SESSION['user_id'])
    ->single();
    if ($user_info == null) {
        $_SESSION['DashboardContent'] .= '<b style="color:red"> (Fill out to begin adding products to our site!)</b>';
        header('Location: ./dashboard');
        return;
    } 
    if(!isset($_SESSION['user_id'])) { header('Location: ./login'); }
    $product = new ProductModel();
    $products = $product->get();
    $items = [];
    $items['product'] = [];
    $items['quantity'] = [];

    $cart = $this->getUserCart();

    foreach ($products as $p) {
        $id = $p->ProductID;
        if(isset($cart[$id]))
        {
            if($cart[$id]>0)
            {

                array_push($items['product'],$p);
                array_push($items['quantity'],[$id => $cart[$id]]);
            }
        }
    }

    $this->view->checkout($items);
}

public function getUserCart()
{
if(isset($_COOKIE['user_cart_'.$_SESSION['user_id']]))
{
$items = $_COOKIE['user_cart_'.$_SESSION['user_id']];


for ($i = 0; $i <= 31; ++$i) { 
    $items= str_replace(chr($i), "", $items); 
}
$items = str_replace(chr(127), "", $items);


if (0 === strpos(bin2hex($items), 'efbbbf')) {
   $items= substr($items, 3);
}

$items = json_decode($items,true);

return $items;
}

return $this->createUserCartIfNotExists();

}

public function getGuestCart()
{
$items = null;
if(isset($_COOKIE['guest_cart']))
{
$items = $_COOKIE['guest_cart'];


for ($i = 0; $i <= 31; ++$i) { 
    $items= str_replace(chr($i), "", $items); 
}
$items = str_replace(chr(127), "", $items);

if (0 === strpos(bin2hex($items), 'efbbbf')) {
   $items= substr($items, 3);
}

$items = json_decode($items,true);


}
else
{
    $prodMod = new ProductModel();
    $prod = $prodMod->get();
    $length = count($prod);
    
    foreach($prod as $p)
    {
        $items[$p->ProductID] = 0;
    }

    setcookie('guest_cart', json_encode($items) , time() + (86400 * 30), "/");
}

return $items;
}
public function getWishlist()
{
$items = null;
if(isset($_COOKIE['wishlist_'.$_SESSION['user_id']]))
{
$items = $_COOKIE['wishlist_'.$_SESSION['user_id']];


for ($i = 0; $i <= 31; ++$i) { 
    $items= str_replace(chr($i), "", $items); 
}
$items = str_replace(chr(127), "", $items);

if (0 === strpos(bin2hex($items), 'efbbbf')) {
   $items= substr($items, 3);
}

$items = json_decode($items,true);

}else{
    $prodMod = new ProductModel();
    $length = count($prodMod->get());
    for ($i=0; $i < $length; $i++) { 
        
        $items[$i+1] = 0;
    }

    setcookie('wishlist_'.$_SESSION['user_id'], json_encode($items) , time() + (86400 * 30), "/");
}

return $items;
}


public function displayWishlist()
{
    if(!isset($_SESSION['user_id'])) { header('Location: ./login'); }
    $product = new ProductModel();
    $products = $product->get();
    $items = [];
    $items['product'] = [];
    $wish = $this->getWishlist();

    foreach ($products as $p) {
        $id = $p->ProductID;

        if($wish[$id]>0)
        {
            array_push($items['product'],$p);
        }
        
    }

    $this->view->wishlist($items);
}

public function addWish($id)
{
    if(!isset($_SESSION['user_id'])) { header('Location: ./login'); }

    $items = $this->getWishlist();

    if($items[$id]==0)
    {
        $items[$id] = 1;
    } 

    setcookie('wishlist_'.$_SESSION['user_id'], json_encode($items) , time() + (86400 * 30), "/");

    header('Location: ./products');
}

public function removeWish($id)
{
     $items = $this->getWishlist();

    if($items[$id]==1)
    {
        $items[$id] = 0;
    } 

    setcookie('wishlist_'.$_SESSION['user_id'], json_encode($items) , time() + (86400 * 30), "/");

    header('Location: ./wishlist');
}

public function confirmCheckout()
{
    $cart = $this->getUserCart();

    $orderMod = new OrderModel();
    $orderDetMod = new OrderdetailModel();
    $prodMod = new ProductModel();
    $index = 1;

    $orderMod->CustomerID = $_SESSION['user_id'];
    $orderMod->EmployeeID = 0;
    $orderMod->ShipperID = 0;
    $orderMod->OrderDate = date('y-m-d');
    $orderMod->OrderStatus = 0;
    $orderMod->save();

    $lastId = $orderMod->lastInsertId();
    foreach ($cart as $item) {
        
        if( $item > 0) {

            $orderDetMod->OrderID = $lastId;
            $orderDetMod->ProductID = $index;
            $orderDetMod->Quantity = $item;
            $orderDetMod->save();
        }
        $product = $prodMod->where('ProductID','=', $index)->single();
        $quantity = $product->Quantity - $item;
        $prodMod->Quantity = $quantity;
        $prodMod->where('ProductID','=',$index)->save();
        $cart[$index] = 0;
        $index++;
    }

     setcookie('user_cart_'.$_SESSION['user_id'], json_encode($cart) , time() + (86400 * 30), "/");
     header('Location: ./login');
}

public function updateCart($p=null)
{

    if($p == null){ header('Location: ./cart');}

        if(!isset($_SESSION['user_id']))
        {
            $items = $this->getGuestCart();
            $index = 0;
            for ($i=1; $i < count($items) ; $i++) { 

                if($items[$i] > 0)
                {
                    if($p[$index] == null)
                    {
                            $items[$i] = 0;
                    }
                    else
                    {
                        $prodModel = new ProductModel();
                        $inStock = $prodModel->where('ProductID','=',$i)->single();
                        if($inStock->Quantity>=$p[$index])
                        {
                            $items[$i] = $p[$index];
                        }else{
                            $items[$i] = $inStock->Quantity; 
                        }
                    }
                    $index++;                        
                }
            }
            
            setcookie('guest_cart', json_encode($items) , time() + (86400 * 30), "/");

        }else{

            if(isset($_SESSION['user_id']))
            {
                $items = $this->getUserCart();

                $index = 0;
                for ($i=1; $i < count($items) ; $i++) { 

                    if($items[$i] > 0)
                    {
                        if($p[$index] == null)
                        {
                            $items[$i] = 0;
                        }
                        else
                        {
                            $prodModel = new ProductModel();
                            $inStock = $prodModel->where('ProductID','=',$i)->single();
                            if($inStock->Quantity>=$p[$index])
                            {
                                $items[$i] = $p[$index];
                            }else{
                                $items[$i] = $inStock->Quantity; 
                            }
                        }
                        $index++;
                    }
                }

                setcookie('user_cart_'.$_SESSION['user_id'], json_encode($items) , time() + (86400 * 30), "/");

            }



        }

        header('Location: ./cart');

    }



    



}