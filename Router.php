<?php

declare(strict_types=1);


class Router
{
    private $routes;

    public function __construct()
    {
        
    }

    function addRoute($name,$controller,$method,$auth=array(0,1,2,3,4,5))
    {
        if(isset($this->routes[$name]))
        {
            array_push($this->routes[$name], ["controller"=>$controller,"method"=>$method,"authorization"=>$auth]);
        }else{
            $this->routes[$name] = ["controller"=>$controller,"method"=>$method,"authorization"=>$auth];
        }
    }

    function routePage($name,$params)
    {
        
        $routes = $this->routes;
        if(isset($routes[$name]))
        {
         
            $authorized = FALSE;
            foreach ($routes[$name]["authorization"] as $key) {
                if($_SESSION["authorization"]==$key)
                {
                    $authorized = TRUE;
                }
            }
            if($authorized ==  FALSE)
            {
                header('HTTP/1.0 403 Forbidden');
                echo "<h1> 403 Forbidden </h1>";
                exit();
            }else{

               
                    $match=$routes[$name];
                    call_user_func_array(array(new $match["controller"], $match["method"]), $params);
                    $index = 0;
                    while(isset($match[$index]))
                    {
                        call_user_func_array(array(new $match[$index]["controller"], $match[$index]["method"]), $params);
                        $index++;
                    }
                
            }
        }else{
            header('HTTP/1.0 404 Not Found');
            echo "<h1> 404 Not Found </h1>";
            exit();

        }
    }
    
}


