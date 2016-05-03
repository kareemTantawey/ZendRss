<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$authorization =Zend_Auth::getInstance();
        if(!$authorization->hasIdentity()) 
        {           
            $this->redirect("users/login");
        }else{
        	$this->redirect("index/list");
        }
    }

    public function addAction()
    {

      $authorization =Zend_Auth::getInstance();
        if(!$authorization->hasIdentity()) 
        {           
            $this->redirect("users/login");
        }

        $model = new Application_Model_Rss();
        $form = new Application_Form_Rss();
        $this->view->Rss =$form;
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {
                           
               $data = $form->getValues();
                echo "hello";

                $model->addRss($data);
                $this->redirect('index/list');        
            
            
            }
        }
        $this->view->form = $form;
        $this->render('add');

    }

    public function deleteAction()
    {
        $id = $this->_request->getParam("id");
        if (!empty($id)) {
            $user_model = new Application_Model_Rss();
            $user_model->deleteRss($id);
        }
        $this->redirect("index/list");
    }

    public function listAction()
    {
        // action body
        $authorization =Zend_Auth::getInstance();
        if(!$authorization->hasIdentity()) 
        {           
            $this->redirect("users/login");
        }


        $model = new Application_Model_Rss();
        $this->view->index = $model->listRss();
    }

    public function showAction()
    {
       // action body
      try{
            $rss_id = $this->_request->getParam("id");
            $this->model = new Application_Model_Rss();
            $url = $this->model->getRssById($rss_id);
            $feed = Zend_Feed_Reader::import($url[0]['url']);



		
        echo '<div class="container" >';
   		foreach ($feed as $entry) {
        $data = array(
           'title' => $entry->getTitle(),
           'link' => $entry->getLink(),
           'description' =>$entry->getDescription(),
           'dateModified' => $entry->getDateModified()

        );
        	echo '<div class="panel panel-default center">';
          echo "<center><strong><p class = 'text-success'>".$data['dateModified']."</p></strong></center>";
       		echo '<br>';
       		echo '<div class="panel-heading center">';
      	 	echo "<center>".$data['title']."</center>";
      		echo '<br>';
      		echo '<div class="panel-body center">';
      		echo "<center>".$data['description']."</center>";
      		echo '<br>';
      		echo "<center>".$data['link']."</center>";
      		echo '<br>';
      		echo '</div>';
      		echo '</div>';
      		echo '</div>';
      		
   		}
   		echo '</div>';

      }catch (Zend_Exception $e) {

          echo "<h4><center>"."Connection error or bad URL"."</center></h4>";
      }




	}

}





