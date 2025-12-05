<main role="main" class="flex-shrink-0">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1 class="mt-2">Cadastro de Usuário</h1>
                <?php
                echo $Sessao::retornaMensagem();
                $Sessao::limpaMensagem();
                ?>
                <form action="<?php echo 'http://' . APP_HOST . '/usuario/salvar/novo'; ?>" method="post">

                    <div class="form-group">
                        <label for="login">Login (Usuário)</label>
                        <input type="text" class="form-control" name="login"
                            value="<?php echo isset($viewVar['usuario']) ? $viewVar['usuario']->getLogin() : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" class="form-control" name="nome"
                            value="<?php echo isset($viewVar['usuario']) ? $viewVar['usuario']->getNome() : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" name="senha" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email"
                            value="<?php echo isset($viewVar['usuario']) ? $viewVar['usuario']->getEmail() : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="permissao">Permissão</label>
                        <select class="form-control" name="permissao" required>
                            <option value="" selected disabled>Selecione...</option>

                            <option value="Admin"
                                <?php echo (isset($viewVar['usuario']) && $viewVar['usuario']->getPermissao() == 'Admin') ? 'selected' : ''; ?>>
                                Admin (Acesso Total)
                            </option>

                            <option value="Normal"
                                <?php echo (isset($viewVar['usuario']) && $viewVar['usuario']->getPermissao() == 'Normal') ? 'selected' : ''; ?>>
                                Normal (Leitura, Alteração, Exclusão)
                            </option>

                            <option value="Leitura"
                                <?php echo (isset($viewVar['usuario']) && $viewVar['usuario']->getPermissao() == 'Leitura') ? 'selected' : ''; ?>>
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