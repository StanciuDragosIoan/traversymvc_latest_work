<?php
    /*
     * App Core Class
     * Creates URL & loads Core controller
     * URL FORMAT: /controller/method/params
     */

    class Core
    {
        protected $currentController = "Pages";
        protected $currentMethod = "index";
        protected $params = [];

        public function __construct()
        {
        //    print_r($this->getUrl());
            $url = $this->getUrl();

            //look in controllers directory for  controller corresponding to 1st value of $url array
            if(file_exists("../app/controllers/" . ucwords($url[0]) . ".php")){
                //set it as current controller
                $this->currentController = ucwords($url[0]);
                //unset 0 index of $url 
                unset($url[0]);
            }



            //require currentController 
            require_once "../app/controllers/" . $this->currentController . ".php";

            //instantiate currentController
            $this->currentController = new $this->currentController;

            //check 2nd param (method)
            if(isset($url[1])){
                //check if method exists in currentController
                if(method_exists($this->currentController, $url[1])){
                    //set method as currentMethod
                    $this->currentMethod = $url[1];
                    //unset $url[1]
                    unset($url[1]);
                }
            }

            //map params (rest of url elements)
            $this->params = $url ? array_values($url) : [];

            //call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);


            // echo$url[1];
        }


        public function getUrl()
        {   
            if(isset($_GET['url'])){
                //strip ending / (if there is 1)
                $url = rtrim($_GET['url'], '/');
                //sanitize $url as an actual url (remove chars not specific to url)
                $url = filter_var($url, FILTER_SANITIZE_URL);
                //break url into array at each /
                $url = explode('/', $url);
                return $url;
            }
            
        }
    }