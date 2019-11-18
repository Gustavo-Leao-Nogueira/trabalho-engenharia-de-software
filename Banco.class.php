<?php 

class Banco{
    private $banco;
    private $usuario;
    private $senha;
    private $status;
    private $conexao;

    public function __construct($banco='trabalho', $usuario='root', $senha=''){
        $this->banco = "mysql:host=localhost;dbname=$banco";
        $this->usuario = $usuario;
        $this->senha = $senha;

        $this->status = $this->conectar();   
    }
    public function isConectado(){
        if($this->status == false){
            $this->status = $this->conectar();
        }
    }

    public function executar_query($sql){
        try{        
            $this->isConectado();
            $resp = $this->conexao->query($sql);
            return $resp;
        }catch(PDOException $erro){
            $this->mensagem_erro($erro);
            return false;
        }
    }
    public function executar($sql, $array_de_dados){
        try{        
            $this->isConectado();
            $resp = $this->conexao->prepare($sql);
            $resp->execute($array_de_dados);
            return $resp;
        }catch(PDOException $erro){
            $this->mensagem_erro($erro);
            return false;
        }
    }
    public function conectar(){
        try{
            $this->conexao = new PDO($this->banco, $this->usuario, $this->senha);
            return true;
        }catch(PDOException $erro){
            $this->mensagem_erro($erro);
            return false;
        }
    }

    public function mensagem_erro($erro){
        echo '<div class="w3-red w3-center w3-panel w3-container">';
        echo '<p><b>Erro: </b>'.$erro->getMessage().'</p>';        
        echo '</div>';
    }
}



?>