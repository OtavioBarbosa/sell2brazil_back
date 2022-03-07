# Sell 2 Brazil!

Imaginando que o ***Laravel*** já está instalado e o comando ***composer install*** executado dentro da pasta onde se encontra o código fonte do projeto.

## Projeto

 1. Criar um ***schema*** no banco de dados;
 2. Definir no arquivo ***.env*** o nome escolhido para ***schema***;
 3. Observar o ***.env.example*** para incluir as variáveis faltantes no ***.env***;
 4. Iniciar o projeto executando o comando ***php artisan serve***. 

## Teste

O teste foi implementado para validar 3 pontos do projeto, sendo eles:

 - **Criação do pedido**
 - **Listagem dos pedidos**
 - **Desconto aplicado**

Para inicializar os testes, basta executar o seguinte comando no terminal  ***.\vendor\bin\phpunit***. O retorno esperado é ***OK (3 tests, 3 assertions)***