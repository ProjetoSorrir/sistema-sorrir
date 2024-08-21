# Instruções de Instalação para o Projeto Brascap

## Passo a Passo de Instalação

1. **Criação do Banco de Dados**
    - Crie um novo banco de dados para o projeto Brascap.

2. **Configuração do Arquivo `.env`**
    - Você tem duas opções para configurar o arquivo `.env`:
        - Copie o arquivo `.env` do projeto Rifando para o diretório do projeto Brascap.
        - Utilize o arquivo `env.example` que está na aplicação e copie-o para um novo arquivo `.env`:
          ```sh
          cp env.example .env
          ```
    - Edite o arquivo `.env` copiado e atualize as credenciais para o novo banco de dados criado.

3. **Instalação das Dependências PHP**
    - Execute o comando abaixo para instalar as dependências do PHP:
      ```sh
      composer install
      ```

4. **Migração do Banco de Dados**
    - Execute o comando abaixo para migrar o banco de dados:
      ```sh
      php artisan migrate
      ```

5. **Instalação das Dependências Node.js**
    - Execute o comando abaixo para instalar as dependências do Node.js:
      ```sh
      npm install
      ```

6. **Compilação dos Recursos e Início do Servidor**
    - Execute os comandos abaixo para compilar os recursos e iniciar o servidor:
      ```sh
      npm run dev
      php artisan serve
      ```

7. **Configuração da Rota**
    - No Linux: Configure a rota usando Valet.
    - No Windows: Configure a rota usando Laragon.

8. **Registro e Configuração de Administrador**
    - Acesse o endereço `http://127.0.0.1:8000/register` e registre-se no tenant.
    - Após o registro, acesse o banco de dados Brascap (ou o nome que você escolheu) e atualize o campo `admin` para `1` no seu usuário recém-registrado. 
    - Exemplo de consulta SQL:
      ```sql
      UPDATE users SET admin = 1 WHERE email = 'seu-email@exemplo.com';
      ```

9. **Acesso ao Dashboard**
    - Acesse o endereço `http://127.0.0.1:8000/dashboard` e cadastre a rota configurada anteriormente.

### Acesso Rápido

- Criação do Banco de Dados
- Configuração do Arquivo `.env`
- `composer install`
- `php artisan migrate`
- `npm install`
- `npm run dev` e `php artisan serve`
- Configuração da Rota (Valet ou Laragon)
- Registro: [http://127.0.0.1:8000/register](http://127.0.0.1:8000/register)
- Configuração de Admin no banco de dados
- Dashboard: [http://127.0.0.1:8000/dashboard](http://127.0.0.1:8000/dashboard)

## Acesso à Aplicação

1. **Início da Aplicação**
    - Execute o comando abaixo para iniciar a aplicação:
      ```sh
      npm run dev
      ```

2. **Acesso ao Sistema**
    - Entre na rota configurada, por exemplo, `brascap-oficial.test`.
    - Faça seu registro acessando [http://brascap-oficial.test/register](http://brascap-oficial.test/register).

3. **Configuração de Administrador**
    - Após o registro, acesse o banco de dados `bd-brascap-oficial` (ou o nome que você configurou).
    - Vá até a tabela `users` e troque o campo `admin` para `1` no seu usuário recém-registrado.
      - Exemplo de consulta SQL:
        ```sql
        UPDATE users SET admin = 1 WHERE email = 'seu-email@exemplo.com';
        ```

4. **Acesso ao Dashboard de Admin**
    - Acesse o endereço [http://brascap-oficial.test/register/admin/home](http://brascap-oficial.test/register/admin/home) para ter acesso ao painel de administração.
> Acesso Rápido

- Registro: [http://brascap-oficial.test/register](http://brascap-oficial.test/register)
- Dashboard Admin: [http://brascap-oficial.test/register/admin/home](http://brascap-oficial.test/register/admin/home)
