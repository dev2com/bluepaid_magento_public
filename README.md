# bluepaid_magento_public

Accédez au contenu de votre site internet joomla via ftp.
	Positionnez le répertoire "Bluepaid" dans le dossier app>code>local
	Positionnez le fichier "Bluepaid_SinglePayment.php" dans app>etc>modules

Accédez à votre interface d'administration magento
Sélectionnez le menu "Système">"Configuration"
Sélectionnez l'onglet "Modes de paiement" sur la partie gauche de votre panel
Sélectionnez l'onglet "Bluepaid"
	Sélectionnez la valeur "Oui" pour "Activé"
	Indiquez dans le champ "Titre" l'option qui sera présentée à votre client pour régler via Bluepaid
	Indiquez dans le champ "Identifiant de compte d'encaissement" le login qui vous a été communiqué par Bluepaid (généralement sous la forme 12345XXX, contrairement à votre identifiant client sur 6 chiffres)
	Adresses IP autorisées : Ne modifiez pas les valeurs par défaut étant 193.33.47.34;193.33.47.35
	Url de la plateforme Bluepaid : Ne modifiez pas (par défaut https:www.bluepaid.com/in.php)
	Url de retour pour le client : Url de votre site au choix (vide par défaut, le client sera redirigé sur votre page d'accueil après transaction)
	Url de retour sans validation : Url pour rediriger le client lorsqu'il ne valide pas la page de paiement de bluepaid (par défaut : bluepaid/standard/cancel)
	Url de confirmation de transaction : Ne pas modifier, Url utilisée par Bluepaid pour mettre à jour vos commandes
	Registered order status : Status indiqué pour une commande dont le paiement a été validé par Bluepaid
	Refill cart on failure : Permet de reconstruire le panier du client après un paiement refusé.