import { SCREENWIDTH, CLASSNAME, STYLES, ID, DATA } from '../lib/constants.js';
import {
	size,
	visible,
	clickEvent,
	keyEvent,
	removeElement,
	createElement,
} from '../lib/utilities.js';
import { scrollable, closeBtn, modalFocus, createShadow } from './modals.js';

('use strict');

// constantes globales

const header = document.querySelector('#header');
const headerMenu = document.querySelector('#headerMenu');
const headerWidth = `300px`;

// export de fonctions

export function responsive() {
	screenResize();
	actualLinkMenu();
	menuIcon();
}

export const screenResize = () => {
	if (window.innerWidth <= SCREENWIDTH.LARGE) {
		visible(header, STYLES.HIDDEN);
		size(header, '0px');
		closeMenu();
	} else {
		removeElement(document.getElementById(ID.HAMBERGERMENU));
		removeElement(document.getElementById(ID.CLOSEMENU));
		visible(headerMenu, STYLES.VISIBLE);
		size(headerMenu, '100%');
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
	clickEvent(hambergerMenu, openMenu);
	keyEvent(hambergerMenu, 'Enter', openMenu);
	return hambergerMenu;
};

const closeMenuIcon = () => {
	const closeMenuIcon = closeBtn(
		headerMenu,
		`${CLASSNAME.CLOSEICON}`,
		`${headerWidth}`,
		ID.CLOSEMENU,
		closeMenu
	);
	return closeMenuIcon;
};

// création des actions d'event

const openMenu = () => {
	size(headerMenu, headerWidth);
	visible(headerMenu, STYLES.VISIBLE);
	createShadow(document.body, ID.SHADOW);
	closeMenuIcon();
	headerOnFocus();
	// createShadow(HTMLELEMENTS.CONTAINER, closeMenu);
};

const closeMenu = () => {
	const shadow = document.querySelector(`#${ID.SHADOW}`);
	const closeBtn = document.getElementById(ID.CLOSEMENU);
	header.classList.remove(CLASSNAME.ACTIVE);
	size(headerMenu, '0px');
	visible(headerMenu, STYLES.HIDDEN);
	removeElement(shadow);
	removeElement(closeBtn);
	scrollable(document.body, STYLES.AUTO);
};

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
