# Projeto Integrador (PI) - ClickVagas

Mural de empregos simples e centralizado para conectar empresas locais que estão contratando com profissionais que buscam novas oportunidades no mercado de trabalho.

![React](https://img.shields.io/badge/Frontend-React%20%2B%20Vite-61DAFB?logo=react&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/CSS-TailwindCSS-38B2AC?logo=tailwindcss&logoColor=white)
![PHP](https://img.shields.io/badge/Backend-PHP%20%2F%20Slim4-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/Banco%20de%20Dados-MySQL-4479A1?logo=mysql&logoColor=white)

## Sobre o projeto

PI para o Módulo de Desenvolvimento de Sistemas do curso Técnico em Informática do Senac.

O **ClickVagas** nasceu para resolver um problema simples: em Tramandaí, o comércio local, polos educacionais e prestadores de serviço divulgam muitas oportunidades, mas esses anúncios acabam se perdendo rapidamente em grupos de WhatsApp e redes sociais. O projeto centraliza essas vagas em um site único, organizado e fácil de navegar.
**Objetivo principal:** criar um site que funcione como um mural de classificados de emprego, substituindo posts pulverizados e difíceis de filtrar por uma listagem clara de vagas abertas.
**Público-alvo:**

- Pessoas que buscam oportunidades de emprego, estágio ou trabalhos freelancer.
- Empresas e recrutadores locais que precisam divulgar vagas de forma acessível.

## Funcionalidades

### O que o sistema terá

- **Tela principal (mural):** : listagem visual com título da vaga, nome da empresa, modelo (presencial, híbrido ou remoto), salário (ou "a combinar") e cidade/bairro.
- **Filtros de busca:** por categoria da vaga (ex: Tecnologia, Agronomia, Medicina) e por modelo de trabalho.
- **Filtros para vagas:** poderá filtrar o tipo de vaga que você procura (ex: Hibrido, Presencial, Home Office).
- **Página de detalhes da vaga:** descrição completa das atividades, requisitos e botão de contato (WhatsApp ou link externo) da empresa.
- **Criação de vagas:** a empresa poderá criar uma vaga personalizada para que seja exatamente o que ela precisa no momento.

### Fora do escopo

- ❌ Chat interno — o contato acontece direto por WhatsApp/e-mail informado no anúncio.
- ❌ Cobrança de taxas para divulgação de vagas.
- ❌ Comentários nas postagens de pós-adoção — apenas reações (curtidas) são permitidas.
- ❌ Edição/exclusão de postagem pelo próprio usuário após publicada.
- ❌ Geolocalização/busca por distância — a localização é apenas um texto livre.
- ❌ Aplicativo mobile nativo — o projeto é apenas web (responsivo).

## Protótipo

> Protótipo das telas em produção no Canva — o link e os prints serão adicionados aqui assim que estiver pronto.

## Arquitetura e tecnologias

| Camada                 | Tecnologia                                                                           |
| ---------------------- | ------------------------------------------------------------------------------------ |
| **Frontend**           | HTML estilizado com TailwindCSS                                          |
| **Backend**            | PHP com o framework Slim4 — API própria (RESTful), seguindo arquitetura MVC          |
| **Banco de dados**     | MySQl                                 |
| **Ambiente local**     | XAMPP                                                                                |
| **Outras ferramentas** | GitHub (versionamento e gestão do projeto)                    |

## Estrutura de pastas

```
Projeto-Integrador-Adote-Me/
├── Backend/
│   ├── public/
│   │   └── index.php          # bootstrap do Slim (dotenv, CORS, error middleware, carrega as rotas)
│   ├── src/
│   │   ├── routes.php         # definição de todas as rotas da API
│   │   ├── Controllers/       # UsuarioController, PetController, PostagemController
│   │   ├── Models/            # Usuario, Pet, Postagem (queries via PDO)
│   │   ├── Middlewares/
│   │   │   └── AuthMiddleware.php   # valida o JWT e o perfil (admin/usuario)
│   │   └── Database/
│   │       └── Connection.php       # conexão PDO com o MySQL
│   ├── .env                   # variáveis de ambiente (não versionado)
│   ├── .env.example
│   └── composer.json
├── Frontend/
│   ├── public/
│   │   └── logoAdote_me.png
│   └── src/
│       ├── main.jsx            # monta <BrowserRouter><App /></BrowserRouter>
│       ├── App.jsx             # define as rotas e as proteções RotaAdmin/RotaLogada
│       ├── components/
│       │   ├── templates/      # Header, Footer, PainelDecorativo, BotaoMostrarSenha
│       │   ├── home/           # seções da Home
│       │   ├── animais/        # listagem/vitrine de pets
│       │   ├── animal/         # detalhe de um pet
│       │   ├── feed/           # feed de postagens pós-adoção
│       │   ├── admin/          # painel administrativo (CRUD de pets)
│       │   ├── login/          # formulário de login
│       │   └── cadastro/       # formulário de cadastro
│       ├── pages/              # uma página por rota (Home, Login, Animais, Admin, ...)
│       ├── services/
│       │   ├── api.js          # cliente fetch da API
│       │   └── sessao.js       # sessão (JWT + usuário) no localStorage
│       └── constants/
│           └── pets.js         # labels e imagem placeholder compartilhados
├── Database/
│   └── database.sql            # schema completo do banco
└── README.md
```

## Estrutura do banco de dados

O banco é composto por três entidades principais: **usuarios** (admins e usuários comuns), **pets** (animais anunciados) e **postagens** (relatos publicados por quem adotou). Os IDs são UUIDs (`CHAR(36)`) em vez de inteiros sequenciais, para não expor a contagem de registros nem permitir adivinhar URLs de outros pets/posts. O UUID é gerado na aplicação PHP com a biblioteca [`ramsey/uuid`](https://github.com/ramsey/uuid) antes do INSERT.

![Diagrama ER](https://i.ibb.co/6RLPgx6m/draw-SQL-image-export-2026-07-02.webp)

### usuarios

| Campo      | Tipo          | Descrição                                |
| ---------- | ------------- | ---------------------------------------- |
| id         | char(36) (PK) | UUID gerado pela aplicação (ramsey/uuid) |
| nome       | string        | Nome do usuário                          |
| email      | string        | E-mail (login), único                    |
| senha_hash | string        | Senha criptografada                      |
| perfil     | string        | `admin` ou `usuario`                     |
| criado_em  | datetime      | Data de criação da conta                 |

### pets

| Campo           | Tipo                        | Descrição                                |
| --------------- | --------------------------- | ---------------------------------------- |
| id              | char(36) (PK)               | UUID gerado pela aplicação (ramsey/uuid) |
| nome            | string                      | Nome do pet                              |
| tipo            | string                      | Cachorro ou gato                         |
| porte           | string                      | Pequeno, médio ou grande                 |
| idade           | string                      | Idade estimada                           |
| cidade / bairro | string                      | Localização do pet                       |
| foto_url        | string                      | Foto do animal                           |
| historia        | text                        | História/descrição do pet                |
| numero / email  | string                      | Contato do responsável pela doação       |
| status          | string                      | `disponivel` ou `adotado`                |
| admin_id        | char(36) (FK → usuarios.id) | Admin que cadastrou o pet                |
| criado_em       | datetime                    | Data do cadastro                         |

### postagens

| Campo      | Tipo                        | Descrição                                |
| ---------- | --------------------------- | ---------------------------------------- |
| id         | char(36) (PK)               | UUID gerado pela aplicação (ramsey/uuid) |
| pet_id     | char(36) (FK → pets.id)     | Pet relacionado ao post                  |
| usuario_id | char(36) (FK → usuarios.id) | Usuário logado que fez o post            |
| foto_url   | string                      | Foto do pet já adotado                   |
| relato     | text                        | Relato de como o pet está                |
| curtidas   | int                         | Contador de reações (sem exigir login)   |
| criado_em  | datetime                    | Data da publicação                       |

### Relacionamentos

- Um **usuario** (perfil `admin`) cadastra vários **pets**.
- Um **usuario** (perfil `usuario`) publica várias **postagens**, mas precisa estar logado para isso.
- Um **pet** pode ter várias **postagens** associadas a ele.

O script completo de criação do banco está em [`database.sql`](./database.sql).

## Endpoints da API

URL base local: `http://localhost:8000`. Rotas protegidas exigem o header `Authorization: Bearer <token>`, obtido em `POST /login`.

| Método | Rota                     | Acesso                | Descrição                                                             |
| ------ | ------------------------ | ---------------------- | ----------------------------------------------------------------------- |
| POST   | `/usuarios`               | Público                | Cadastra um usuário. `perfil` nunca vem do corpo — todo cadastro público é forçado a `usuario` |
| POST   | `/login`                  | Público                | Autentica com e-mail/senha e retorna `{ token, usuario }`               |
| GET    | `/usuarios`                | Logado (`admin`)      | Lista todos os usuários (sem `senha_hash`)                              |
| GET    | `/pets`                    | Público                | Lista pets. Aceita filtros por query string: `?tipo=`, `?porte=` e `?status=` |
| GET    | `/pets/{id}`               | Público                | Detalhe de um pet                                                        |
| POST   | `/pets`                    | Logado (`admin`)      | Cadastra um pet                                                         |
| PUT    | `/pets/{id}`               | Logado (`admin`)      | Atualiza um pet (só os campos enviados são alterados)                   |
| DELETE | `/pets/{id}`               | Logado (`admin`)      | Remove um pet (falha com 409 se houver postagens vinculadas)            |
| GET    | `/postagens`               | Público                | Lista postagens, com `pet_nome`/`usuario_nome` já resolvidos via JOIN   |
| GET    | `/postagens/{id}`          | Público                | Detalhe de uma postagem                                                 |
| POST   | `/postagens`               | Logado (qualquer perfil) | Cria uma postagem pós-adoção (`pet_id`, `foto_url`, `relato`)         |
| POST   | `/postagens/{id}/curtir`   | Público                | Incrementa o contador de curtidas (sem exigir login, sem "descurtir")   |

Respostas de erro seguem o formato `{ "erro": "mensagem" }`, com o status HTTP correspondente (`401` sem token, `403` perfil sem permissão, `404` não encontrado, `409` conflito, `422` validação).

## Como rodar o projeto

Pré-requisitos: PHP 8.1+ com a extensão `pdo_mysql`, [Composer](https://getcomposer.org/), Node.js 18+ e um MySQL/MariaDB local (ex.: via [XAMPP](https://www.apachefriends.org/)).

### 1. Banco de dados

Crie um banco chamado `adote_me` e importe o schema:

```bash
mysql -u root -e "CREATE DATABASE adote_me CHARACTER SET utf8mb4;"
mysql -u root adote_me < Database/database.sql
```

### 2. Backend

```bash
cd Backend
composer install
cp .env.example .env
```

Preencha o `.env` com os dados do seu MySQL local (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`) e defina um `JWT_KEY` (qualquer string secreta). Depois suba o servidor:

```bash
php -S localhost:8000 -t public
```

A API fica disponível em `http://localhost:8000`.

### 3. Frontend

```bash
cd Frontend
npm install
npm run dev
```

O site fica disponível em `http://localhost:5173` (a URL da API está fixa em `Frontend/src/services/api.js`, apontando para `http://localhost:8000`).

### 4. Criar um usuário admin

Não existe cadastro de admin pela interface (por design — evita auto-promoção). Cadastre uma conta normal pelo site e promova-a via SQL:

```sql
UPDATE usuarios SET perfil = 'admin' WHERE email = 'seu@email.com';
```

Faça login novamente após a promoção para receber um token com o novo perfil.

## Padrão de commits

O projeto segue o padrão [Conventional Commits](https://www.conventionalcommits.org/), com mensagens no imperativo e em português.
| Tipo | Quando usar | Exemplo |
| --- | --- | --- |
| `feat` | Nova funcionalidade ou parte da estrutura do sistema | `feat: adiciona script de criação do banco de dados` |
| `fix` | Correção de bug | `fix: corrige filtro de porte na listagem de pets` |
| `docs` | Mudanças em documentação (README, comentários) | `docs: atualiza README com informações do projeto` |
| `chore` | Tarefas de organização/configuração (rename, configs) | `chore: renomeia adote-me.sql para database.sql` |
| `refactor` | Reorganização de código sem mudar comportamento | `refactor: reorganiza rotas da API` |

Boas práticas:

- Verbo no imperativo ("adiciona", "corrige"), não no gerúndio ou particípio.
- Mensagem curta e objetiva na primeira linha (até ~50 caracteres).
- Escopo opcional entre parênteses, ex: `feat(database): adiciona schema inicial`.

## Equipe

- João P. A. de Souza
- Pedro B. Pospichil

## Status

Projeto em desenvolvimento — Projeto Integrador do curso.

<!-- ## Licença
> Defina aqui a licença do projeto (ex: MIT), se aplicável. -->
