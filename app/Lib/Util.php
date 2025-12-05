<?php

/**
 * Description of Util
 * Esta classe contém os métodos de utilizade Geral utilizados
 *   Em várias outras classes
 */

namespace App\Lib;

class Util
{

    /* sanitizar()
   * ----------
   * Faz uma limpeza nos dados do array ou string para evitar ataques 
   * de injection e XSS(Cross-Site Scripting)
   * - O parâmetro de entrada pode ser um array ou uma string
   * - Retorna um array ou uma string, dependendo da entrada
   */
    public static function sanitizar($dados)
    {
        if (is_array($dados)) {
            foreach ($dados as $chave => $valor) {
                // CORREÇÃO: Trocamos filter_var(..., FILTER_SANITIZE_STRING) por strip_tags()
                $valor = strip_tags($valor);
                $valor = str_replace("&#x", '', $valor);
                $valor = stripslashes($valor);
                $dados[$chave] = trim($valor);
            }
        } else {
            // CORREÇÃO: Mesma troca aqui no else
            $dados = strip_tags($dados);
            $dados = str_replace("&#x", '', $dados);
            $dados = stripslashes($dados);
            $dados = trim($dados);
        }
        return $dados;
    }
}
