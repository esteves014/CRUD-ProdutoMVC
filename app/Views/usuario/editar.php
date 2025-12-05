<main role="main" class="flex-shrink-0">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1 class="mt-2">Editar Usuário</h1>
                <?php
                echo $Sessao::retornaMensagem();
                $Sessao::limpaMensagem();
                ?>
                <form action="<?php echo 'http://' . APP_HOST . '/usuario/salvar/editar'; ?>" method="post">

                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" name="login"
                            value="<?php echo $viewVar['usuario']->getLogin(); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" class="form-control" name="nome"
                            value="<?php echo $viewVar['usuario']->getNome(); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha (Redefinir)</label>
                        <input type="password" class="form-control" name="senha"
                            value="<?php echo $viewVar['usuario']->getSenha(); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email"
                            value="<?php echo $viewVar['usuario']->getEmail(); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="permissao">Permissão</label>
                        <select class="form-control" name="permissao" required>
                            <option value="Admin" <?php echo ($viewVar['usuario']->getPermissao() == 'Admin') ? 'selected' : ''; ?>>
                                Admin (Acesso Total)
                            </option>

                            <option value="Normal" <?php echo ($viewVar['usuario']->getPermissao() == 'Normal') ? 'selected' : ''; ?>>
                                Normal (Leitura, Alteração, Exclusão)
                            </option>

                            <option value="Leitura" <?php echo ($viewVar['usuario']->getPermissao() == 'Leitura') ? 'selected' : ''; ?>>
                                Leitura (Somente Leitura)
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm mt-2">Salvar</button>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</main>