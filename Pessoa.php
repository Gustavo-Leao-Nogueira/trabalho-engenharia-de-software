<?php 

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
                echo '<td>'.'<a href="?id='.$linha['id'].'">Alterar</a>'.'</td>';
                echo '<td>'.'<a href="?id='.$linha['id'].'">Apagar</a>'.'</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';

        ?>