<?php
/**
* IndexController
*
* @author Badiul Valentin
* @version 1.0.0
*/ 

class IndexController extends BaseController {

    /**
    * indexAction
    *
    * @param  void
    * @return void
    */
    public function indexAction()
    {
        $method = Request::method();
        if ( Request::isMethod( 'post' ) ) {
            $imapLibrary = new ImapLibrary(
                $_POST['hostname'],
                $_POST['username'],
                $_POST['password'] 
            );
            $view = View::make('index');
            $view['array'] = $imapLibrary->getEmailsInfo() ? $imapLibrary->getEmailsInfo() : array();
            return $view;
        } else {
            $view = View::make('index');
            $view['array'] = array();
            return  $view;
        }  
    }
}