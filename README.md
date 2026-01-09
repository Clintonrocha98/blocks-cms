# MVP CMS

> Um CMS Laravel altamente modular e extensível

## Visão Geral
Este projeto implementa um **CMS modular** usando Laravel, pensado para uso próprio, como plugin, pacote ou módulo interno em outros sistemas. Tudo o que é negócio e componentes reside na pasta `app-modules`, sendo o núcleo do CMS em `app-modules/cms`.

## Iniciando o Projeto Laravel (Configuração Básica)
1. Instale as dependências:
   ```bash
   composer install
   ```
2. Configure variáveis de ambiente em `.env` (copie `.env.example` se existir).
3. Execute as migrations:
   ```bash
   php artisan migrate
   ```
4. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```
5. Inicie o servidor:
   ```bash
   composer run dev
   ```

## Makefile e Automação
O projeto possui Makefile com scripts úteis:
- `make build`: build do projeto
- `make pint`: formatação com Laravel Pint
- `make rector`: refatoração automática

Consulte o Makefile para outros comandos e automações especificas do projeto.

## Arquitetura Modular
- Cada módulo/autonomia de negócio fica em uma subpasta de `app-modules`.
- O núcleo do CMS fica em `app-modules/cms`.
- Componentes ("blocos") residem em `app-modules/cms/src/Blocks/NOME/`, cada pasta representa um componente.

## Estrutura de um Bloco (Componente)
Dentro de `app-modules/cms/src/Blocks/NOME/` cada componente possui:
- **data**: Objeto DTO do componente, com todos os dados usados na renderização e edição.
- **schema**: Schema Filament para gestão/admin dos dados do bloco e formulários. **Todo schema deve usar o trait** `@app-modules/cms/src/Trait/HasVariants.php` **e chamar** `self::variantField('nome-do-componente')` no início do schema. Isso garante edição/seleção dinâmica das variações do componente de forma padronizada!
- **block**: Classe principal deste componente, que referencia schema, data, view, type (tipo do bloco) e label (nome amigável).

## Renderização de Variações
A função `self::variantField()` no schema, junto ao trait HasVariants, adiciona um campo select que lista todas as variações disponíveis para aquele bloco. As variações são descobertas automaticamente via **BlockRegistry**.

## Descoberta Automática de Componentes
O arquivo **`@app-modules/cms/src/Registry/BlockRegistry.php`** é responsável por descobrir todos os componentes e suas variações automaticamente usando:
- Scanning dos blocos criados em `app-modules/cms/src/Blocks/`.
- Procura pelas variações nos arquivos blade em `app-modules/cms/resources/views/components/blocks/<nome>/<variante>.blade.php`.

## Views e Variações dos Componentes
- Views de componentes residem em `app-modules/cms/resources/views/components/blocks/<nome-do-bloco>/`.
- Cada arquivo `.blade.php` dentro da pasta do bloco representa uma **variação/versão**.

## Criação de Componentes e Variações por Comando
### Criar Novo Componente:
```
php artisan cms:make-block NomeDoBloco --variants=default,grid
```
Cria toda estrutura: classe principal, DTO, schema, e views blade para cada variante.

### Criar Nova Variação de Componente:
```
php artisan cms:make-variant nome-do-bloco nova-variacao
```
Cria um novo arquivo Blade para a variação dentro da pasta de views do componente.





