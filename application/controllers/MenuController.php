<?php

class MenuController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
        $auth = Zend_Auth::getInstance();
        $usuario = $auth->getIdentity();
        $this->view->usuario = $usuario->usuario;
        date_default_timezone_set('America/Cuiaba');
        $horario  =  date('H:i');
        $datahoje =  date('d-m-Y');
    }

    public function indexAction()
    {

        $dbconfiguracoes = new Application_Model_DbTable_Configuracoes();
        $result = $dbconfiguracoes->fetchAll();
        foreach ($result as $key => $value) {
            $datapesquisa = $value['dtpesqtab'];
        }
        $this->view->datapesquisa = $datapesquisa;

        $db01 =new Application_Model_DbTable_Ug01();
        $result = $db01->fetchAll("data=  '$datapesquisa'");
        $this->view->dados01 = $result;
        unset($db01);

        $db02 =new Application_Model_DbTable_Ug02();
        $result = $db02->fetchAll("data=  '$datapesquisa'");
        $this->view->dados02 = $result;
        unset($db02);
        
        $db03 =new Application_Model_DbTable_Ug03();
        $result = $db03->fetchAll("data=  '$datapesquisa'");
        $this->view->dados03 = $result;
        unset($db03);

        $dbcemat =new Application_Model_DbTable_Cemat();
        $result = $dbcemat->fetchAll("data=  '$datapesquisa'");
        $this->view->dadoscemat = $result;
        unset($dbcemat);

        //----------BANCO UG01 Alimenta Gráficos-------------------------------------
        $db01 =new Application_Model_DbTable_Ug01();
        $dadosug01 = $db01->fetchAll("data=  '$datapesquisa'");
        $this->view->dadosug01 = $dadosug01;
        unset($db01);
        //----------BANCO UG02 Alimenta Gráficos-------------------------------------
        $db02 =new Application_Model_DbTable_Ug02();
        $dadosug02 = $db02->fetchAll("data=  '$datapesquisa'");
        $this->view->dadosug02 = $dadosug02;
        unset($db02);
        //----------BANCO UG03  Alimenta Gráficos-------------------------------------
        $db03 =new Application_Model_DbTable_Ug03();
        $dadosug03 = $db03->fetchAll("data=  '$datapesquisa'");
        $this->view->dadosug03 = $dadosug03;
        unset($db03);
 
    }

    public function selecionarDadosUG02()
    {
        $db =new Application_Model_DbTable_Ug02();
        $result = $db->fetchAll();
        $this->view->dados = $result;
    }

    public function salvarugAction()
    {
    }

    public function graficosAction()
    {
        $dbconfiguracoes = new Application_Model_DbTable_Configuracoes();
        $result = $dbconfiguracoes->fetchAll();
        foreach ($result as $key => $value) {
            $datapesquisa = $value['dtpesqtab'];
        }


        $this->view->datapesquisa = $datapesquisa;


        //----------BANCO UG01 Alimenta Gráficos-------------------------------------
        $db01 =new Application_Model_DbTable_Ug01();
        $dadosug01 = $db01->fetchAll("data=  '$datapesquisa'");
        $this->view->dadosug01 = $dadosug01;
        unset($db01);
        //----------BANCO UG02 Alimenta Gráficos-------------------------------------
        $db02 =new Application_Model_DbTable_Ug02();
        $dadosug02 = $db02->fetchAll("data=  '$datapesquisa'");
        $this->view->dadosug02 = $dadosug02;
        unset($db02);
        //----------BANCO UG03  Alimenta Gráficos-------------------------------------
        $db03 =new Application_Model_DbTable_Ug03();
        $dadosug03 = $db03->fetchAll("data=  '$datapesquisa'");
        $this->view->dadosug03 = $dadosug03;
        unset($db03);

        $dbcemat =new Application_Model_DbTable_Cemat();
        $result = $dbcemat->fetchAll("data=  '$datapesquisa'");
        $this->view->dadoscemat = $result;
        unset($dbcemat);
    }

    public function deletarAction()
    {
        $ug = new Application_Model_DbTable_Ug02();
        $where = $ug->getAdapter()->quoteInto('id=?', $id);
        $ug->delete($where);
         unset($db02);
    }

    public function salvarug02Action()
    {
        $ug02 = new Application_Model_DbTable_Ug02();
        $auth = Zend_Auth::getInstance();
        date_default_timezone_set('America/Cuiaba');
		$horario  =  date('H:i');
		$datahoje =  date('d-m-Y');
        $tensao   = $_POST['v1'];
        $corrente = $_POST['v2'];
        $ajusteat = $_POST['v3'];
        $usuario  = $_POST['usuario'];
        $ajuste   = $_POST['v4'];
        $pativa   = $_POST['v5'];
        $preativa = $_POST['v6'];
        $paparente= $_POST['v7'];
        $fp       = $_POST['v8'];
        $ab       = $_POST['v9'];
        $a_kv     = $_POST['v10'];
        $b_kv     = $_POST['v11'];
        $v_kv     = $_POST['v12'];
        $a_a      = $_POST['v13'];
        $b_a      = $_POST['v14'];
        $v_a      = $_POST['v15'];
        $v        = $_POST['v16'];
        $i_a      = $_POST['v17'];
        $a_temp   = $_POST['v18'];
        $b_temp   = $_POST['v19'];
        $v_temp   = $_POST['v20'];
        $mtg      = $_POST['v21'];
        $mg_lna   = $_POST['v22'];
        $mte      = $_POST['v23'];
        $mtce     = $_POST['v24'];
        $gra      = $_POST['v25'];
        $uhrv_c   = $_POST['v26'];
        $uhrv_pmin= $_POST['v27'];
        $uhrv_pmax= $_POST['v28'];
        $uhlm_c   = $_POST['v29'];
        $uhlm_pres= $_POST['v30'];
        $dados = array(
        	            'horario'	 =>  $horario,
        	            'data'		 =>  $datahoje,
        	            'usuario'	 =>  $usuario,
                        'tensao'     =>  $tensao,
                        'corrente'   =>  $corrente,
                        'ajuste'     =>  $ajuste,
                        'ajusteat'   =>  $ajusteat,
                        'tensao'     =>  $tensao,
                        'corrente'   =>  $corrente,
                        'ajusteat'   =>  $ajusteat,
                        'pativa'     =>  $pativa,
                        'preativa'   =>  $preativa,
                        'paparente'  =>  $paparente,
                        'fp'         =>  $fp,
                        'ab'         =>  $ab,
                        'a_kv'       =>  $a_kv,
                        'b_kv'       =>  $b_kv,
                        'v_kv'       =>  $v_kv,
                        'a__a'       =>  $a_a,
                        'b_a'        =>  $b_a,
                        'v_a'        =>  $v_a,
                        'v'          =>  $v,
                        'i_a'        =>  $i_a,
                        'b_temp'     =>  $b_temp,
                        'a_temp'     =>  $a_temp,
                        'v_temp'     =>  $v_temp,
                        'mtg'        =>  $mtg,
                        'mg_lna'     =>  $mg_lna,
                        'mte'        =>  $mte,
                        'mtce'       =>  $mtce,
                        'gra'        =>  $gra,
                        'uhrv_c'     =>  $uhrv_c, 
                        'uhrv_pmin'  =>  $uhrv_pmin,
                        'uhrv_pmax'  =>  $uhrv_pmax,
                        'uhlm_c'     =>  $uhlm_c,
                        'uhlm_pres' =>  $uhlm_pres
        );
        $ug02->insert($dados);
        unset($db02);
        $this->_redirect('/menu');
    }

    public function salvarug03Action()
    {
        // action body
        $ug03 = new Application_Model_DbTable_Ug03();
        $auth = Zend_Auth::getInstance();
        date_default_timezone_set('America/Cuiaba');
		$horario  =  date('H:i');
		$datahoje =  date('d-m-Y');
        $tensao   = $_POST['v1'];
        $corrente = $_POST['v2'];
        $usuario  = $_POST['usuario'];
        $ajusteat = $_POST['v3'];
        $ajuste   = $_POST['v4'];
        $pativa   = $_POST['v5'];
        $preativa = $_POST['v6'];
        $paparente= $_POST['v7'];
        $fp       = $_POST['v8'];
        $ab       = $_POST['v9'];
        $a_kv     = $_POST['v10'];
        $b_kv     = $_POST['v11'];
        $v_kv     = $_POST['v12'];
        $a_a      = $_POST['v13'];
        $b_a      = $_POST['v14'];
        $v_a      = $_POST['v15'];
        $v        = $_POST['v16'];
        $i_a      = $_POST['v17'];
        $a_temp   = $_POST['v18'];
        $b_temp   = $_POST['v19'];
        $v_temp   = $_POST['v20'];
        $mtg      = $_POST['v21'];
        $mg_lna   = $_POST['v22'];
        $mte      = $_POST['v23'];
        $mtce     = $_POST['v24'];
        $gra      = $_POST['v25'];
        $uhrv_c   = $_POST['v26'];
        $uhrv_pmin= $_POST['v27'];
        $uhrv_pmax= $_POST['v28'];
        $uhlm_c   = $_POST['v29'];
        $uhlm_pres= $_POST['v30'];
        
        $dados = array(
        	            'horario'	 =>  $horario,
        	            'data'		 =>  $datahoje,
        	            'usuario'	 =>  $usuario,
                        'tensao'     =>  $tensao,
                        'corrente'   =>  $corrente,
                        'ajuste'     =>  $ajuste,
                        'ajusteat'   =>  $ajusteat,
                        'tensao'     =>  $tensao,
                        'corrente'   =>  $corrente,
                        'ajusteat'   =>  $ajusteat,
                        'pativa'     =>  $pativa,
                        'preativa'   =>  $preativa,
                        'paparente'  =>  $paparente,
                        'fp'         =>  $fp,
                        'ab'         =>  $ab,
                        'a_kv'       =>  $a_kv,
                        'b_kv'       =>  $b_kv,
                        'v_kv'       =>  $v_kv,
                        'a__a'       =>  $a_a,
                        'b_a'        =>  $b_a,
                        'v_a'        =>  $v_a,
                        'v'          =>  $v,
                        'i_a'        =>  $i_a,
                        'b_temp'     =>  $b_temp,
                        'a_temp'     =>  $a_temp,
                        'v_temp'     =>  $v_temp,
                        'mtg'        =>  $mtg,
                        'mg_lna'     =>  $mg_lna,
                        'mte'        =>  $mte,
                        'mtce'       =>  $mtce,
                        'gra'        =>  $gra,
                        'uhrv_c'     =>  $uhrv_c, 
                        'uhrv_pmin'  =>  $uhrv_pmin,
                        'uhrv_pmax'  =>  $uhrv_pmax,
                        'uhlm_c'     =>  $uhlm_c,
                        'uhlm_pres'  =>  $uhlm_pres

        );
        $ug03->insert($dados);
        unset($db03);
        $this->_redirect('/menu');
    }

    public function salvarug01Action()
    {
        // action body
        $ug01 = new Application_Model_DbTable_Ug01();


        date_default_timezone_set('America/Cuiaba');
		$horario  =  date('H:i');
		$anomesdia = date('Y-m-d');
		$datahoje = strtotime( $anomesdia);

        $tensao   = $_POST['v1'];
        $usuario  = $_POST['usuario'];
        $corrente = $_POST['v2'];
        $ajusteat = $_POST['v3'];
        $ajuste   = $_POST['v4'];
        $pativa   = $_POST['v5'];
        $preativa = $_POST['v6'];
        $paparente= $_POST['v7'];
        $fp       = $_POST['v8'];
        $ab       = $_POST['v9'];
        $a_kv     = $_POST['v10'];
        $b_kv     = $_POST['v11'];
        $v_kv     = $_POST['v12'];
        $a_a      = $_POST['v13'];
        $b_a      = $_POST['v14'];
        $v_a      = $_POST['v15'];
        $v        = $_POST['v16'];
        $i_a      = $_POST['v17'];
        $a_temp   = $_POST['v18'];
        $b_temp   = $_POST['v19'];
        $v_temp   = $_POST['v20'];
        $mtg      = $_POST['v21'];
        $mg_lna   = $_POST['v22'];
        $mte      = $_POST['v23'];
        $mtce     = $_POST['v24'];
        $gra      = $_POST['v25'];
        $uhrv_c   = $_POST['v26'];
        $uhrv_pmin= $_POST['v27'];
        $uhrv_pmax= $_POST['v28'];
        $uhlm_c   = $_POST['v29'];
        $uhlm_pres= $_POST['v30'];
        
        $dados = array(
        	            'horario'	 =>  $horario,
        	            'data'		 => (string)  $anomesdia,
        	            'usuario'	 =>  $usuario,
                        'tensao'     =>  $tensao,
                        'corrente'   =>  $corrente,
                        'ajuste'     =>  $ajuste,
                        'ajusteat'   =>  $ajusteat,
                        'tensao'     =>  $tensao,
                        'corrente'   =>  $corrente,
                        'ajusteat'   =>  $ajusteat,
                        'pativa'     =>  $pativa,
                        'preativa'   =>  $preativa,
                        'paparente'  =>  $paparente,
                        'fp'         =>  $fp,
                        'ab'         =>  $ab,
                        'a_kv'       =>  $a_kv,
                        'b_kv'       =>  $b_kv,
                        'v_kv'       =>  $v_kv,
                        'a__a'       =>  $a_a,
                        'b_a'        =>  $b_a,
                        'v_a'        =>  $v_a,
                        'v'          =>  $v,
                        'i_a'        =>  $i_a,
                        'b_temp'     =>  $b_temp,
                        'a_temp'     =>  $a_temp,
                        'v_temp'     =>  $v_temp,
                        'mtg'        =>  $mtg,
                        'mg_lna'     =>  $mg_lna,
                        'mte'        =>  $mte,
                        'mtce'       =>  $mtce,
                        'gra'        =>  $gra,
                        'uhrv_c'     =>  $uhrv_c, 
                        'uhrv_pmin'  =>  $uhrv_pmin,
                        'uhrv_pmax'  =>  $uhrv_pmax,
                        'uhlm_c'     =>  $uhlm_c,
                        'uhlm_pres'  =>  $uhlm_pres
        );
        $ug01->insert($dados);
        unset($db01);
        $this->_redirect('/menu');
    }

    public function salvardadoscematAction()
    {
        // action body
     
        $cemat = new Application_Model_DbTable_Cemat();

        date_default_timezone_set('America/Cuiaba');
        $horario  =  date('H:i');
        $anomesdia = date('Y-m-d');
        $datahoje = strtotime( $anomesdia);

        $usuario            = $_POST['usuario'];
        $data               = (string) $anomesdia;
        $horario            = $horario;
        $nivel_canal        = $_POST['v1'];
        $usina_a_kv         = $_POST['v2'];
        $usina_b_kv         = $_POST['v3'];
        $usina_v_kv         = $_POST['v4'];
        $usina_a_a          = $_POST['v5'];
        $usina_b_a          = $_POST['v6'];
        $usina_v_a          = $_POST['v7'];
        $usina_p_kw         = $_POST['v8'];
        $usina_q_kvar       = $_POST['v9'];
        $usina_f_kva        = $_POST['v10'];
        $usina_fp           = $_POST['v11'];
        $medicao_p_kw       = $_POST['v12'];
        $medicao_q_kvar     = $_POST['v13'];
        $medicao_s_kva      = $_POST['v14'];
        $medicao_fp         = $_POST['v15'];
        $medicao_v          = $_POST['v16'];
        $servaux_v_v        = $_POST['v17'];
        $servaux_i_a        = $_POST['v18'];
        $retificador_vcc    = $_POST['v19'];
        $retificador_la     = $_POST['v20'];
        $retificador_lb     = $_POST['v21'];
        $retificador_lc     = $_POST['v22'];
               
        $dadoscemat = array (
        'usuario'         => $usuario, 
        'data'            => $data, 
        'horario'         => $horario, 
        'nivel_canal'     => $nivel_canal, 
        'usina_a_kv'      => $usina_a_kv, 
        'usina_b_kv'      => $usina_b_kv, 
        'usina_v_kv'      => $usina_v_kv, 
        'usina_a_a'       => $usina_a_a, 
        'usina_b_a'       => $usina_b_a, 
        'usina_v_a'       => $usina_v_a, 
        'usina_p_kw'      => $usina_p_kw, 
        'usina_q_kvar'    => $usina_q_kvar, 
        'usina_f_kva'     => $usina_f_kva, 
        'usina_fp'        => $usina_fp, 
        'medicao_p_kw'    => $medicao_p_kw, 
        'medicao_q_kvar'  => $medicao_q_kvar, 
        'medicao_s_kva'   => $medicao_s_kva, 
        'medicao_fp'      => $medicao_fp, 
        'medicao_v'       => $medicao_v, 
        'servaux_v_v'     => $servaux_v_v, 
        'servaux_i_a'     => $servaux_i_a, 
        'retificador_vcc' => $retificador_vcc, 
        'retificador_la'  => $retificador_la, 
        'retificador_lb'  => $retificador_lb, 
        'retificador_lc'  => $retificador_lc
        );
        $cemat->insert($dadoscemat);
        unset($cemat);
        $this->_redirect('/menu');
    }

    public function configuracoesAction()
    {
    }

    public function salvarconfiguracoesAction()
    {
        // action body
        $dtpesqtab   = $_POST['dtpesq'];
        $dtpesqper01 = $_POST['dtpesqperiodo1'];
        $dtpesqper02 = $_POST['dtpesqperiodo2'];

         
        $dados = array(
                        'dtpesqtab'      => date("Y-m-d", strtotime($dtpesqtab)),
                        'dt01_sm_pestab' => date("Y-m-d", strtotime($dtpesqper01)),
                        'dt02_sm_pestab' => date("Y-m-d", strtotime($dtpesqper02))
                );
        $id=1; //gambiarra, não precisava, deixei por preguiça
        $dbconf = new Application_Model_DbTable_Configuracoes();
        $where = $dbconf->getAdapter()->quoteInto('id = ?', $id);
        $this->view->data = $dtpesqtab;
        $linhasatualizadas =  $dbconf->update($dados, $where);
        $this->_redirect('/menu');

        // $config = array('auth' => 'login',
        //            'ssl' => 'ssl',
        //            'port'=> 465,
        //            'username' => 'dionejpmc@gmail.com',
        //            'password' => '**********');

        // $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
        // $mail = new Zend_Mail("UTF-8");

        // $mail->setBodyText('Teste de Envio de email.');
       
        // $mail->addTo('dionejpmc@gmail.com', 'João');
        // $mail->setSubject('TestSubject');
        // $mail->send($transport);
    }

    public function menuAction()
    {
        // action body
    }
}



























