<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Util;

class UsuarioController extends Controller
{
    public function listar()
    {
        $usuarioDAO = new UsuarioDAO();

        self::setViewParam('listaUsuarios', $usuarioDAO->listar());

        $this->render('/usuario/listar');

        Sessao::limpaMensagem();
    }

    public function editar($params)
    {
        $login = $params[0];

        $usuarioDAO = new UsuarioDAO();

        $objUsuario = $usuarioDAO->listar($login);

        if ($objUsuario == null) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Falha ao recuperar dados do usuário ' . $login . '</div>');
            $this->redirect('/usuario/listar');
        }

        self::setViewParam('usuario', $objUsuario);

        $this->render('/usuario/editar');

        Sessao::limpaMensagem();
    }

    public function salvar($param)
    {
        $cmd = $param[0];
        $dadosform = Util::sanitizar($_POST);

        $objUsuario = new Usuario();
        $objUsuario->setUsuario($dadosform);

        $errovalidacao = false;

        if (empty($dadosform['login']) || empty($dadosform['nome'])) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos Obrigatórios.</div>');
            Sessao::gravaErro('errologin', 'Campo obrigatório');
            $errovalidacao = true;
        }

        if ($errovalidacao) {
            self::setViewParam('usuario', $objUsuario);
            if ($cmd == 'editar') {
                $this->render('/usuario/editar');
            } elseif ($cmd == 'novo') {
                $this->render('/usuario/cadastrar');
            }
            die();
        }

        $usuarioDAO = new UsuarioDAO();

        if ($cmd == 'editar') {
            $usuarioDAO->atualizar($objUsuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuário atualizado com sucesso.</div>');
        } elseif ($cmd == 'novo') {
            if ($usuarioDAO->listar($objUsuario->getLogin())) {
                Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Login já existente! Tente outro.</div>');
                self::setViewParam('usuario', $objUsuario);
                $this->render('/usuario/cadastrar');
                die();
            }
            $usuarioDAO->salvar($objUsuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Novo Usuário gravado com sucesso.</div>');
        }

        Sessao::limpaErro();
        $this->redirect('/usuario/listar');
    }

    public function excluirConfirma($param)
    {
        $dados = Util::sanitizar($param);
        $login = $dados[0];

        $objUsuario = new Usuario();
        $objUsuario->setLogin($login);
        $usuarioDAO = new UsuarioDAO();
        $usuarioCarregado = $usuarioDAO->listar($login);

        if ($usuarioCarregado) {
            $objUsuario->setNome($usuarioCarregado->getNome());
        }

        self::setViewParam('usuario', $objUsuario);
        $this->render('/usuario/excluirConfirma');
    }

    public function excluir($param)
    {
        $objUsuario = new Usuario();
        $objUsuario->setLogin(Util::sanitizar($_POST['id']));

        $usuarioDAO = new UsuarioDAO();

        if (!$usuarioDAO->excluir($objUsuario)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Usuário Não Encontrado.</div>');
        } else {
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuário excluído com sucesso!.</div>');
        }
        $this->redirect('/usuario/listar');
    }

    public function cadastrar()
    {
        $this->render('/usuario/cadastrar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
}
