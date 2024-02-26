# Rodando o projeto

## Passo 1: Clonando o repositório

```bash
git clone https://github.com/VerdadeiroMestre/atlas-shrugged-backend

cd atlas-shrugged-backend
```
## Passo 2: Intalando dependências

```bash
composer intall
```

## Passo 3: Preparando banco de dados

Crie uma tabela no seu banco de dados local com o nome `atlas`

## Passo 4: Preparando arquivo .env

Rode o seguinte comando:

```bash
cp .env.example .env
```
Caso necessite senha para acessar seu banco de dados, altere a linha `DB_PASSWORD` no seu arquivo .env

## Passo 5: Configurações finais do banco de dados

Rode os seguintes comandos:

```bash
php artisan migrate

php artisan db:seed
```

## Passo 6: Rode o projeto

Use o seguinte comando para colocar o servidor para funcionar:

```bash
php artisan serve
```