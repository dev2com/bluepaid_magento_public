# bluepaid_magento_public

Acc�dez au contenu de votre site internet joomla via ftp.
	Positionnez le r�pertoire "Bluepaid" dans le dossier app>code>local
	Positionnez le fichier "Bluepaid_SinglePayment.php" dans app>etc>modules

Acc�dez � votre interface d'administration magento
S�lectionnez le menu "Syst�me">"Configuration"
S�lectionnez l'onglet "Modes de paiement" sur la partie gauche de votre panel
S�lectionnez l'onglet "Bluepaid"
	S�lectionnez la valeur "Oui" pour "Activ�"
	Indiquez dans le champ "Titre" l'option qui sera pr�sent�e � votre client pour r�gler via Bluepaid
	Indiquez dans le champ "Identifiant de compte d'encaissement" le login qui vous a �t� communiqu� par Bluepaid (g�n�ralement sous la forme 12345XXX, contrairement � votre identifiant client sur 6 chiffres)
	Adresses IP autoris�es : Ne modifiez pas les valeurs par d�faut �tant 193.33.47.34;193.33.47.35
	Url de la plateforme Bluepaid : Ne modifiez pas (par d�faut https:www.bluepaid.com/in.php)
	Url de retour pour le client : Url de votre site au choix (vide par d�faut, le client sera redirig� sur votre page d'accueil apr�s transaction)
	Url de retour sans validation : Url pour rediriger le client lorsqu'il ne valide pas la page de paiement de bluepaid (par d�faut : bluepaid/standard/cancel)
	Url de confirmation de transaction : Ne pas modifier, Url utilis�e par Bluepaid pour mettre � jour vos commandes
	Registered order status : Status indiqu� pour une commande dont le paiement a �t� valid� par Bluepaid
	Refill cart on failure : Permet de reconstruire le panier du client apr�s un paiement refus�.