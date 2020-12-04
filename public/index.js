/* globals form, categorie */
"use strict";

selectCategorie(categorie);
formatDuree();

function alea() {
    form.duree.value = random(+form.duree.min, +form.duree.max);
    formatDuree();
    selectCategorie(categorieLetter(random(0, 2)));
}

function categorieLetter(choix) {
    switch (choix) {
    case 0:
        return "A";
    case 1:
        return "W";
    case 2:
    default:
        return "P";
    }
}

function formatDuree() {
    form.duree.style.background = `hsl(${210 - 3 * form.duree.value}, 90%, 60%)`;
}

function formatCategorie(categorie) {
    switch (categorie) {
    case 'A':
        form.categorie.style.background = "hsl(150, 70%, 60%)";
        break;
    case 'W':
        form.categorie.style.background = "hsl(210, 70%, 60%)";
        break;
    case 'P':
    default:
        form.categorie.style.background = "hsl(270, 70%, 60%)";
        break;
    }
}

function onReset() {
    form.duree.value = 1;
    formatDuree();
    selectCategorie('A');
}

function random(min, max) {
    return Math.trunc(Math.random() * (max - min + 1)) + min;
}

function selectCategorie(categorie) {
    $(`option[value="${categorie}"]`).selected = true;
    formatCategorie(categorie);
}

function $(selecteur) {
    return document.querySelector(selecteur);
}