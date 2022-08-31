# Crypto Coin for R Web

## RWEB - exercice technique

L’objectif de cet exercice est d’afficher les informations du top 100 des cryptomonnaies (comme sur [https://coinmarketcap.com/](https://coinmarketcap.com/)). 

L’utilisateur doit pouvoir cliquer sur une cryptomonnaie pour voir apparaitre une vue détaillée.

Stack technique à utiliser : 

- Laravel ([https://laravel.com/](https://laravel.com/))
- Livewire ([https://laravel-livewire.com/](https://laravel-livewire.com/))
- Tailwind ([https://tailwindcss.com/](https://tailwindcss.com/))

Pour obtenir les informations à afficher (logo, prix, market cap, etc) vous pouvez utiliser l’API de Coingecko : https://www.coingecko.com/en/api/documentation

Livewire peut être utilisé pour ce que vous souhaitez, quelques idées :

- Live search
- Filtre par market cap
- Tri par prix

Le projet est volontairement peu cadré pour vous permettre de présenter ce qui vous semble le plus intéressant en termes de UI/UX.

## Installation

Cloner le depôt sur Github:
```bash
git clone https://git@github.com:abdoul-rb/crypto-coin.git
```

Basculez dans le dossier du projet
```bash
cd crypto-coin
```

Installez toutes les dépendances à l'aide de composer
```bash
composer install
```

Copiez l'exemple de fichier env et modifier la configuration requises
```bash
cp .env.example .env
```

Générer une nouvelle clé d'application
```bash
php artisan key:generate
```

Lancer le serveur de développement interne de Laravel
```bash
php artisan serve
```

Vous pouvez maintenant accéder au serveur à l' adresse [https://localhost:8000](https://localhost:8000)

### Liste des commandes TL; DR

```bash
git clone https://git@github.com:abdoul-rb/crypto-coin.git
cd crypto-coin
composer install
cp .env.example .env
php artisan key:generate
```

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
