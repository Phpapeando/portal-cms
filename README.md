
# Portal CMS para gerenciamento de Sites

## Visão Geral

Este sistema de gerenciamento de projetos é uma aplicação desenvolvida com Laravel 11 e oferece funcionalidades completas para criar, visualizar, editar e excluir projetos, tarefas e usuários. Ele permite que equipes colaborem de forma eficiente, acompanhando o progresso de tarefas e projetos em tempo real.

## Funcionalidades

- **Tarefas**: Gerenciamento de tarefas com atribuição a projetos e usuários.
- **Gerenciamento de Projetos**: Criação, edição, exclusão e visualização de projetos.
- **Perfis de Usuários**: Definição de permissões e papéis dentro do sistema.
- **Autenticação e Segurança**: Autenticação via API, gerenciamento de usuários e permissões de acesso.

## Tecnologias Utilizadas

- **Backend**: Laravel 11
- **Frontend**: Blade em conjunto com o template do AdminLTE
- **Banco de Dados**: Sqlite
- **Autenticação**: Sanctum

## Instalação e Configuração

### Pré-requisitos

Certifique-se de ter os seguintes requisitos instalados:

- PHP >= 8.3
- Composer

### Passos para Instalação

1. Clone o repositório:
   ```bash
   git clone  https://github.com/Phpapeando/portal-cms.git
   ```

2. Navegue até o diretório do projeto:
   ```bash
   cd portal-cms
   ```

3. Instale as dependências do Composer:
   ```bash
   composer install
   ```

4. Copie o arquivo `.env.example` para `.env`:
   ```bash
   cp .env.example .env
   ```

5. Configure as variáveis de ambiente no arquivo `.env`. (Opcional) Inclua as credenciais do seu banco de dados caso não queira utilizar o sqlite.

6. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

8. Execute as migrações do banco de dados:
   ```bash
   php artisan migrate
   ```

10. Popule o banco de dados com dados iniciais:
   ```bash
   php artisan db:seed
   ```

11. Inicie o servidor de desenvolvimento:
   ```bash
   php artisan serve
   ```

12. Acesse a aplicação em `http://localhost:8000`.

## Contribuição

Contribuições são bem-vindas!

Se deseja contribuir para o desenvolvimento do sistema, sinta-se à vontade para abrir um pull request ou reportar issues.

Para contribuir:
1. Faça um fork do repositório.
2. Crie um novo branch com suas alterações: `git checkout -b minha-alteracao`.
3. Commit suas mudanças: `git commit -m 'Minha alteração'`.
4. Envie para o branch principal: `git push origin minha-alteracao`.
5. Abra um Pull Request.


## Licença
Este projeto está sob a licença MIT. Para mais detalhes, consulte o arquivo [MIT license](https://opensource.org/licenses/MIT).
