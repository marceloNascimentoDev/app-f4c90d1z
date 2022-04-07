# Sobre o projeto

Este é um projeto em PHP desenvolvido utilizando o framework Laravel 7 utilizando o padrão MVC e php 7.4.

##### Documentação da API: https://documenter.getpostman.com/view/14447906/UVyxNsqN

## O Desafio

#### Requisitos

- Criar uma API Rest para realizar as seguintes ações:
    ### Cadastro de produtos com os seguintes campos obrigatórios:
        - Nome
        - SKU
        - Quantidade Inicial
    
    ### Movimentação de produtos
        - SKU
        - Quantidade (para adicionar ou remover)
    
    ### Histórico
        - Precisa retornar um json com uma lista das movimentações realizadas
        - sku
        - quantidade (adicionada ou removida)
        - data/hora (que ocorreu a movimentação)
    
    ### O repositório deverá ter no mínimo 3 commits (pode ser 1 para cada construção de endpoint)
    
    ### No commit precisa estar bem descrito o que foi implementado/entregue

<br>

## A solução

#### Como rodar o projeto

**Antes de seguir os passos abaixo tenha certeza que o docker e docker-compose estão instalados na maquina. Para rodar este projeto:**

1\. Clone este repositorio  e entre na pasta

```
git clone https://github.com/marceloNascimentoDev/app-f4c90d1z.git
cd app-f4c90d1z
```

2\. O arquivo de configurações é o \.env (Já está configurado)\.

3\. Faça o build dos containers \, o container **app** vai usar a porta 8001 e o container **db** irá usar a porta 8306, certifique-se que essas portas estejam livres antes de continuar. Se seu usuário não estiver incluido no grupo de permissões do **docker e docker-compose**  será necessário executar os comandos como administrador (sudo)

```
docker-compose up -d
```

4\. Caso esteja utilizando Linux basta rodar o script de configuração dentro da pasta do projeto que tudo será feito automaticamente

```
.docker/script.sh
```

<br>

5\. Caso não esteja utilizando linux basta rodar os seguintes scripts na pasta do projeto.

```
cp .env.example .env
docker exec $(docker ps -aqf "name=app") composer install
docker exec $(docker ps -aqf "name=app") php artisan migrate --seed --force
docker exec $(docker ps -aqf "name=app") chmod -R 777 storage bootstrap/cache
```

6\. Agora você pode acessar aplicação em [localhost ou clique aqui!](http://localhost:8001)
