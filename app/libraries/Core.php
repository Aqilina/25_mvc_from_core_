<?php
/* App Core class
 * Create URL & loads controller
 * URL format /controller/method/params
 */
class Core
{
    // nusistatom pradines nustatytasias reiksmes
    protected $currentController = 'Pages'; //JEI NERANDA REIKSMIU - NUKREIPIA CIA
    protected $currentMethod = 'index'; //IR CIA
    protected $params = [];

    public function __construct()
    {
        // print_r($this->getUrl());
//------------------------------------------------------------------------
//        KONTROLERIS
        $url = $this->getUrl();
        // check if user asked for controller AR KAZKA IVEDE PO PAGES
        if (isset($url[0])) {
            // Look into controllers dir for the controller name
            // if such file exists
            if (file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
                $this->currentController = ucfirst($url[0]);
                // clean value that was taken
                unset($url[0]);
            }
        }
        // Require the controller that user asked
        require_once '../app/controllers/' . $this->currentController . '.php';

        // instanciate an objec of current class
        // if entered pages
        // Pages = new Pages;

        $this->currentController = new $this->currentController; // SUKURIAMAS NAUJAS KONTROLERIO KLASES OBJEKTAS PAGAL "PAGES" KLASE

//----------------------------------------------------------------------------------------
//        METODAS
        // check for second(method) values in url params
        if (isset($url[1])) {
            // check if there is a method name in the class
            if (method_exists($this->currentController, $url[1])) { //AR TOKIAM OBJEKTE (PVZ, "PAGES") EGZISTUOJA TOKS METODAS
                $this->currentMethod = $url[1]; //JEI TAIP - PAKEICIAMA CURRENT METHOD REIKSME, NUSTATYTA AUKSCIAU
                // clean value that was taken
                unset($url[1]);
            }
        }

        // to test if it works
        // echo 'our current method is: ' . $this->currentMethod;
//---------------------------------------------------------------------------------------------------------
//        PARAMETRAI
        // Get params from url
        if (isset($url[2])) {
            $this->params = $url ? array_values($url) : []; //GRAZINAM VISA REIKSMES ARBA GRAZINAM NIEKO
//            $url lieka tik parametrai, nes kontroleris ir metodas unsetinti. galima rasyt begale - viskas keliaus i masyva
        }
        // print_r($this->params);

        // we call current controller and method and params if present

//        FUNKCIJOS, KURIOS PRASO ZMOGUS, ISKVIETIMAS
//        f-ja ima du parametrus: 1-mas - masyvas. parodo, kokioj klasej koki metoda norim iskviesti. 2-as - optional
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    // echo url parameter
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            // trim  slash from the right
            $url = rtrim($_GET['url'], '/');
            // sanitize url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // make url into array 
            $url = explode('/', $url);
            return $url;
        }
    }
}
