<?php 
function randomizar_pessoas(){
    $nomes = array(
    "Alice", "Miguel", "Sophia", "Arthur", "Helena", "Bernardo", "Valentina", "Heitor", "Laura",  "Davi", "Isabella", "Lorenzo", "Manuela", "Théo", "Júlia", "Pedro", "Heloísa", "Gabriel","Luiza", "Enzo", "Maria Luiza", "Matheus", "Lorena", "Lucas", "Lívia", "Benjamin", "Giovanna","Nicolas", "Maria Eduarda", "Guilherme", "Beatriz", "Rafael", "Maria Clara", "Joaquim",  "Cecília", "Samuel", "Eloá", "Enzo Gabriel", "Lara", "João Miguel", "Maria Júlia", "Henrique","Isadora", "Gustavo", "Mariana", "Murilo", "Emanuelly", "Pedro Henrique", "Ana Júlia","Pietro", "Ana Luiza", "Lucca", "Ana Clara", "Felipe", "Melissa", "João Pedro", "Yasmin","Isaac", "Maria Alice", "Benício", "Isabelly", "Daniel", "Lavínia", "Anthony", "Esther","Leonardo", "Sarah", "Davi Lucca", "Elisa", "Bryan", "Antonella", "Eduardo", "Rafaela", "João Lucas", "Maria Cecília", "Victor", "Liz", "João", "Marina", "Cauã", "Nicole", "Antônio","Maitê", "Vicente", "Isis", "Caleb", "Alícia", "Gael", "Luna", "Bento", "Rebeca", "Caio","Agatha", "Emanuel", "Letícia", "Vinícius", "Maria-", "João Guilherme", "Gabriela", "Davi Lucas", "Ana Laura", "Noah", "Catarina", "João Gabriel", "Clara", "João Victor",  "Ana Beatriz", "Luiz Miguel", "Vitória", "Francisco", "Olívia", "Kaique", "Maria Fernanda","Otávio", "Emilly","Augusto","Maria Valentina","Levi", "Milena","Yuri", "Maria Helena","Enrico", "Bianca","Thiago", "Larissa","Ian", "Mirella","Victor Hugo", "Maria Flor","Thomas", "Allana","Henry", "Ana Sophia","Luiz Felipe", "Clarice","Ryan", "Pietra","Arthur Miguel","Maria Vitória","Davi Luiz", "Maya","Nathan", "Laís","Pedro Lucas", "Ayla","Davi Miguel","Ana Lívia","Raul", "Eduarda","Pedro Miguel", "Mariah","Luiz Henrique", "Stella","Luan", "Ana","Erick", "Gabrielly","Martin", "Sophie","Bruno", "Carolina","Rodrigo", "Maria Laura","Luiz Gustavo", "Maria Heloísa","Arthur Gabriel", "Maria Sophia","Breno", "Fernanda","Kauê","Malu","Enzo Miguel", "Analu","Fernando", "Amanda","Arthur Henrique", "Aurora","Luiz Otávio","Maria Isis","Carlos Eduardo", "Louise","Tomás", "Heloise","Lucas Gabriel", "Ana Vitória","André", "Ana Cecília","José", "Ana Liz","Yago", "Joana","Danilo", "Luana","Anthony Gabriel","Antônia","Ruan", "Isabel","Miguel Henrique", "Bruna", "Oliver"
    );

    $sobrenomes = array(
        "Silva", "Souza", "Costa", "Santos", "Oliveira", "Pereira", "Rodrigues", "Almeida", "Nascimento", "Lima", "Araújo", "Fernandes", "Carvalho", "Gomes", "Martins", "Rocha", "Ribeiro", "Alves", "Monteiro", "Mendes", "Barros", "Freitas", "Barbosa", "Pinto", "Moura", "Cavalcanti", "Dias", "Castro", "Campos", "Cardoso" 
    );

    $locais= array_rand($nomes, 30);

    $pessoas_lista = array();

    foreach($locais as $i){
        $locais2 = array_rand($sobrenomes, 2);
        $aux = array();
        array_push($aux, $nomes[$i]);
        foreach($locais2 as $j){ array_push($aux, $sobrenomes[$j]); }
        $senha = str_replace(
            array("á", "é", "í", "ó", "ú", "ã", " "),
            array("a", "e", "i", "o", "u", "a", ""), 
            strtolower(implode($aux))
        );

        $emails = array("@gmail.com", "@hotmail.com", "@outlook.com.br", "@yahoo.com"); 

        $email = str_replace(
            array("á", "é", "í", "ó", "ú", "ã", "ô", "â", " "), 
            array("a", "e", "i", "o", "u", "a", "o", "a", "."), 
            strtolower(implode($aux, " "))
        ).
        $emails[array_rand($emails, 1)];
        $usuario = "@".str_replace(
            array("á", "é", "í", "ó", "ú", "ã", " "), 
            array("a", "e", "i", "o", "u", "a", "."), 
            strtolower(implode($aux, " "))
        );

        $pessoa_aux =  new Pessoa();
        $pessoa_aux->id = null;
        $pessoa_aux->nome = implode($aux, " ");
        $pessoa_aux->telefone = rand(11, 99)."".rand(10000,99999)."".rand(1000,9999);
        $pessoa_aux->senha = $senha;
        $pessoa_aux->email = $email;
        $pessoa_aux->usuario = $usuario;
        

        
        array_push($pessoas_lista, $pessoa_aux);
    }

    echo '<table class="w3-table">';
    foreach($pessoas_lista as $pessoa){
        $dados = $pessoa->getPessoa();
        echo "<tr>";
        foreach($dados as $chave => $dado){
            if($chave == ":senha"){
                echo "<td>";
                    for($i=0; $i < strlen($dado); $i++){
                        echo "*";
                    }
                echo "</td>";
                
            }
            else{
                echo "<td> ".$dado."</td>";
            }
            
        }
        if($pessoa->insertPessoa() == true){
            echo "<td><input type='checkbox' disabled checked></td>";
        }
        else {
            echo "<td><input type='checkbox' disabled></td>";
        }

       

        echo "</tr>";
        
    }

    
    echo "</table>";
    echo "<br/>";
    
}
?>