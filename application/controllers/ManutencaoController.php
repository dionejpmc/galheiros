<?php

class ManutencaoController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
        // action body
        $ug01 = new Application_Model_DBTable_Hmanutug01();
        $result = $ug01->fetchAll();
        $this->view->totalhoras01 = $result;
        unset($ug01);

        $ug02 = new Application_Model_DBTable_Hmanutug02();
        $result = $ug02->fetchAll();
        $this->view->totalhoras02 = $result;
        unset($ug02);

        $ug03 = new Application_Model_DBTable_Hmanutug03();
        $result = $ug03->fetchAll();
        $this->view->totalhoras03 = $result;
        unset($ug03);
    }

    public function cadastrarhorasAction()
    {
    }

    public function cadastrarhoras01Action()
    {
        // action body
        $ug01 = new Application_Model_DBTable_Hmanutug01();

        date_default_timezone_set('America/Cuiaba');
        $horario  =  date('H:i');
          $datahoje =  date('Y-m-d');
        
        $auth = Zend_Auth::getInstance();
        $usuario = $auth->getIdentity();
        $user[1] =  $usuario->usuario;
        $log =(String ) $horario  . "</>". $user[1];


        $horas = $_POST['tempoadd'];
        $tipoparada = $_POST['tipoparada'];
        $just = $_POST['text01'];
        
        $dados = array(
                    'horas'     => $horas,
                    'log'       => $log,
                    'tipoparada'=> $tipoparada,
                    'justificativa' => $just,
                    'datacad'   => $datahoje
                 );
        $ug01->insert($dados);
        unset($ug01);
        $this->_redirect('/manutencao');
    }

    public function cadastrarhoras02Action()
    {
        // action body
        $ug02 = new Application_Model_DBTable_Hmanutug02();

        date_default_timezone_set('America/Cuiaba');
        $horario  =  date('H:i');
        $datahoje =  date('Y-m-d');
        
        $auth = Zend_Auth::getInstance();
        $usuario = $auth->getIdentity();
        $user[1] =  $usuario->usuario;
        $log =(String ) $horario  . "</>". $user[1];

        $horas = $_POST['tempoadd'];
        $tipoparada = $_POST['tipoparada'];
        $just = $_POST['text02'];
        $dados = array(
                    'horas'     => $horas,
                    'log'       => $log,
                    'tipoparada'=> $tipoparada,
                    'justificativa' => $just,
                    'datacad'   => $datahoje
                 );
        $ug02->insert($dados);
    
        $this->_redirect('/manutencao');
        unset($ug02);
    }

    public function cadastrarhoras03Action()
    {
        // action body
        $ug03 = new Application_Model_DBTable_Hmanutug03();

        date_default_timezone_set('America/Cuiaba');
        $horario  =  date('H:i');
        $datahoje =  date('Y-m-d');
        
        $auth = Zend_Auth::getInstance();
        $usuario = $auth->getIdentity();
        $user[1] =  $usuario->usuario;
        $log =(String ) $horario  . "</>". $user[1];

        $horas = $_POST['tempoadd'];
        $tipoparada = $_POST['tipoparada'];
        $just = $_POST['text03'];
        
        $dados = array(
                    'horas'     => $horas,
                    'log'       => $log,
                    'tipoparada'=> $tipoparada,
                    'justificativa' => $just,
                    'datacad'   => $datahoje
                );
        $ug03->insert($dados);
        unset($ug03);
        $this->_redirect('/manutencao');
    }

    public function estatisticasparadasAction()
    {
            $dbconfiguracoes = new Application_Model_DbTable_Configuracoes();
            $resultx= $dbconfiguracoes->fetchAll();
            foreach ($resultx as $key => $valuex) {
                $datapesquisadia =$valuex['dtpesqtab'];
                $dt01sm =  $valuex['dt01_sm_pestab'];
                $dt02sm =  $valuex['dt02_sm_pestab'];
            }
            //converte formato Y-m-d para d-m-Y  
            $datapesquisa =$datapesquisadia;
            $ug01 = new Application_Model_DBTable_Hmanutug01();
            //SELEÇÃO DOS EVENTOS DIÁRIOS
            $result01 = $ug01->fetchAll("datacad = '$datapesquisa'");                                                                                                                                                        
            //=============================EVENTOS DIÁRIOS================================================
            //Zerando variaveis
            $totalhorasparadas01 =0;
            $numtotalparadaseletricas =0;
            $totalhoraseletricas01=0;

            $totalhorasmecanicas01=0;
            $numtotalparadasmecanicas =0;

            $totalhorasprogramadas01=0;
            $numtotalparadasprogramadas =0;  

            $totalhorastrip01=0;
            $numtotalparadastrip =0;    

            $totalhorasforcadas01=0;
            $numtotalparadasforcadas =0;   

            $totalhorasoperacional01=0;
            $numtotalparadasoperacional =0;   

            $totalhorasexterna01=0;
            $numtotalparadasexterna =0;   

            $totalhorasautomacao01=0;
            $numtotalparadasautomacao =0; 
            
            foreach ($result01 as $key => $value) {
                    list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                    $totalhorasparadas01 +=  (($h * 60) + ($m) );
                    switch ($value['tipoparada']) {
                        case 'ELÉTRICA':
                            $numtotalparadaseletricas = $numtotalparadaseletricas + 1;
                            list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                            $totalhoraseletricas01 +=  (($h * 60) + ($m) );
                            break;
                        case 'MECÂNICA':
                            $numtotalparadasmecanicas = $numtotalparadasmecanicas + 1;
                            list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                            $totalhorasmecanicas01 +=  (($h * 60) + ($m) );
                            break;
                        case 'PROGRAMADA':
                            $numtotalparadasprogramadas = $numtotalparadasprogramadas + 1;
                            list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                            $totalhorasprogramadas01 +=  (($h * 60) + ($m) );
                            break;
                        case 'TRIP':
                            $numtotalparadastrip = $numtotalparadastrip + 1;
                            list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                            $totalhorastrip01 +=  (($h * 60) + ($m) );
                            break;
                        case 'FORÇADA':
                            $numtotalparadasforcadas = $numtotalparadasforcadas + 1;
                            list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                            $totalhorasforcadas01 +=  (($h * 60) + ($m) );
                            break;
                        case 'OPERACIONAL':
                            $numtotalparadasoperacional = $numtotalparadasoperacional + 1;
                            list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                            $totalhorasoperacional01 +=  (($h * 60) + ($m) );
                            break;
                        case 'EXTERNA':
                            $numtotalparadasexterna = $numtotalparadasexterna + 1;
                            list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                            $totalhorasexterna01 +=  (($h * 60) + ($m) );
                            break;
                        case 'AUTOMAÇÃO':
                            $numtotalparadasautomacao = $numtotalparadasautomacao + 1;
                            list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                            $totalhorasautomacao01 +=  (($h * 60) + ($m) );
                            break;
                        default:
                             
                             break;
                    }
            }
            $this->view->dtpesqdia                   =  $datapesquisa  ;
            $this->view->dtpesqdiaH                  =  $datapesquisa  ;
            $this->view->dados01                     =  $result01;
            $this->view->totalhorasparadas01         =  $totalhorasparadas01;

            $this->view->paradasautomacao            =  $numtotalparadasautomacao;
            $this->view->totalhorasautomacao01       =  $totalhorasautomacao01;
            if ($totalhorasautomacao01!=0 && $totalhorasparadas01!=0) {
                 $this->view->percentualautomacao01       =  $totalhorasautomacao01/$totalhorasparadas01;
            }
           

            $this->view->paradaseletricas01          =  $numtotalparadaseletricas;
            $this->view->totalhoraseletricas01       =  $totalhoraseletricas01;
            $this->view->percentualeletrica01        =  $totalhoraseletricas01/$totalhorasparadas01;

            $this->view->paradasmecanicas            =  $numtotalparadasmecanicas;
            $this->view->totalhorasmecanicas01       =  $totalhorasmecanicas01;
            $this->view->percentualmecanica01        =  $totalhorasmecanicas01/$totalhorasparadas01;

            $this->view->paradasprogramadas          =  $numtotalparadasprogramadas;
            $this->view->totalhorasprogramadas01     =  $totalhorasprogramadas01;
            $this->view->percentualprogramada01      =  $totalhorasprogramadas01/$totalhorasparadas01;

            $this->view->paradastrip                 =  $numtotalparadastrip;
            $this->view->totalhorastrip01            =  $totalhorastrip01;
            $this->view->percentualtrip01            =  $totalhorastrip01/$totalhorasparadas01;

            $this->view->paradasforcadas             =  $numtotalparadasforcadas;
            $this->view->totalhorasforcadas01        =  $totalhorasforcadas01;
            $this->view->percentualforcada01         =  $totalhorasforcadas01/$totalhorasparadas01;

            $this->view->paradasoperacional          =  $numtotalparadasoperacional;
            $this->view->totalhorasoperacional01     =  $totalhorasoperacional01;
            $this->view->percentualoperacional01     =  $totalhorasoperacional01/$totalhorasparadas01;

            $this->view->paradasexterna              =  $numtotalparadasexterna;
            $this->view->totalhorasexterna01         =  $totalhorasexterna01;
            $this->view->percentualexterna01         =  $totalhorasexterna01/$totalhorasparadas01;
            
            //-----------------------------------------------------------------------------------------------------
            //=============================EVENTOS SEMANAIS========================================================
            $smtotalhorasparadas01 =0;

            $smnumtotalparadaseletricas =0;
            $smtotalhoraseletricas01=0;

            $smtotalhorasmecanicas01=0;
            $smnumtotalparadasmecanicas =0;

            $smtotalhorasprogramadas01=0;
            $smnumtotalparadasprogramadas =0;  

            $smtotalhorastrip01=0;
            $smnumtotalparadastrip =0;    

            $smtotalhorasforcadas01=0;
            $smnumtotalparadasforcadas =0;   

            $smtotalhorasoperacional01=0;
            $smnumtotalparadasoperacional =0;   

            $smtotalhorasexterna01=0;
            $smnumtotalparadasexterna =0;   

            $smtotalhorasautomacao01=0;
            $smnumtotalparadasautomacao =0; 

                    //BUSCA DO PERÍODO X ATÉ Y
             $dadosperiodo01 = $ug01->fetchAll(
                               $ug01->select()  
                                 ->setIntegrityCheck(false)

                                 ->where('datacad >= ?',$dt01sm) 
                                 ->where('datacad <= ?',$dt02sm) 
            );
            $smresult01 = $dadosperiodo01;
            foreach ($smresult01 as $key => $value) {
                    list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                    $smtotalhorasparadas01 +=  (($h * 60) + ($m) );
                    switch ($value['tipoparada']) {
                        case 'ELÉTRICA':
                           $smnumtotalparadaseletricas = $smnumtotalparadaseletricas + 1;
                           list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                           $smtotalhoraseletricas01 +=  (($h * 60) + ($m) );
                            break;
                        case 'MECÂNICA':
                           $smnumtotalparadasmecanicas = $smnumtotalparadasmecanicas + 1;
                           list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                           $smtotalhorasmecanicas01 +=  (($h * 60) + ($m) );
                            break;
                        case 'PROGRAMADA':
                           $smnumtotalparadasprogramadas = $smnumtotalparadasprogramadas + 1;
                           list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                           $smtotalhorasprogramadas01 +=  (($h * 60) + ($m) );
                            break;
                        case 'TRIP':
                           $smnumtotalparadastrip = $smnumtotalparadastrip + 1;
                           list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                           $smtotalhorastrip01 +=  (($h * 60) + ($m) );
                            break;
                        case 'FORÇADA':
                           $smnumtotalparadasforcadas = $smnumtotalparadasforcadas + 1;
                           list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                           $smtotalhorasforcadas01 +=  (($h * 60) + ($m) );
                            break;
                        case 'OPERACIONAL':
                           $smnumtotalparadasoperacional = $smnumtotalparadasoperacional + 1;
                           list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                           $smtotalhorasoperacional01 +=  (($h * 60) + ($m) );
                            break;
                        case 'EXTERNA':
                           $smnumtotalparadasexterna = $smnumtotalparadasexterna + 1;
                           list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                           $smtotalhorasexterna01 +=  (($h * 60) + ($m) );
                            break;
                        case 'AUTOMAÇÃO':
                           $smnumtotalparadasautomacao = $smnumtotalparadasautomacao + 1;
                           list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                           $smtotalhorasautomacao01 +=  (($h * 60) + ($m) );
                            break;
                        default:
                             
                             break;
                     }
            }
            $this->view->dt01sm                        =$dt01sm;
            $this->view->dt02sm                        =$dt02sm;
            
            $this->view->dadosperiodo01                =$dadosperiodo01;       

            $this->view->smtotalhorasparadas01         =$smtotalhorasparadas01;

            $this->view->smparadasautomacao            =$smnumtotalparadasautomacao;
            $this->view->smtotalhorasautomacao01       =$smtotalhorasautomacao01;
            $this->view->smpercentualautomacao01       =$smtotalhorasautomacao01/$smtotalhorasparadas01;

            $this->view->smparadaseletricas01          =$smnumtotalparadaseletricas;
            $this->view->smtotalhoraseletricas01       =$smtotalhoraseletricas01;
            $this->view->smpercentualeletrica01        =$smtotalhoraseletricas01/$smtotalhorasparadas01;

            $this->view->smparadasmecanicas            =$smnumtotalparadasmecanicas;
            $this->view->smtotalhorasmecanicas01       =$smtotalhorasmecanicas01;
            $this->view->smpercentualmecanica01        =$smtotalhorasmecanicas01/$smtotalhorasparadas01;

            $this->view->smparadasprogramadas          =$smnumtotalparadasprogramadas;
            $this->view->smtotalhorasprogramadas01     =$smtotalhorasprogramadas01;
            $this->view->smpercentualprogramada01      =$smtotalhorasprogramadas01/$smtotalhorasparadas01;

            $this->view->smparadastrip                 =$smnumtotalparadastrip;
            $this->view->smtotalhorastrip01            =$smtotalhorastrip01;
            $this->view->smpercentualtrip01            =$smtotalhorastrip01/$smtotalhorasparadas01;        

            $this->view->smparadasforcadas             =$smnumtotalparadasforcadas;
            $this->view->smtotalhorasforcadas01        =$smtotalhorasforcadas01;
            $this->view->smpercentualforcada01         =$smtotalhorasforcadas01/$smtotalhorasparadas01;

            $this->view->smparadasoperacional          =$smnumtotalparadasoperacional;
            $this->view->smtotalhorasoperacional01     =$smtotalhorasoperacional01;
            $this->view->smpercentualoperacional01     =$smtotalhorasoperacional01/$smtotalhorasparadas01;

            $this->view->smparadasexterna              =$smnumtotalparadasexterna;
            $this->view->smtotalhorasexterna01         =$smtotalhorasexterna01;
            $this->view->smpercentualexterna01         =$smtotalhorasexterna01/$smtotalhorasparadas01;
 
        $ug02 = new Application_Model_DBTable_Hmanutug02();
        $result02 = $ug02->fetchAll("datacad = '$datapesquisa'");
        $this->view->dados02 = $result02;

        $dadosperiodo02 = $ug02->fetchAll(
                        $ug02->select()  
                             ->setIntegrityCheck(false)
                             ->where('datacad >= ?', $dt01sm)  
                             ->where('datacad <= ?', $dt02sm)
        );
        //=============================EVENTOS DIÁRIOS================================================
        //Zerando variaveis
        $totalhorasparadas02 =0;
        $totalhoraseletricas02=0;

        $totalhorasmecanicas02=0;
       
        $totalhorasprogramadas02=0;
        
        $totalhorastrip02=0;

        $totalhorasforcadas02=0;

        $totalhorasoperacional02=0;

        $totalhorasexterna02=0;
          
        $totalhorasautomacao02=0;
         
        
        foreach ($result02 as $key => $value) {
                list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                $totalhorasparadas02 +=  (($h * 60) + ($m) );
                switch ($value['tipoparada']) {
                    case 'ELÉTRICA':
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhoraseletricas02 +=  (($h * 60) + ($m) );
                        break;
                    case 'MECÂNICA':
                      
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorasmecanicas02 +=  (($h * 60) + ($m) );
                        break;
                    case 'PROGRAMADA':
                        
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorasprogramadas02 +=  (($h * 60) + ($m) );
                        break;
                    case 'TRIP':
                        
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorastrip02 +=  (($h * 60) + ($m) );
                        break;
                    case 'FORÇADA':
                        
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorasforcadas02 +=  (($h * 60) + ($m) );
                        break;
                    case 'OPERACIONAL':
                        
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorasoperacional02 +=  (($h * 60) + ($m) );
                        break;
                    case 'EXTERNA':
                    
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorasexterna02 +=  (($h * 60) + ($m) );
                        break;
                    case 'AUTOMAÇÃO':
                       
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorasautomacao02 +=  (($h * 60) + ($m) );
                        break;
                    default:
                         
                         break;
                 }
        }

    
        $this->view->dados02                     =  $result02;
        $this->view->totalhorasparadas02         =  $totalhorasparadas02;

       
        $this->view->totalhorasautomacao02       =  $totalhorasautomacao02;
        $this->view->percentualautomacao02       =  $totalhorasautomacao02/$totalhorasparadas02;

      
        $this->view->totalhoraseletricas02       =  $totalhoraseletricas02;
        $this->view->percentualeletrica02        =  $totalhoraseletricas02/$totalhorasparadas02;

   
        $this->view->totalhorasmecanicas02       =  $totalhorasmecanicas02;
        $this->view->percentualmecanica02        =  $totalhorasmecanicas02/$totalhorasparadas02;

      
        $this->view->totalhorasprogramadas02     =  $totalhorasprogramadas02;
        $this->view->percentualprogramada02      =  $totalhorasprogramadas02/$totalhorasparadas02;

       
        $this->view->totalhorastrip02            =  $totalhorastrip02;
        $this->view->percentualtrip02            =  $totalhorastrip02/$totalhorasparadas02;

        $this->view->totalhorasforcadas02        =  $totalhorasforcadas02;
        $this->view->percentualforcada02         =  $totalhorasforcadas02/$totalhorasparadas02;

        
        $this->view->totalhorasoperacional02     =  $totalhorasoperacional02;
        $this->view->percentualoperacional02     =  $totalhorasoperacional02/$totalhorasparadas02;

        $this->view->totalhorasexterna02         =  $totalhorasexterna02;
        $this->view->percentualexterna02         =  $totalhorasexterna02/$totalhorasparadas02;





        $smtotalhorasparadas02 =0;

        $smtotalhoraseletricas02=0;

        $smtotalhorasmecanicas02=0;
   

        $smtotalhorasprogramadas02=0;
 

        $smtotalhorastrip02=0;
    

        $smtotalhorasforcadas02=0;
        

        $smtotalhorasoperacional02=0;
        

        $smtotalhorasexterna02=0;
         

        $smtotalhorasautomacao02=0;
         




         $smresult02 = $dadosperiodo02;
        foreach ($smresult02 as $key => $value) {
                list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                $smtotalhorasparadas02 +=  (($h * 60) + ($m) );
                switch ($value['tipoparada']) {
                    case 'ELÉTRICA':
                     
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhoraseletricas02 +=  (($h * 60) + ($m) );
                        break;
                    case 'MECÂNICA':
                       
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorasmecanicas02 +=  (($h * 60) + ($m) );
                        break;
                    case 'PROGRAMADA':
                    
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorasprogramadas02 +=  (($h * 60) + ($m) );
                        break;
                    case 'TRIP':
                      
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorastrip02 +=  (($h * 60) + ($m) );
                        break;
                    case 'FORÇADA':
                  
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorasforcadas02 +=  (($h * 60) + ($m) );
                        break;
                    case 'OPERACIONAL':
                       
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorasoperacional02 +=  (($h * 60) + ($m) );
                        break;
                    case 'EXTERNA':
                     
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorasexterna02 +=  (($h * 60) + ($m) );
                        break;
                    case 'AUTOMAÇÃO':
                       
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorasautomacao02 +=  (($h * 60) + ($m) );
                        break;
                    default:
                         
                         break;
                 }
        }
        $this->view->dt01sm                        =$dt01sm;
        $this->view->dt02sm                        =$dt02sm;
        
        $this->view->dadosperiodo02                =$dadosperiodo02;       

        $this->view->smtotalhorasparadas02         =$smtotalhorasparadas02;

        $this->view->smtotalhorasautomacao02       =$smtotalhorasautomacao02;
        if ($smtotalhorasautomacao02 != 0 && $smtotalhorasparadas02 != 0) {
            $this->view->smpercentualautomacao02   =$smtotalhorasautomacao02/$smtotalhorasparadas02;
        }
        
        $this->view->smtotalhoraseletricas02       =$smtotalhoraseletricas02;
        if ( $smtotalhoraseletricas02!=0 && $smtotalhorasparadas02!=0 ) {
             $this->view->smpercentualeletrica02   =$smtotalhoraseletricas02/$smtotalhorasparadas02;
        }
       

        
        $this->view->smtotalhorasmecanicas02       =$smtotalhorasmecanicas02;
        $this->view->smpercentualmecanica02        =$smtotalhorasmecanicas02/$smtotalhorasparadas02;

     
        $this->view->smtotalhorasprogramadas02     =$smtotalhorasprogramadas02;
        $this->view->smpercentualprogramada02      =$smtotalhorasprogramadas02/$smtotalhorasparadas02;

       
        $this->view->smtotalhorastrip02            =$smtotalhorastrip02;
        $this->view->smpercentualtrip02            =$smtotalhorastrip02/$smtotalhorasparadas02;        

    
        $this->view->smtotalhorasforcadas02        =$smtotalhorasforcadas02;
        $this->view->smpercentualforcada02         =$smtotalhorasforcadas02/$smtotalhorasparadas02;

        $this->view->smtotalhorasoperacional02     =$smtotalhorasoperacional02;
        $this->view->smpercentualoperacional02     =$smtotalhorasoperacional02/$smtotalhorasparadas02;

      
        $this->view->smtotalhorasexterna02         =$smtotalhorasexterna02;
        $this->view->smpercentualexterna02         =$smtotalhorasexterna02/$smtotalhorasparadas02;


        $ug03 = new Application_Model_DBTable_Hmanutug03();
        $result03 = $ug03->fetchAll("datacad = '$datapesquisa'");
        $this->view->dados03 = $result03;

        $dadosperiodo03 = $ug03->fetchAll(
                        $ug03->select()  
                             ->setIntegrityCheck(false)
                             ->where('datacad >= ?', $dt01sm)  
                             ->where('datacad <= ?', $dt02sm)
        );
        //=============================EVENTOS DIÁRIOS================================================
        //Zerando variaveis
        $totalhorasparadas03 =0;

        $totalhoraseletricas03=0;

        $totalhorasmecanicas03=0;
       
        $totalhorasprogramadas03=0;
        
        $totalhorastrip03=0;

        $totalhorasforcadas03=0;

        $totalhorasoperacional03=0;

        $totalhorasexterna03=0;
          
        $totalhorasautomacao03=0;
         
        
        foreach ($result03 as $key => $value) {
                list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                $totalhorasparadas03 +=  (($h * 60) + ($m) );
                switch ($value['tipoparada']) {
                    case 'ELÉTRICA':
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhoraseletricas03 +=  (($h * 60) + ($m) );
                        break;
                    case 'MECÂNICA':
                      
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorasmecanicas03 +=  (($h * 60) + ($m) );
                        break;
                    case 'PROGRAMADA':
                        
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorasprogramadas03 +=  (($h * 60) + ($m) );
                        break;
                    case 'TRIP':
                        
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorastrip03 +=  (($h * 60) + ($m) );
                        break;
                    case 'FORÇADA':
                        
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorasforcadas03 +=  (($h * 60) + ($m) );
                        break;
                    case 'OPERACIONAL':
                        
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorasoperacional03 +=  (($h * 60) + ($m) );
                        break;
                    case 'EXTERNA':
                    
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorasexterna03 +=  (($h * 60) + ($m) );
                        break;
                    case 'AUTOMAÇÃO':
                       
                        list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                        $totalhorasautomacao03 +=  (($h * 60) + ($m) );
                        break;
                    default:
                         
                       break;
                 }
        }


        $this->view->dados03                     =  $result03;
        $this->view->totalhorasparadas03         =  $totalhorasparadas03;

       
        $this->view->totalhorasautomacao03       =  $totalhorasautomacao03;
        $this->view->percentualautomacao03       =  $totalhorasautomacao03/$totalhorasparadas03;

      
        $this->view->totalhoraseletricas03       =  $totalhoraseletricas03;
        $this->view->percentualeletrica03        =  $totalhoraseletricas03/$totalhorasparadas03;

   
        $this->view->totalhorasmecanicas03       =  $totalhorasmecanicas03;
        $this->view->percentualmecanica03        =  $totalhorasmecanicas03/$totalhorasparadas03;

        
        $this->view->totalhorasprogramadas03     =  $totalhorasprogramadas03;
        $this->view->percentualprogramada03      =  $totalhorasprogramadas03/$totalhorasparadas03;

       
        $this->view->totalhorastrip03            =  $totalhorastrip03;
        $this->view->percentualtrip03            =  $totalhorastrip03/$totalhorasparadas03;

        $this->view->totalhorasforcadas03        =  $totalhorasforcadas03;
        $this->view->percentualforcada03         =  $totalhorasforcadas03/$totalhorasparadas03;

        
        $this->view->totalhorasoperacional03     =  $totalhorasoperacional03;
        $this->view->percentualoperacional03     =  $totalhorasoperacional03/$totalhorasparadas03;

        $this->view->totalhorasexterna03         =  $totalhorasexterna03;
        $this->view->percentualexterna03         =  $totalhorasexterna03/$totalhorasparadas03;


        $smtotalhorasparadas03 =0;

        $smtotalhoraseletricas03=0;

        $smtotalhorasmecanicas03=0;
   

        $smtotalhorasprogramadas03=0;
 

        $smtotalhorastrip03=0;
    

        $smtotalhorasforcadas03=0;
        

        $smtotalhorasoperacional03=0;
        

        $smtotalhorasexterna03=0;
         

        $smtotalhorasautomacao03=0;


        $smresult03 = $dadosperiodo03;
        foreach ($smresult03 as $key => $value) {
                list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                $smtotalhorasparadas03 +=  (($h * 60) + ($m) );
                switch ($value['tipoparada']) {
                    case 'ELÉTRICA':
                     
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhoraseletricas03 +=  (($h * 60) + ($m) );
                        break;
                    case 'MECÂNICA':
                       
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorasmecanicas03 +=  (($h * 60) + ($m) );
                        break;
                    case 'PROGRAMADA':
                    
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorasprogramadas03 +=  (($h * 60) + ($m) );
                        break;
                    case 'TRIP':
                      
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorastrip03 +=  (($h * 60) + ($m) );
                        break;
                    case 'FORÇADA':
                  
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorasforcadas03 +=  (($h * 60) + ($m) );
                        break;
                    case 'OPERACIONAL':
                       
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorasoperacional03 +=  (($h * 60) + ($m) );
                        break;
                    case 'EXTERNA':
                     
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorasexterna03 +=  (($h * 60) + ($m) );
                        break;
                    case 'AUTOMAÇÃO':
                       
                       list( $h, $m, $s ) = explode( ':',  $value['horas'] );
                       $smtotalhorasautomacao03 +=  (($h * 60) + ($m) );
                        break;
                    default:
                         
                         break;
                 }
        }
        $this->view->dt01sm                        =$dt01sm;
        $this->view->dt03sm                        =$dt02sm;
        
        $this->view->dadosperiodo03                =$dadosperiodo03;       

        $this->view->smtotalhorasparadas03         =$smtotalhorasparadas03;

        $this->view->smtotalhorasautomacao03       =$smtotalhorasautomacao03;
        $this->view->smpercentualautomacao03       =$smtotalhorasautomacao03/$smtotalhorasparadas03;

        $this->view->smtotalhoraseletricas03       =$smtotalhoraseletricas03;
        $this->view->smpercentualeletrica03        =$smtotalhoraseletricas03/$smtotalhorasparadas03;

        $this->view->smtotalhorasmecanicas03       =$smtotalhorasmecanicas03;
        $this->view->smpercentualmecanica03        =$smtotalhorasmecanicas03/$smtotalhorasparadas03;
     
        $this->view->smtotalhorasprogramadas03     =$smtotalhorasprogramadas03;
        $this->view->smpercentualprogramada03      =$smtotalhorasprogramadas03/$smtotalhorasparadas03;

        $this->view->smtotalhorastrip03            =$smtotalhorastrip03;
        $this->view->smpercentualtrip03            =$smtotalhorastrip03/$smtotalhorasparadas03;        
    
        $this->view->smtotalhorasforcadas03        =$smtotalhorasforcadas03;
        $this->view->smpercentualforcada03         =$smtotalhorasforcadas03/$smtotalhorasparadas03;

        $this->view->smtotalhorasoperacional03     =$smtotalhorasoperacional03;
        $this->view->smpercentualoperacional03     =$smtotalhorasoperacional03/$smtotalhorasparadas03;
      
        $this->view->smtotalhorasexterna03         =$smtotalhorasexterna03;
        $this->view->smpercentualexterna03         =$smtotalhorasexterna03/$smtotalhorasparadas03;

    
        unset($ug01);
        unset($ug02);
        unset($ug03);
//========================================================GERAL==============================================================================    
        $this->view->grtotalhorasparadas         = $smtotalhorasparadas01 + $smtotalhorasparadas02 + $smtotalhorasparadas03;
        $this->view->grparadasautomacao          = $smnumtotalparadasautomacao;
        $this->view->grtotalhorasautomacao       = $smtotalhorasautomacao01 + $smtotalhorasautomacao02 + $smtotalhorasautomacao03;
        $this->view->grpercentualautomacao       = ($smtotalhorasautomacao01 + $smtotalhorasautomacao02 + $smtotalhorasautomacao03)/ ($smtotalhorasparadas01 + $smtotalhorasparadas02 + $smtotalhorasparadas03);

        $this->view->grparadaseletricas          = $smnumtotalparadaseletricas;
        $this->view->grtotalhoraseletricas       = $smtotalhoraseletricas01 + $smtotalhoraseletricas02 + $smtotalhoraseletricas03;
        $this->view->grpercentualeletrica        = ($smtotalhoraseletricas01 + $smtotalhoraseletricas02 + $smtotalhoraseletricas03)/ ($smtotalhorasparadas01 + $smtotalhorasparadas02 + $smtotalhorasparadas03);

        $this->view->grparadasmecanicas          = $smnumtotalparadasmecanicas;
        $this->view->grtotalhorasmecanicas       = $smtotalhorasmecanicas03 + $smtotalhorasmecanicas02 + $smtotalhorasmecanicas01;
        $this->view->grpercentualmecanica        = ($smtotalhorasmecanicas03 + $smtotalhorasmecanicas02 + $smtotalhorasmecanicas01)/ ($smtotalhorasparadas01 + $smtotalhorasparadas02 + $smtotalhorasparadas03);

        $this->view->grparadasprogramadas        = $smnumtotalparadasprogramadas;
        $this->view->grtotalhorasprogramadas     = $smtotalhorasprogramadas03 + $smtotalhorasprogramadas02 + $smtotalhorasprogramadas01;
        $this->view->grpercentualprogramada      = ($smtotalhorasprogramadas03 + $smtotalhorasprogramadas02 + $smtotalhorasprogramadas01)/ ($smtotalhorasparadas01 + $smtotalhorasparadas02 + $smtotalhorasparadas03);

        $this->view->grparadastrip               = $smnumtotalparadastrip;
        $this->view->grtotalhorastrip            = $smtotalhorastrip03 + $smtotalhorastrip02 + $smtotalhorastrip01;
        $this->view->grpercentualtrip            = ($smtotalhorastrip03 + $smtotalhorastrip02 + $smtotalhorastrip01)/ ($smtotalhorasparadas01 + $smtotalhorasparadas02 + $smtotalhorasparadas03);

        $this->view->grparadasforcadas           = $smnumtotalparadasforcadas;
        $this->view->grtotalhorasforcadas        = $smtotalhorasforcadas03 +  $smtotalhorasforcadas02 + $smtotalhorasforcadas01;
        $this->view->grpercentualforcada         = ($smtotalhorasforcadas03 +  $smtotalhorasforcadas02 + $smtotalhorasforcadas01) / ($smtotalhorasparadas01 + $smtotalhorasparadas02 + $smtotalhorasparadas03);

        $this->view->grparadasoperacional        = $smnumtotalparadasoperacional;
        $this->view->grtotalhorasoperacional     = ($smtotalhorasoperacional03  + $smtotalhorasoperacional02 + $smtotalhorasoperacional01) ;
        $this->view->grpercentualoperacional     = ($smtotalhorasoperacional03  + $smtotalhorasoperacional02+  $smtotalhorasoperacional01) /($smtotalhorasparadas01 + $smtotalhorasparadas02 + $smtotalhorasparadas03);

        $this->view->grparadasexterna            = $smnumtotalparadasexterna;
        $this->view->grtotalhorasexterna         = $smtotalhorasexterna03 + $smtotalhorasexterna02 + $smtotalhorasexterna01;
        $this->view->grpercentualexterna         = ($smtotalhorasexterna03 + $smtotalhorasexterna02 + $smtotalhorasexterna01) / ($smtotalhorasparadas01 + $smtotalhorasparadas02 + $smtotalhorasparadas03);
    }

    public function errozerodadosrelatorioparadaAction()
    {
        // action body
    }


}













