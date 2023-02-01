<?php

function tratarUrl(string $caminho_da_url) : array
{
    // Tratamento da url
        // Transformar em um vetor, separando onde tiver a presença da /
    $lista_de_rotas = explode('/', $caminho_da_url);
    
    $lista_de_rotas_limpa = [];
    for ($contador = 0; $contador < count($lista_de_rotas); $contador++)
    {
        if ($lista_de_rotas[$contador] != '')
        {
            $lista_de_rotas_limpa[] = $lista_de_rotas[$contador];
        }
    }

       // Limpar rota final, caso esteja com os símbolos ? ou #
    if($lista_de_rotas_limpa == null)
    {
        $lista_de_rotas_limpa[] = '';
    }

    if (str_contains($lista_de_rotas_limpa[count($lista_de_rotas_limpa) - 1], '?') === true)
    {
        $lista_de_rotas_limpa[count($lista_de_rotas_limpa) - 1] = mb_substr(
            $lista_de_rotas_limpa[count($lista_de_rotas_limpa) - 1], 
            0, 
            mb_strpos($lista_de_rotas_limpa[count($lista_de_rotas_limpa) - 1], '?')
        );
    } 
    if (str_contains($lista_de_rotas_limpa[count($lista_de_rotas_limpa) - 1], '#') === true)
    {
        $lista_de_rotas_limpa[count($lista_de_rotas_limpa) - 1] = mb_substr(
            $lista_de_rotas_limpa[count($lista_de_rotas_limpa) - 1], 
            0,
            mb_strpos($lista_de_rotas_limpa[count($lista_de_rotas_limpa) - 1], '#')
        );
    }

    return $lista_de_rotas_limpa;
}

function carregarArquivo(string $caminho_da_url)
{
    $lista_de_rotas_limpa = tratarUrl($caminho_da_url);
    $numero_de_nivel_de_rota = 0;
    // Enviar arquivo ou requerer outro arquivo de rotas
    if (count($lista_de_rotas_limpa) == ($numero_de_nivel_de_rota + 1))
    {
        if (
            $lista_de_rotas_limpa[$numero_de_nivel_de_rota] == ''
            || $lista_de_rotas_limpa[$numero_de_nivel_de_rota] == 'home'
        )
        {
            require(__DIR__ . '/paginas/home/index1.php');
        } elseif ($lista_de_rotas_limpa[$numero_de_nivel_de_rota] == 'home2')
        {
            require(__DIR__ . '/paginas/home2/index2.php');
        } else 
        {
            require(__DIR__ . '/404.html');
        }
    } elseif (count($lista_de_rotas_limpa) > ($numero_de_nivel_de_rota + 1))
    {
        // Fazer roteamento para outros arquivos route
        $numero_de_nivel_de_rota++;
        if ($lista_de_rotas_limpa[$numero_de_nivel_de_rota - 1] == 'home2')
        {
            require(__DIR__ . '/paginas/home2/routes_home2.php');
        } else 
        {
            require(__DIR__ . '/404.html');
        }
    }
}

carregarArquivo( $_SERVER['REQUEST_URI'] ); // @@@ Fazer com que a url que o usuario passe seja apenas interpretada como texto e não convertido em código php ou html

?>