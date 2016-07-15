<?php

class Application_Model_Ug
{
	protected $_id;
	protected $_tensao;
	protected $_correnrte;
	protected $_ajuste;
	protected $_ajusteat;

	public function setId($id){
		return $_id = $id;
	}	

    public function getId(){
		return $this->_id;
    }

    public function setTensao($tensao){
		$this->_tensao = $tensao;
	}	

    public function getTensao(){
    	return $this->_tensao;
    }

}

