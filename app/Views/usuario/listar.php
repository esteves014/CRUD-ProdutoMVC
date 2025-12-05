<main role="main" class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Listagem de Usuários</h1>
        <?php
        echo $Sessao::retornaMensagem();
        $Sessao::limpaMensagem();

        if (count($viewVar['listaUsuarios']) > 0) {
            echo '<div class="table-responsive">';
            echo ' <table class="table table-bordered table-hover table-sm">';
            echo ' <thead >';
            echo ' <tr style="background-color: #bee5eb;">';
            echo ' <th class="info">Login</th>';
            echo ' <th class="info">Nome</th>';
            echo ' <th class="info">Email</th>';
            echo ' <th class="info">Permissão</th>';
            echo ' <th class="info">Ações</th>';
            echo ' </tr>';
            echo ' </thead>';
            echo ' <tbody>';
            foreach ($viewVar['listaUsuarios'] as $objUsuario) {
                $login = $objUsuario->getLogin();
                $nome = $objUsuario->getNome();
                $email = $objUsuario->getEmail();
                $permissao = $objUsuario->getPermissao();

                echo '<tr>';
                echo ' <td>' . $login . '</td>';
                echo ' <td>' . $nome . '</td>';
                echo ' <td>' . $email . '</td>';
                echo ' <td>' . $permissao . '</td>';
                echo ' <td> <a href="http://' . APP_HOST . '/usuario/editar/' . $login . '" class="btn btn-info btn-sm">Editar</a>  
              <a href="http://' . APP_HOST . '/usuario/excluirConfirma/' . $login . '" class="btn btn-danger btn-sm mt-1">Excluir</a></td>';
                echo '</tr>';
            }
            echo ' </tbody>';
            echo ' </table>';
            echo '</div>';
        } else {
            echo "Nenhum Usuário Encontrado.";
        }
        ?>
    </div>
</main>