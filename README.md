# Entretien d'embauche piégé - Application interactive

<p align="center">
  <img src="/img/heig-vd-logo.gif" alt="Logo HEIG-VD" width="300"/>
</p>

## Présentation

Une application interactive de narration où vous passez un entretien d'embauche avec des choix qui influencent le résultat.

Cette application a été réalisée dans le cadre des cours de Web & mobile UI (WebMobUI) et Développement de produit média (DévProdMéd) dispensés par la HEIG-VD dans le bachelor d'Ingénierie des Médias.

## Aperçu

Cette application se compose de:

- Un backend Laravel V12.10.2 fournissant une API RESTful
- Un frontend Vue.js V3.5.13 pour l'interface utilisateur
- Système de progression sauvegardée
- Authentification des utilisateurs
- Navigation dynamique entre les chapitres

## Fonctionnalités

- 5 chapitres interactifs + 3 fins différentes (accepté, refusé, blacklisté)
- API RESTful versionnée (/api/v1)
- Authentification sécurisée avec Laravel Sanctum
- Sauvegarde automatique de la progression
- Interface utilisateur responsive

## Structure de l'histoire

L'histoire est composée de 5 chapitres:

1. Invitation à l'entretien
2. Début de l'entretien
3. Question morale 1
4. Question morale 2
5. Résultat (3 fins possibles)

## Documentation technique

Vous pouvez consulter la [documentation technique](./technical/technical.md) de ce projet.