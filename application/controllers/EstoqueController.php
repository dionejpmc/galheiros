<?php

class EstoqueController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
    public function indexAction()
    {
        // action body
        $db = new Application_Model_DbTable_Estoque();
        $result = $db->fetchAll();
        $this->view->itens =  $result;
        unset($db);
    }

    public function salvaritenAction()
    {
        date_default_timezone_set('America/Cuiaba');
        $horario  =  date('H:i');
        $datahoje =  date('Y-m-d');
        $auth = Zend_Auth::getInstance();
        $usuario = $auth->getIdentity();
        $id = 0;
        $id = $_POST['id'];
        $qtde = $_POST['qtde'];
        $movimento = $_POST['movimento'];
        $user[1] =  $usuario->usuario;
        $dbitens = new Application_Model_DbTable_Estoque();
        $dados =  array('qtde' => new Zend_Db_Expr('qtde +'.$qtde));
        $dbitens = new Application_Model_DbTable_Estoque();
        $where = $dbitens->getAdapter()->quoteInto('id = ?', $id);
        $dbitens->update($dados, $where);
        $dbitemmovimento = new Application_Model_DbTable_Itemmovimento();
        $dadosim =  array('iditemextrangeiro'    => $id,
                          'movimento' => $movimento,
                          'log'       => (string) $datahoje .$horario . $user[1]
         );
        $dbitemmovimento->insert($dadosim);
        $this->_redirect('/estoque');
    }

    public function novoitemAction()
    {
        date_default_timezone_set('America/Cuiaba');
        $horario  =  date('H:i');
        $datahoje =  date('d-m-Y');
        $auth = Zend_Auth::getInstance();
        $usuario = $auth->getIdentity();
        $qtde      = 0;
        $descricao = $_POST['descricao'];
        $aplicavel = $_POST['aplicavel'];
        $movimento = $_POST['movimento'];
        $user[1] =  $usuario->usuario;
        $dados = array(
                        'qtde'       => $qtde,
                        'descricao'  => $descricao,
                        'aplicavel'  => $aplicavel
                );
        $dbitens = new Application_Model_DbTable_Estoque();
        $dbitens->insert($dados);
        $dbitemmovimento = new Application_Model_DbTable_Itemmovimento();
        $dadosim =  array('iditemextrangeiro' => 0,
                          'movimento' => $movimento,
                          'log'       => (string) $datahoje ."</>" . $horario . "</>". $user[1]
                    );
        $dbitemmovimento->insert($dadosim);
        unset($dbitens);
        $this->_redirect('/estoque');   
    }
    public function excluirlinhaAction()
    {
        date_default_timezone_set('America/Cuiaba');
        $horario  =  date('H:i');
        $datahoje =  date('d-m-Y');
        $auth = Zend_Auth::getInstance();
        $usuario = $auth->getIdentity();
        $id = 0;
        $id = $_POST['id'];
        $qtde = $_POST['qtde'];
        $movimento = $_POST['movimento'];
        $user[1] =  $usuario->usuario;
        $db = New Application_Model_DbTable_Estoque();
        $where = $db->getAdapter()->quoteInto('id=?', $id);
        $db->delete($where);
        $dbitemmovimento = new Application_Model_DbTable_Itemmovimento();
        $dadosim =  array('iditemextrangeiro' => $id,
                          'movimento' => $movimento,
                          'log'       => (string) $datahoje ."</>" . $horario . "</>". $user[1]
         );
        $dbitemmovimento->insert($dadosim);
        unset($dbitemmovimento);
        unset($db);
        $this->_redirect('/estoque');
    }
    public function decrementaritemAction()
    {
        date_default_timezone_set('America/Cuiaba');
        $horario  =  date('H:i');
        $datahoje =  date('d-m-Y');
        $auth = Zend_Auth::getInstance();
        $usuario = $auth->getIdentity();
        $id = 0;
        $id = $_POST['id'];
        $qtde = $_POST['qtde'];
        $movimento = $_POST['movimento'];
        $user[1] =  $usuario->usuario;
        $dbitens = new Application_Model_DbTable_Estoque();
        $m = "Essa quantidade gera valor negativo em estoque";
        $this->view->message = $m;
        $dados =  array('qtde' => new Zend_Db_Expr('qtde -'.$qtde));
        $dbitens = new Application_Model_DbTable_Estoque();
        $where = $dbitens->getAdapter()->quoteInto('id = ?', $id);
        $dbitens->update($dados, $where);
        $dbitemmovimento = new Application_Model_DbTable_Itemmovimento();
        $dadosim =  array('iditemextrangeiro'    => $id,
                          'movimento' => $movimento,
                          'log'       => (string) $datahoje ."#" . $horario . "#". $user[1]
        );
        $dbitemmovimento->insert($dadosim);
        unset($dbitens);
        unset($dbitemmovimento);
        $this->_redirect('/estoque');
    }
    public function extornaritemAction()
    {
        // action body
        date_default_timezone_set('America/Cuiaba');
        $horario  =  date('H:i');
        $datahoje =  date('d-m-Y');
        $auth = Zend_Auth::getInstance();
        $usuario = $auth->getIdentity();
        $id = 0;
        $id = $_POST['id'];
        $qtde = $_POST['qtde'];
        $movimento = $_POST['movimento'];
        $user[1] =  $usuario->usuario;
        $dbitens = new Application_Model_DbTable_Estoque();
        $dados =  array('qtde' => new Zend_Db_Expr('qtde +'.$qtde));
        $dbitens = new Application_Model_DbTable_Estoque();
        $where = $dbitens->getAdapter()->quoteInto('id = ?', $id);
        $dbitens->update($dados, $where);
        $dbitemmovimento = new Application_Model_DbTable_Itemmovimento();
        $dadosim =  array('iditemextrangeiro'    => $id,
                          'movimento' => $movimento,
                          'log'       => (string) $datahoje ."#" . $horario . "#". $user[1]
         );
        $dbitemmovimento->insert($dadosim);
        $this->_redirect('/estoque');
    }


}