<?php
class AuthController extends Zend_Controller_Action
{


    public function init()
    {
        /* Initialize action controller here */
       
    }

    public function indexAction()
    {
        // action body
        //$usuarios = new Application_Model_DbTable_Usuarios();
         //$a = $usuarios->fetchAll();
        // $this->view->dados = $a;
        $usuario = $_POST['input_usuario'];
        $senhamd5=md5($_POST['input_senha']);
        $senha=$_POST['input_senha'];
        //$data = $this->getRequest()->getPost();
       // $this->view->form = $data;
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
         //Dados do banco a serem referenciados
        $authAdapter->setTableName('usuarios');
        $authAdapter->setIdentityColumn('usuario');
        $authAdapter->setCredentialColumn('senha');
         //Dados do formulario a serem referenciados
        $authAdapter->setIdentity($usuario);
        $authAdapter->setCredential($senha);
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($authAdapter);
        if ($result->isValid()) 
        {
            # code...
            $this->view = 1;
            $info = $authAdapter->getResultRowObject(null, 'senha');
            $storage = $auth->getStorage();
            $storage->write($info);
            $this->_redirect('/menu');
        }else
        {
          $this->_redirect('/');

        }

    }

 
    public function logoutAction()
    {
    // action body
    $auth = Zend_Auth::getInstance();
    $auth->clearIdentity();
    Zend_Auth::getInstance()->clearIdentity();
    $this->_redirect('/public');
  
    }
}






