
## Introductie

Dit project is gemaakt door Bashar Alhakim en Hussain Moussa. Het is een PHP-programma/framework waarmee gebruikers kaarten kunnen toevoegen en bekijken. Dit Read.me-bestand bevat instructies voor het installeren en uitvoeren van het programma op een lokale omgeving.

## Installatie

Clone de repository naar je lokale machine.
Zorg ervoor dat PHP is geïnstalleerd op je machine.
Zorg ervoor dat je in je php.ini-bestand de puntkomma verwijdert van de volgende regels:
```
extension=php_pdo_sqlite.dll
extension=php_sqlite.dll
```
Navigeer naar de map van het gekloonde project.
Open een terminal en navigeer naar de public map van het project.
```
cd public
```
Voer het commando php -S localhost:8080 uit om de ingebouwde PHP-webserver te starten.
```
php -S localhost:8080
```

## Functionaliteit
Home ("/"): Toont alle kaarten in de database.

Login ("/login"): Pagina voor gebruikersaanmelding.

Registreren ("/register"): Pagina voor gebruikersregistratie.

Kaart Toevoegen ("/addcard"): Pagina om een kaart aan de database toe te voegen.

## Gebruikersinformatie

Gebruikers worden geregistreerd met de standaardrol 'user' en het abonnementstype 'free'.
Gebruikersnaam en wachtwoord voor de beheerder:
Gebruikersnaam: admin
Wachtwoord: test

Gebruik

Open een webbrowser en ga naar http://localhost:8080 om toegang te krijgen tot het programma.
Gebruik de bovenstaande beheerdersreferenties om in te loggen als beheerder.
Gebruik de functies van het programma om kaarten toe te voegen en te bekijken.
Gebruik de functies voor gebruikersbeheer om gebruikersaccounts te beheren.

## Technologieën Gebruikt

-PHP

-SQLITE

-HTML

-CSS

