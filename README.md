*/!\ ATTENTION : Vous êtes sur la documentation de Lynx Framework dans sa version 1, vous trouverez sur la branche "2.0.0" la documentation associée /!\*

# Installation

Pour installer Lynx, il suffit de cloner ce repository Github :
```sh
$ git clone https://github.com/Goldware/Lynx-Framework
```
Vous devrez ensuite sélectionner la version de Lynx que vous souhaitez utiliser pour votre projet : 
```sh
$ git checkout x.x.x
```

# Initialisation
Avant d'écrire la première ligne quelconque de votre projet, il vous faut paramétrer tout d'abord le framework. Voici le lien du fichier : *core/config.php*
Voici à quoi servent les différentes variables de configuration :
  - *$archiveRequest* : Définit si le framework enregistre les IP se connectant aux site.
  - *$title* : Définit le contenu de la balise *<title></title>*
  - *$footer_legend* : Définit le texte du footer
  - *$faviconDir* : Définit le chemin du favicon
  - *$encode* : Définit l'encodage du site
  - *$useOwnCss* : Définit si vous utilisez votre propre CSS. Le CSS par défaut étant Bootstrap : http://getbootstrap.com/
  - *$ownCssDir* : Définit le chemin de votre CSS
  - *$useSass* : Définit si vous utilisez SASS 
  - *$ownSassDir* : Définit le chemin de votre SASS
  - *$useFooter* : Définit si vous utilisez ou non le footer fourni avec le framework
  - *$useNavbar* : Définit si vous utilisez ou non la navbar fournie avec le framework
  - *$host* : Définit l'adresse du serveur de base de données SQL
  - *$db_name* : Définit le nom de la base de donnée à utiliser
  - *$user* : Définit le nom d'utilisateur pour l'authentification au serveur SQL
  - *$password* : Définit le mot de passe pour l'authentification au serveur SQL
  - *$charset* : Définit l'encodage des données à utiliser pour les requêtes SQL
 

# Système de vue
Une fois configuré le framework, il vous faut configurer l'architecture de vos vues. Cette fois ci nous allons travailler dans *core/views* et dans le fichier *index.php* dans le dossier racine.

### Paramétrage des variables GET
La navigation dans Lynx tourne autour de la variable *$_GET['page']*. C'est donc une navigation de type single page. Nous allons d'abord modifier le fichier *index.php*
```php
if(isset($_GET['page']) && $_GET['page'] == 0)
{
    include('views/portfolio.php');
}
elseif(isset($_GET['page']) && $_GET['page'] == 1)
{
    include('views/about.php');
}
else
{
    include('views/index.php');
}
```
Pour illustrer ce code conditionnel, voici ci-dessous un résumé :
  - 0 : portfolio.php
  - 1 : about.php
  - *undefined* : index.php

Une URL ressemble donc à cela : *index.php?page=1* Une fois configuré votre fichier *index.php* il vous suffira donc d'ajouter, si on suit l'exemple ci-dessus les fichiers *portfolio.php* et *about.php* dans le dossier *views*.

> Dans l'attribut href de vos liens, dans votre navbar par exemple, vous mettrez : index.php?page=...

### Vues partielles
Comme vous l'aurez peut-être remarqué, il y a un dossier *partials* dans le dossier *views*. Ce dossier contient les vues utilisées dans les autres vues. La navbar par exemple étant incluse dans toutes les vues se trouve dans le dossier *partials*, vous pourrez donc le modifier comme vous le souhaitez.

# Modules
La plus grosse fonctionnalité de ce framework est son système de module. Car Lynx sans module ne sert à rien. Heureusement, si vous allez dans le dossier *core/modules*, vous verrez 4 dossiers, un dossier pour chaque module. Ces 4 modules sont des modules natifs. Voici à quoi servent-ils :
  - *form-checker* : Ce module sert à vérifier la validité d'un formulaire
  - *php-sass* : Ce module permet de compiler du SASS/SCSS en PHP
  - *sql* : Ce module apporte des fonctions pour faciliter la communication avec une base de donnée SQL
  - *system* : Ce module est relié directement au framework. Il contient des fonctions retournant des informations liées au framework.

A chaque version, il sera rajouté des modules. En attendant, vous pouvez développer vos propres modules.

### Développement
Nous allons voir dans cette partie le développement d'un module Lynx. Voici ci-dessous l'arborescence d'un module :
  - module-name
    - load.php

Un module ne peut contenir qu'un seul fichier, mais par convention on nomme se fichier *load.php*, le dossier qui le contient lui se nomme comme le module, évitez les espaces. Voyons maintenant l'intérieur de *load.php* :
```php
class moduleName
{
    function a()
    {
    
    }
    
    function b()
    {
        
    }
}
```
La syntaxe est relativement simple, mais évidemment vous pouvez changer la composition de votre module comme vous voulez. Un module peut dépendre d'un autre. Il faut en revanche que la dépendance soit incluse avant votre module dans le framework.

### Installation
Comme nous venons de voir, vous pouvez donc inclure les modules d'autres développeurs. Il suffit donc de le télécharger, et de créer un dossier du nom du module dans *core/modules*. Puis placez *load.php* et d'autres fichiers éventuels dans ce dossier.
Hélas, nous n'avons placé que les fichiers du module, cela ne suffit pas pour pouvoir l'utiliser. Pour inclure un module, il faut modifier *core/modules.php*.
```php
include('core/modules/system/load.php');
include('core/modules/php-sass/load.php');
include('core/modules/sql/load.php');
include('core/modules/form-checker/load.php');
```
A partir de là c'est très simple, il suffit juste de charger votre module en rajoutant cette ligne :
```php
include('core/modules/module-name/load.php');
```

### Utilisation
Un module est composé d'une classe. Donc pour utiliser un module, il suffit d'instancier la classe qui le compose. Reprenons notre module "moduleName". Sa classe est donc *moduleName*.
```php
$moduleName = new moduleName;
```
"moduleName" est composé de deux fonctions : *a()* et *b()*.
```php
$moduleName->a();
$moduleName->b();
```
> Notons aussi que la portée d'un module s'étend sur tout le framework.

# Contrôleur
Dans cette partie nous allons voir l'aspect MVC du framework. Il va donc falloir être à l'aise avec ce système. Les contrôleurs sont composés d'une classe et d'une fonction *Start()*, il peut aussi en contenir d'autres. Ils sont aussi contenus dans des fichiers individuels dans le dossier *core/controller* Pour vous servir du contrôleur, vous devez l'instancier dans votre vue, pour vérifier la validiter d'un formulaire par exemple. On créera donc un contrôleur *registerController*. On l'instancie dans une vue ou il y a le formulaire à vérifier.
```php
include('core/controller/registerController.php');
$registerController = new registerController;
$registerController->Start($_POST, $host, $db_name, $user, $password, $charset);
```

Voici le code du contrôleur :
```php
class registerController
{
    function Start($post_array, $host, $db_name, $user, $password, $charset)
    {
        $formChecker = new formChecker;
        
        $fields = ['pseudo', 'name', 'city'];
        $fields_req = array(
            'pseudo' => $post_array['pseudo'],
            'name' => $post_array['name'],
            'city' => $post_array['city']
        );
        
        $fieldIdOptional = [2];
        if($formChecker->isValidForm($post_array, $fields, $fieldIdOptional))
        {
            $set = new setModel;
            $Sql = new Sql;
            
            $db = $Sql->createDbConnection($host, $db_name, $user, $password, $charset);    
            $set->addMember($db, $fields_req);
            header('Location: index.php?success=1');
        }
        else
        {
            header('Location: index.php?error=1');
        }
    }
}
```
Comme vous avez peut-être remarqué, la classe *setModel* est instanciée. C'est en fait une des classes de la partie *Modèle*. Celle qui interagit avec la base de donnée. Nous verrons après comment s'en servir.
On remarque aussi que le module *formChecker* est instancié, pour vérifier la vérification du formulaire, elle se fait avec cette ligne :
```php
$formChecker->isValidForm($post_array, $fields, $fieldIdOptional);
```
Le module *Sql* est aussi utilisé pour créer la connexion à la base de donnée en utilisant les variables du fichier *config.php* :
```php
$db = $Sql->createDbConnection($host, $db_name, $user, $password, $charset);
```

# Modèle
Comme il a été vaguement expliqué dans la partie précédente, il y a deux classe modèle. Il y a le *getModel* et le *setModel*. Ils sont séparés respectivement dans deux fichiers *get.php* et *set.php*, dans le dossier *core/model*. Vos fonctions qui feront le lien avec votre base de donnée seront donc réparties dans les deux fichiers selon leur fonctionnalité.
Dans la classe *getModel* : placez les fonctions qui récupèrent des informations dans votre base de donnée. Dans la classe *setModel* : placez les fonctions qui ajoutent ou modifient des informations dans votre base de donnée. Vous n'aurez pas besoin de charger les classes dans votre contrôleur, ils sont déjà inclus dans *init.php*

Reprenons l'exemple du contrôleur qui vérifie un formulaire. La classe *setModel* est instanciée  :
```php
$set = new setModel;
```
Vous voyez ensuite plus loin la fonction *addMember()* du *setModel* :
```php
$set->addMember($db, $fields_req);
```
Comme la plupart de vos fonctions dans vos classes modèles, elles prendront en argument les informations de connexion à la base de donnée.
Voici le code de la fonction *addMember()* :
```php
class setModel
{
    function addMember($db, $fields_req)
    {
        $Sql = new Sql;
        $Sql->requestSql($db, 'INSERT INTO testjs(pseudo, name, city) VALUES(:pseudo, :name, :city)', $fields_req);
    }
}
```
A partir de là, vous êtes capable de comprendre cette fonction tout seul. On instancie le module *Sql*, et on appelle la fonction *requestSql()* qui nous récupère des informations dans la base de donnée avec les informations de connexion, la requête SQL, et le tableau contenant les valeurs à entrer.

# Securité
Un des buts de Lynx, est la securité. Elle n'est pas encore très développé en revanche vous pouvez sauvegarder les IP des utilisateurs se connectant à votre site. Si vous êtes victime d'un DDOS, vous saurez quel(s) IP est fautive. 
Comment activer l'archivage des IP ? Vous avez dans le fichier *core/config.php* une variable permet d'activer ce système. Il s'agit de *$archiveRequest*, fixez cette valeur à *true*. Les IP sont stockées ligne par ligne dans des fichiers journaliers, dans le dossier *archive*.
> D'autres systèmes de sécurité seront mis en place dans ce framework. Ils arriveront dans une prochaine version.

# $data[]
Une autre fonctionnalité de Lynx est le tableau *$data*. Ce tableau à une portée globale par rapport au framework. Ainsi vous pouvez échanger des informations à travers les différentes couches de votre application.
Utilisation :
```php
$data['value'] = 'valeur à portée globale';
```
Cela fonctionne comme une session, en revanche vous n'avez pas besoin de faire un *session_start()*. D'ailleurs, vous pouvez aussi utiliser les sessions, car une session est déjà initialisée.

# Conclusion
Voilà c'est ici que cette présentation se termine. Si ce framework vous plait n'hésitez pas à augmenter ses capacités en développant vous même vos propres modules, et en les partageant avec toute la communauté. N'hésitez pas à faire part de vos impressions avec Lynx, et/ou donner des idées pour les prochaines versions.
