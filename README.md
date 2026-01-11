# Blocks CMS

> Um CMS Laravel modular, extensível e orientado a blocos de conteúdo

---

## Índice

- [Visão Geral](#visão-geral)
- [Setup Inicial do Projeto](#setup-inicial-do-projeto)
- [Makefile e Automação](#makefile-e-automação)
- [Arquitetura e Padrões](#arquitetura-e-padrões)
  - [Conceito Central: Blocks](#conceito-central-blocks)
  - [Estrutura de um Block](#estrutura-de-um-block)
  - [Variações de Blocos](#variações-de-blocos)
  - [Descoberta Automática e Infraestrutura](#descoberta-automática-e-infraestrutura)
- [CLI — Criando Blocos e Variações (Guia)](#cli--criando-blocos-e-variações-guia)
  - [Exemplos de uso](#exemplos-de-uso)
  - [O que os comandos geram](#o-que-os-comandos-geram)
  - [Detecção automática de blocos/variações](#detecção-automática-de-blocosvariações)
  - [Saída (output) do CLI](#saída-output-do-cli)
  - [Fluxo recomendado após gerar um bloco](#fluxo-recomendado-após-gerar-um-bloco)
- [Renderização de Páginas](#renderização-de-páginas)
- [Configuração do CMS](#configuração-do-cms)
- [Persistência de Dados](#persistência-de-dados)
- [Rotas do CMS](#rotas-do-cms)
- [Estado Atual do Projeto](#estado-atual-do-projeto)

---

## Visão Geral

Este projeto implementa um **CMS modular baseado em blocos**, construído em Laravel, com foco em:

- reutilização de componentes de conteúdo
- extensibilidade por convenção
- separação clara entre domínio, infraestrutura e UI
- uso como módulo interno, plugin ou pacote

Todo o código relacionado a domínio e negócio fica em `app-modules/`. O núcleo do CMS reside em `app-modules/cms`.

---

## Setup Inicial do Projeto

1. Instale as dependências:

```bash
composer install
```

2. Configure o ambiente:

```bash
cp .env.example .env
php artisan key:generate
```

3. Execute as migrations:

```bash
php artisan migrate --seed
```

4. Inicie o ambiente de desenvolvimento:

```bash
composer run dev
```

---

## Makefile e Automação

O projeto possui um `Makefile` para tarefas comuns:

- `make build` – build do projeto
- `make pint` – formatação com Laravel Pint
- `make rector` – refatoração automática

---

## Arquitetura e Padrões

Esta seção descreve a arquitetura esperada pelos blocos e os padrões que o CMS usa para descobrir e renderizar componentes.

### Conceito Central: Blocks

Um **Block** é a menor unidade de conteúdo renderizável de uma página. Exemplos: Hero, Text, CTA, Features, Footer. Uma página é composta por uma sequência ordenada de blocks.

### Estrutura de um Block

Cada block vive em:

```
app-modules/cms/src/Blocks/<NomeDoBloco>/
```

Cada bloco tem três responsabilidades principais:

1. Block (Definição)
   - Classe principal do bloco (ex.: `TextBlock`).
   - Identifica o tipo do bloco, fornece label amigável, expõe schema do admin e define como renderizar variações.
   - Implementa o contrato `BlockDefinition`.

2. Data (DTO)
   - DTO imutável que representa os dados do bloco (ex.: `TextData`).
   - Normaliza defaults e fornece helpers para a view.
   - Implementa `BlockData`.

3. Schema (Admin / Filament)
   - Schema usado no painel administrativo para editar o `data` do bloco.
   - Deve escrever/ler campos dentro de `data.*` (o conteúdo do bloco é persistido em JSON).

### Variações de Blocos

As variações visuais são definidas exclusivamente por arquivos Blade:

```
resources/views/components/blocks/<slug-do-bloco>/<variant>.blade.php
```

- Cada arquivo representa uma variação.
- Não existe registro manual; a existência do arquivo é a fonte da verdade.

### Descoberta Automática e Infraestrutura

- `BlockCatalog` faz listagem de blocos e variantes para selects e admin.
- `BlockFactory` instancia e fornece instâncias de `BlockDefinition` (estateless, cacheadas por request).
- Esses componentes vivem em `app-modules/cms/src/Infrastructure/`.

Separação clara entre domínio e infraestrutura facilita evolução e teste.

---

## CLI — Criando Blocos e Variações (Guia)

Esta seção reúne o uso dos comandos CLI do CMS, exemplos práticos e o comportamento esperado (detecção e outputs).

### Exemplos de uso

- Criar um bloco com variantes (option arrays):

```bash
php artisan cms:make-block Text --variants=default --variants=rich
```

- Criar um bloco e seguir prompts interativos:

```bash
php artisan cms:make-block Text
```

- Criar uma nova variação para um bloco existente:

```bash
php artisan cms:make-variant text grid
```

Observações:
- `cms:make-block` aceita `--variants=*` (ex.: `--variants=default --variants=rich`).
- Se faltarem argumentos obrigatórios, o Laravel fará prompts automáticos (Prompts for Missing Input).

### O que os comandos geram

- `cms:make-block <Name>` gera:
  - `BlockDefinition` (ex.: `TextBlock` em `app-modules/cms/src/Blocks/Text/TextBlock.php`)
  - `BlockData` (ex.: `TextData` em `app-modules/cms/src/Blocks/Text/TextData.php`)
  - `BlockSchema` (ex.: `TextSchema` em `app-modules/cms/src/Blocks/Text/TextSchema.php`)
  - Views Blade para cada variação em `app-modules/cms/resources/views/components/blocks/<slug>/<variant>.blade.php`

- `cms:make-variant <block> <variant>` gera:
  - Apenas o arquivo Blade da variação desejada.

### Detecção automática de blocos/variações

- As views são a "fonte da verdade". Ao criar um novo arquivo Blade em `resources/views/components/blocks/<slug>/<variant>.blade.php`, o CMS passa a detectar automaticamente:
  - Novos blocos (quando surge uma nova pasta em `resources/views/components/blocks`).
  - Novas variações (quando surge um novo arquivo dentro da pasta do bloco).
- O `BlockCatalog` e a infra do CMS atualizarão as opções do admin para incluir a nova variação — nada mais é necessário.

### Saída (output) do CLI

Após executar o comando, o CLI exibe um resumo organizado:

- `Arquivos criados` — lista de novos arquivos gerados.
- `Arquivos sobrescritos` — lista de arquivos atualizados (após confirmação ou `--force`).
- Se arquivos já existirem e `--force` não foi informado, o comando pergunta se deseja sobrescrever.

Exemplo de saída:

```
Bloco CMS Text criado com sucesso.

Arquivos criados:
  • app-modules/cms/src/Blocks/Text/TextBlock.php
  • app-modules/cms/src/Blocks/Text/TextData.php
  • app-modules/cms/resources/views/components/blocks/text/default.blade.php

Arquivos sobrescritos:
  • app-modules/cms/src/Blocks/Text/TextSchema.php
```

### Fluxo recomendado após gerar um bloco

1. Ajuste o `Schema` do bloco (`app-modules/cms/src/Blocks/<Name>/<Name>Schema.php`) para expor os campos do admin — sempre dentro de `data.*`.
2. Implemente defaults e helpers no `Data` (DTO) para facilitar as views.
3. Edite as Views Blade geradas para compor a UI do bloco.
4. Teste no painel (`/cms`) adicionando o bloco a uma página e validando a renderização pública.

---

## Renderização de Páginas

Durante a renderização:

1. A página carrega seus `PageBlock`.
2. Cada `PageBlock`:
   - resolve seu `BlockDefinition` via `BlockFactory`;
   - transforma dados persistidos em `BlockData`;
   - determina a view correta com base na variação.
3. A view recebe o `BlockData` tipado.

Exemplo simplificado:

```blade
<x-dynamic-component
    :component="$block->view()"
    :data="$block->content()"
/>
```

---

---

## Configuração do CMS

O pacote expõe um arquivo de configuração `config/cms.php` com as seguintes chaves principais:

- `cms.blocks.path` — caminho onde as classes de Block são lidas/geradas. Default: `app/Blocks`.
- `cms.blocks.namespace` — namespace base usado para classes de Block geradas. Default: `App\\Blocks`.
- `cms.views.path` — caminho onde as views (variações) são lidas/geradas. Default: `resources/views/components/blocks`.
- `cms.views.namespace` — namespace/prefixo de views usado pelo método `view()` dos blocos (dot notation). Default: `components.blocks` (app views).
- `cms.stubs.path` — caminho local para stubs customizados (project-level). Default: `resources/stubs/cms`.
- `cms.stubs.package_path` — fallback para os stubs que vêm com o pacote. Default: `app-modules/cms/stubs`.

Publicar o arquivo de configuração e os stubs para customização:

```bash
php artisan vendor:publish --tag="cms-config"
php artisan vendor:publish --tag="cms-stubs"
```

---

## Persistência de Dados

- Os dados de cada bloco são armazenados em `page_blocks.data` (JSON).
- A variação selecionada faz parte dos dados do bloco.
- A ordenação é feita por `position`.

---

## Rotas do CMS

### Painel Administrativo (CMS)

Acesso ao painel de gerenciamento de páginas e blocos:

```
http://localhost:8000/cms
```

### Visualização de Página Pública

Cada página criada no CMS é acessível publicamente através do seu slug:

```
http://localhost:8000/{slug-da-pagina}
```

---

## Estado Atual do Projeto

Este projeto está em **fase de MVP** e algumas partes ainda são **provisórias**:

- O **layout da página pública** é simples e básico, servindo apenas como prova de conceito.
- Os **schemas do Filament** também são básicos.
- Os blocos e componentes existentes foram criados **principalmente para teste e validação da arquitetura**, não como versão final de UI.

Esses pontos serão refinados conforme a evolução do projeto.

---

