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