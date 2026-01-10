# Blocks CMS

> Um CMS Laravel modular, extensível e orientado a blocos de conteúdo

---

## Visão Geral

Este projeto implementa um **CMS modular baseado em blocos**, construído em Laravel, com foco em:

* reutilização de componentes de conteúdo
* extensibilidade por convenção
* separação clara entre domínio, infraestrutura e UI
* uso como módulo interno, plugin ou pacote

Todo o código relacionado a domínio e negócio vive em `app-modules/`.
O núcleo do CMS está localizado em `app-modules/cms`.

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
   php artisan migrate
   ```

4. Inicie o ambiente de desenvolvimento:

   ```bash
   composer run dev
   ```

---

## Makefile e Automação

O projeto possui um `Makefile` para tarefas comuns:

* `make build` – build do projeto
* `make pint` – formatação com Laravel Pint
* `make rector` – refatoração automática

---

## Arquitetura Modular

* Cada domínio/autonomia do sistema vive em `app-modules/<modulo>`.
* O CMS reside em `app-modules/cms`.
* O CMS é composto por **blocos de conteúdo** (Blocks), que representam unidades renderizáveis de uma página.

---

## Conceito Central: Blocks

Um **Block** é a menor unidade de conteúdo renderizável de uma página.

Exemplos:

* Hero
* Text
* CTA
* Features
* Footer

Uma página é composta por uma sequência ordenada de blocks.

---

## Estrutura de um Block

Cada block reside em:

```
app-modules/cms/src/Blocks/<NomeDoBloco>/
```

Cada bloco é composto por três partes principais:

### 1. Block (Definição)

Classe principal do componente.

Responsabilidades:

* identificar o tipo do bloco
* fornecer label amigável
* expor o schema do admin (Filament)
* definir como renderizar suas variações
* converter dados persistidos em `BlockData`

Implementa o contrato `BlockDefinition`.

---

### 2. Data (DTO)

Objeto imutável que representa **os dados do bloco**.

Responsabilidades:

* encapsular dados vindos do banco
* normalizar defaults
* fornecer helpers para a view
* não conter lógica de infraestrutura ou UI

Implementa `BlockData`.

---

### 3. Schema (Admin / Filament)

Schema usado exclusivamente no painel administrativo.

Responsabilidades:

* definir campos editáveis do bloco
* não conhecer detalhes de renderização
* não conter lógica de descoberta

O schema **não define mais variações manualmente**.
A escolha da variação é feita no nível da página, antes da aplicação do schema específico do bloco.

---

## Variações de Blocos

Cada bloco pode possuir múltiplas **variações visuais**.

### Convenção de Variações

As variações são definidas **exclusivamente por arquivos Blade**:

```
resources/views/components/blocks/<slug-do-bloco>/<variant>.blade.php
```

Exemplo:

```
blocks/text/simple.blade.php
blocks/text/rich.blade.php
```

* Cada arquivo representa uma variação
* Não existe registro manual de variantes
* A existência do arquivo é a fonte da verdade

---

## Descoberta Automática de Blocos e Variações

A descoberta de blocos e variações é feita automaticamente pela infraestrutura do CMS, baseada em convenções de pasta e arquivos, sem necessidade de registro manual.
### BlockCatalog

Responsável por:

* listar todos os blocos disponíveis
* listar variantes de um bloco
* fornecer opções para selects do admin

### BlockFactory

Responsável por:

* instanciar `BlockDefinition`
* cachear instâncias por request
* garantir que blocos sejam stateless

Ambos residem em:

```
app-modules/cms/src/Infrastructure/
```

Essa separação garante:

* clareza semântica
* desacoplamento do domínio
* facilidade de evolução

---

## Renderização de Páginas

Durante a renderização:

1. A página carrega seus `PageBlock`
2. Cada `PageBlock`:

    * resolve seu `BlockDefinition` via `BlockFactory`
    * transforma dados persistidos em `BlockData`
    * determina a view correta com base na variação
3. A view recebe o `BlockData` tipado

Exemplo simplificado:

```blade
<x-dynamic-component
    :component="$block->view()"
    :data="$block->content()"
/>
```

---

## Persistência de Dados

* Os dados de cada bloco são armazenados em `page_blocks.data` (JSON)
* A variação selecionada faz parte dos dados do bloco
* A ordenação é feita por `position`

O domínio permanece independente do formato de persistência.

---

## Criação de Blocos via CLI

### Criar um novo Block

```bash
php artisan cms:make-block Text --variants=default,rich
```

Gera automaticamente:

* BlockDefinition
* BlockData
* BlockSchema
* Views para cada variação
* Comentários de tipagem nas views para IDE

---

### Criar nova variação para um Block existente

```bash
php artisan cms:make-variant text grid
```

Cria:

```
resources/views/components/blocks/text/grid.blade.php
```

A nova variação passa a ser automaticamente:

* detectada pelo CMS
* exibida no select de variações
* renderizável sem configuração adicional

---

## Princípios Arquiteturais

* **Convention over Configuration**
* **Blocks são stateless**
* **Dados vivem no banco, não no bloco**
* **Views são fonte de verdade para variações**
* **Infraestrutura separada do domínio**
* **Admin desacoplado da renderização**
