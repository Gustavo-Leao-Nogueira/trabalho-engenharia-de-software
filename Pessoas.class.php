<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../node_modules/w3-css/3/w3.css"/>
    <title>Pessoa</title>
</head>
<body >

<?php
require_once 'Banco.class.php';

class Pessoa{
    
    private $nome;
    private $id;
    private $email;
    private $telefone;
    private $senha;
    private $usuario;
    private $banco;

    public function __construct(){
        $this->banco = new Banco();

    }

    public function insertPessoa(){
        $pesquisa = "SELECT count(id) quantidade FROM pessoa p WHERE p.id = :id OR p.nome = :nome OR p.telefone = :telefone OR p.email = :email OR p.senha = :senha OR p.usuario = :usuario";

        $resp = $this->banco->executar($pesquisa, $this->getPessoa());


        while($item = $resp->fetch(PDO::FETCH_ASSOC)){
            if($item['quantidade'] == 0){
                $sql = "INSERT INTO pessoa(id, nome, telefone, email, senha, usuario) VALUES(:id, :nome, :telefone, :email, :senha, :usuario);";
                $this->banco->executar($sql, $this->getPessoa());
                return true;
            }
        }     
    }
    
    public function selectAllPessoas(){
        $sql = "SELECT *  FROM pessoa;";        
        if($_GET){
            if(isset($_GET['order']) == true){
                if($_GET['order'] == 'name'){
                    $sql = "SELECT *  FROM pessoa p ORDER BY  p.nome ASC;";   
                }
                else if($_GET['order'] == 'telefone'){
                    $sql = "SELECT *  FROM pessoa p ORDER BY  p.telefone;";
                }
                else if($_GET['order'] == 'email'){
                    $sql = "SELECT *  FROM pessoa p ORDER BY  p.email;";
                }
                else if($_GET['order'] == 'usuario'){
                    $sql = "SELECT *  FROM pessoa p ORDER BY  p.usuario;";
                }
            }
            else if(isset($_GET['pesquisa']) == true and isset($_GET['tipo']) == true){
                if($_GET['pesquisa'] == '' and 
                    ($_GET['tipo'] == 'name' or 
                     $_GET['tipo'] == 'telefone' or 
                     $_GET['tipo'] == 'email' or
                     $_GET['tipo'] == 'usuario')){
                    $sql = "SELECT *  FROM pessoa;";
                }
                else{
                    if($_GET['tipo'] == 'nome'){
                        $sql = "SELECT *  FROM pessoa p WHERE p.nome LIKE '%".$_GET['pesquisa']."%';";   
                    }
                    else if($_GET['tipo'] == 'telefone'){
                        $sql = "SELECT *  FROM pessoa p WHERE p.telefone LIKE '%".$_GET['pesquisa']."%';";  
                    }
                    else if($_GET['tipo'] == 'email'){
                        $sql = "SELECT *  FROM pessoa p WHERE p.email LIKE '%".$_GET['pesquisa']."%';";  
                    }
                    else if($_GET['tipo'] == 'usuario'){
                        $sql = "SELECT *  FROM pessoa p WHERE p.usuario LIKE '%".$_GET['pesquisa']."%';";  
                    }
                }
            }
            else if(isset($_GET['id']) == true or isset($_POST['id']) == true){
                $sql1 = "SELECT *  FROM pessoa p WHERE p.id = ".$_GET['id'].";"; 
                $resp1 = $this->banco->executar_query($sql1);
                
                echo '<div class="w3-modal w3-padding" id="id01">';
                echo '<div class="w3-modal-content">';
                while($linha = $resp1->fetch(PDO::FETCH_ASSOC)){
                    $email = $linha['email'];
                    $senha = md5($linha['senha']);
                    $usuario = $linha['usuario'];
                    $telefone = $linha['telefone'];
                    $nome = $linha['nome'];

                    echo '<form action="?" method="get" class="w3-row">';
                        echo '<label for="nome">'.'Nome:'.'</label>';
                        echo '<input type="text" placeholder="Digite seu nome aqui" value="'.$nome.'" class="w3-input" required />';

                        echo '<label for="telefone">'.'Telefone:'.'</label>';
                        echo '<input type="tel" placeholder="Digite seu telefone aqui" value="'.$telefone.'" class="w3-input" required />';

                        echo '<label for="email">'.'Email:'.'</label>';
                        echo '<input type="email" placeholder="Digite seu email aqui" value="'.$email.'" class="w3-input"  required />';

                        echo '<label for="usuario">'.'Usuário:'.'</label>';
                        echo '<input type="text" placeholder="Digite seu usuário aqui" value="'.$usuario.'" class="w3-input"  required />';

                        echo '<label for="senha">'.'Senha:'.'</label>';
                        echo '<input type="password" placeholder="Digite seu usuário aqui" value="'.$senha.'" class="w3-input"  required />';


                    echo '</form>';
                }
                echo '</div>';
                echo '</div>';

            }
        }
        
        $resp = $this->banco->executar_query($sql);

echo '<div class="w3-card w3-margin w3-padding">';
echo '<div class="w3-panel w3-container">';
echo '<form  action="?">';
    echo '<div class="w3-row">';
        echo '<div class="w3-col l11">';
        echo '<input  type="search" class="w3-input" name="pesquisa" placeholder="Digite algo para pesquisar"/>';
        echo '</div>';
        echo '<div class="w3-col l1">';
            echo '<input type="submit" class="w3-button w3-blue" value="Pesquisar" />';
        echo '</div>';
    echo '</div>';
    echo '<div class="w3-row">';
        echo '<label for="nome" class="w3-col l1">';
            echo '<input type="radio" class="w3-radio" id="nome" name="tipo" value="nome" checked/>';
            echo 'Nome';
        echo '</label>';
        echo '<label for="telefone" class="w3-col l1">';
            echo '<input type="radio" class="w3-radio" id="telefone" name="tipo" value="telefone" />';
            echo 'Telefone';
        echo '</label>';
        echo '<label for="email" class="w3-col l1">';
            echo '<input type="radio" class="w3-radio" id="email" name="tipo" value="email" />';
            echo 'Email';
        echo '</label>';
        echo '<label for="usuario" class="w3-col l1">';
            echo '<input type="radio" class="w3-radio" id="usuario" name="tipo" value="usuario" />';
            echo 'Usuário';
        echo '</label>';
    echo '</div>';
echo '</form>';
echo '</div>';

        
        echo '<table class="w3-table w3-bordered w3-border">';
            echo '<tr class="w3-green">';
                echo '<th>'.'<a href="?order=name">'."Nome".'</a>'.'</th>';
                echo '<th>'.'<a href="?order=telefone">'."Telefone".'</a>'.'</th>';
                echo '<th>'.'<a href="?order=email">'."Email".'</a>'.'</th>';
                echo '<th>'.'<a href="?order=usuario">'."Usuário".'</a>'.'</th>';
                echo '<th>'."Opções".'</th>';
                echo '<th>'."Opções".'</th>';
            echo '</tr>';
        while($linha = $resp->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
                echo '<td>'.$linha['nome'].'</td>';
                echo '<td>'.$linha['telefone'].'</td>';
                echo '<td>'.$linha['email'].'</td>';
                echo '<td>'.$linha['usuario'].'</td>';
                echo '<td>'.'<a onclick="document.getElementById(\'id01\').style.display=\'block\'" href="?id='.$linha['id'].'">Alterar</a>'.'</td>';
                echo '<td>'.'<a onclick="document.getElementById(\'id01\').style.display=\'block\'" href="?id='.$linha['id'].'">Apagar</a>'.'</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    }

    public function getPessoa(){
        return array(
            ":id" => $this->id,
            ":nome" => $this->nome,
            ":telefone" => $this->telefone,
            ":email" => $this->email,
            ":usuario" => $this->usuario,
            ":senha" => $this->senha
        );
    }

    public function __get($valor){
        return $this->$valor;
    }
    public function __set($proriedade, $valor){
        if($proriedade == "senha"){
            $this->$proriedade = md5($valor);
        }
        elseif($proriedade == "telefone"){
            $telefone = preg_replace('/(^\d{2})(\d{4,5})(\d{4})/', '(0$1) $2-$3', $valor);
            $this->$proriedade = $telefone;
        }
        else{
            $this->$proriedade = $valor;
        }
    }
}



$pessoa = new Pessoa();
$pessoa->selectAllPessoas();


?>