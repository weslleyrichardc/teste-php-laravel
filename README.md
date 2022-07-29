# Desafio Programador PHP

### Como executar

- Instalar dependencias com o composer
  - `composer install`
- Subir os containers com o docker e o sail
  - `./vendor/bin/sail up`
  - `./vendor/bin/sail up -d` (modo detached do terminal)
    - Para remover os containers
        - `./vendor/bin/sail down`
      
### O teste é formado por 3 partes.

1. A criação de uma rota que encontra um hash, de certo formato, para uma certa string fornecida como
   input.
   - [Rotas](routes/api.php)
   - Exemplo: http://localhost/api/hash?string="Teste" (POST | Parameter string="Teste")
   - [Rate Limiter](app/Providers/RouteServiceProvider.php)
2. A criação de um comando que consulta a rota criada e armazena os resultados na base de dados.
   - [Comando](app/Console/Commands/avato.php)
   - Exemplo: `avato:test "Teste" --requests=100`
   - `--requests` envia 10 requisições por padrão caso não informado.
3. Criação de rota que retorne os resultados que foram gravados.
    - [Rotas](routes/api.php)
    - Exemplo: http://localhost/api/hash (GET)
