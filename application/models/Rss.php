<?php

class Application_Model_Rss extends Zend_Db_Table_Abstract
{

    protected $_name = 'rss';
    
    public function addRss($data)
    {
        $row = $this->createRow();

        $row->url = $data['url'];
        return $row->save();
    }



    function deleteRss($rssid){
        return $this->delete('id='.$rssid);
    }


    function listRss(){
        
        return $this->fetchAll()->toArray();
    }

    function getRssById($rssid){
        return $this->find($rssid)->toArray();
    }

}

