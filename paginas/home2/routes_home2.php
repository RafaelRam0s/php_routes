<?php

// Enviar arquivo ou requerer outro arquivo de rotas
if (count($lista_de_rotas_limpa) == ($numero_de_nivel_de_rota + 1))
{
    if (
        $lista_de_rotas_limpa[$numero_de_nivel_de_rota] == 'home3'
    )
    {
        require(__DIR__ . '/home3/index3.php');
    } else 
    {
        require(__DIR__ . '/../../404.html');
    }
} elseif (count($lista_de_rotas_limpa) > ($numero_de_nivel_de_rota + 1))
{
    // Fazer roteamento para outros arquivos route
    $numero_de_nivel_de_rota++;
    
    require(__DIR__ . '/../../404.html');
}