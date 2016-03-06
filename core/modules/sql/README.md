# Sql
##### Auteur : Sacha Wendling (Goldware)
##### Date : 09/01/2016
##### Licence : GNU GPL v3.0
##### Description : Ce module sert à effectuer des opérations sur une base de donnée MySQL

## Usage
```php
Sql->createDbConnection($host, $db_name, $user, $password, $charset) : object::PDO
```
```
$host : adresse du serveur de la base de donnée
$db_name : nom de la base de donnée
$user : nom d'utilisateur d'authentification
$password : mot de passe d'authentification
$charset : encodage a utiliser pour les requêtes
```
```php
Sql->requestSql($db, $request, $req_array = []) : array
```
```
$db : instance de la base de donnée (obtenue au préalable avec createDbConnection)
$request : variable contenant la requête SQL en elle même
$req_array : variable optionnelle à paramétrer si vous souhaitez exécuter une requête préparée
```
