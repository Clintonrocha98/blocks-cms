# MVP CMS

Sistema de gerenciamento de páginas dinâmicas orientado a blocos, focado em agilidade, flexibilidade e experiência de edição moderna.

Projetado do zero para equipes de produto, marketing e desenvolvedores que desejam entregar landings, portais, sites institucionais ou áreas dinâmicas sem depender do time de engenharia.

## Principais Recursos

- 🧩 **Arquitetura modular por blocos**: Construa páginas combinando diferentes blocos de conteúdo (texto, imagem, CTA, formulários e mais)
- 🎨 **Interface administrativa moderna**: Painel de controle via [Filament](https://filamentphp.com/) para CRUD das páginas, dos blocos e preview dinâmico do site
- ⚡ **Performance e build modernos**: Utiliza [Vite](https://vitejs.dev/) para assets e [TailwindCSS](https://tailwindcss.com/) para estilização rápida
- ✅ **Sistema de formulários reutilizáveis**: Defina regras de validação, aceite submissões dinâmicas e customize comportamentos facilmente
- 🔒 **Pronto para produção**: Queue, cache, storage, logs e múltiplos ambientes integrados nativamente com Laravel
- 🧑‍💻 **Extensibilidade**: Adicione novos blocos via ValueObjects PHP, schemas ou Vue/React no frontend

## Instalação

Pré-requisitos:
- PHP ^8.2
- Node.js & npm
- Composer
- Banco SQLite (default) ou alterar para MySQL/Postgres

**Passos:**

```bash
# Clone o projeto (ou baixe o zip)
git clone ...
cd mvp-cms

# Instale as dependências Composer e NPM
composer install
npm install

# Copie o arquivo de ambiente e gere a chave Laravel
cp .env.example .env
php artisan key:generate

# Rode as migrações para criar as tabelas básicas
db sqlite:touch (ou configure seu banco no .env)
php artisan migrate

# Rode o servidor de desenvolvimento e assets
dev (roda tudo em paralelo)
# ou em terminais separados:
php artisan serve
npm run dev
```

Acesse: [http://localhost:8000](http://localhost:8000)

## Organização do Projeto

- **app/Models/Page.php / PageBlock.php**: Estrutura de página e seus blocos
- **app/Filament/**: Configuração dos painéis administrativos
- **resources/views/**: Blades dos blocos e páginas
- **app/Forms/**: Registro de formulários reutilizáveis
- **public/js/**: Assets produzidos pelo Vite
- **database/migrations/**: Estrutura do banco de dados

## Como criar um novo bloco?
1. Crie um ValueObject em `app/ValueObjects`
2. Crie schema em `app/Filament/Schemas`
3. Adicione a renderização Blade em `resources/views/components/blocks`
4. Registre o bloco no lugar apropriado

## Licença

MIT. Sinta-se livre para usar, modificar e contribuir!

---
Desenvolvido com Laravel, Filament, Vite e TailwindCSS.