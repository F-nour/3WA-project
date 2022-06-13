import { SCREENWIDTH, CLASSNAME, STYLES, ID, DATA } from '../lib/constants.js';
import {
	size,
	visible,
	clickEvent,
	keyEvent,
	removeElement,
	createElement,
	cancel,
} from '../lib/utilities.js';
import {
	scrollable,
	closeBtn,
	modalFocus,
	createShadow,
	openModal,
} from './modals.js';

('use strict');

// constantes globales

const header = document.querySelector('#header');
const headerMenu = document.querySelector('#headerMenu');
const headerWidth = `300px`;

// export de fonctions

export const displayMenu = () => {
	actualLinkMenu();
	logoEvent();
};

export const displayResponsiveMenu = () => {
	if (window.innerWidth <= SCREENWIDTH.LARGE) {
		size(header, '0px');
		visible(header, STYLES.HIDDEN);
		menuIcon();
		closeMenu();
	} else {
		size(header, '');
		visible(header, STYLES.VISIBLE);
		visible(headerMenu, STYLES.VISIBLE);
		removeElement(document.getElementById(ID.HAMBERGERMENU));
		removeElement(document.getElementById(ID.CLOSEMENU));
	}
};

// création des icônes de menu

const menuIcon = () => {
	const hambergerMenu = createElement(
		'button',
		document.body,
		CLASSNAME.HAMBERGERMENU,
		ID.HAMBERGERMENU
	);
	hambergerMenu.innerHTML = `<span class="sr-only">Ouvrir le menu</span>`;
	clickEvent(hambergerMenu, openMenu);
	keyEvent(hambergerMenu, 'Enter', openMenu);
	return hambergerMenu;
};

const closeMenuIcon = () => {
	const hambergerMenu = document.getElementById(ID.HAMBERGERMENU);
	const closeMenuIcon = closeBtn(
		headerMenu,
		hambergerMenu,
		`${CLASSNAME.CLOSEICON}`,
		`${headerWidth}`,
		ID.CLOSEMENU,
		closeMenuAction
	);
	closeMenuIcon.innerHTML = `<span class="sr-only">Ouvrir le menu</span>`;
	return closeMenuIcon;
};

// création des actions d'event

const openMenu = () => {
	size(header, headerWidth);
	visible(header, STYLES.VISIBLE);
	visible(headerMenu, STYLES.VISIBLE);
	closeMenuIcon();
	const hambergerMenu = document.getElementById(ID.HAMBERGERMENU);
	openModal(hambergerMenu, closeMenuAction);
	hambergerMenu.removeEventListener('click', openMenu);
	headerOnFocus;
};

const closeMenu = () => {
	const shadow = document.querySelector(`#${ID.SHADOW}`);
	const closeBtn = document.getElementById(ID.CLOSEMENU);
	header.classList.remove(CLASSNAME.ACTIVE);
	size(header, '0px');
	visible(header, STYLES.HIDDEN);
	visible(headerMenu, STYLES.HIDDEN);
	removeElement(shadow);
	removeElement(closeBtn);
	scrollable(document.body, STYLES.AUTO);
};

const closeMenuAction = () => {
	closeMenu();
	const hambergerMenu = document.getElementById(ID.HAMBERGERMENU);
	hambergerMenu.removeAttribute('style');
	hambergerMenu.addEventListener('click', openMenu);
};

cancel(closeMenuAction);

// garder le focus sur le menu

const headerOnFocus = () => {
	const closeIcon = document.getElementById(ID.CLOSEMENU);
	modalFocus(header, closeIcon);
};

// Indique la page actuel (si elle est en interne)

const getActualClass = (menus, action = null) => {
	for (let i = 0; i < menus.length; i += 1) {
		const menu = menus[i];
		const link = menu.querySelector('a');
		menu.classList.remove(CLASSNAME.ACTUAL);
		if (link.href === window.location.href) {
			menu.classList.add(CLASSNAME.ACTUAL);
			action;
		}
	}
};

const actualLinkMenu = () => {
	const headerMenus = document.querySelectorAll('.header-menu__link');
	const footerMenu = document.querySelectorAll('.footer-menu__link');
	getActualClass(headerMenus, closeMenu());
	getActualClass(footerMenu);
};

const logoEvent = () => {
	const logo = document.querySelector('.logo');
	clickEvent(logo, function () {
		window.location.href = '/';
	});
	keyEvent(logo, 'Enter', function () {
		window.location.href = '/';
	});
};

cancel(closeMenuAction);
