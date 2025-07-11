# 📮 Projet 05 – Formulaire de support ticket (PHP)

## 🎯 Objectif
Permettre à un utilisateur de soumettre un ticket via un formulaire, avec :
- Enregistrement horodaté dans un fichier `.txt`
- Génération d’un ID unique
- Interface admin protégée pour afficher les tickets

## 💡 Fonctionnement

### 🧾 Formulaire public (index.php)
- Nom
- Email
- Message
- Génère un fichier `TICKET-ID_DATETIME.txt` dans `/tickets`

### 🔐 Interface admin (admin.php)
- Accès sécurisé avec mot de passe
- Lecture de tous les tickets enregistrés
