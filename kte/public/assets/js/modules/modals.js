import { CLASSNAME, STYLES, ID } from '../lib/constants.js';
import {
	size,
	clickEvent,
	createElement,
	keyEvent,
	cancel,
} from '../lib/utilities.js';

('use strict');

// modal

export const createShadow = (action) => {
	const container = document.body;
	const shadow = createElement('div', container, CLASSNAME.SHADOW, ID.SHADOW);
	shadow.addEventListener('click', action);
	size(shadow, '100vw', '100vh');
	return shadow;
};

export const scrollable = (element, overflow) => {
	element.style.overflow = overflow;
};

export const closeBtn = (
	parentElement,
	header,
	className,
	width,
	id,
	action
) => {
	const closeBtn = createElement('button', parentElement, className, id);
	closeBtn.tabIndex = 0;
	closeBtn.style.width = width;
	closeBtn.innerHTML = `<span class="sr-only">Fermer</span>`;
	header.removeAttribute('style');
	parentElement.prepend(closeBtn);
	clickEvent(closeBtn, action);
	keyEvent(closeBtn, action);
	return closeBtn;
};

export const modalFocus = (parentEl, firstEl) => {
	scrollable(document.body, STYLES.HIDDEN);
	const endMenu = document.createElement('div');
	endMenu.tabIndex = 0;
	parentEl.append(endMenu);
	endMenu.addEventListener('focus', () => {
		endMenu.blur();
		document.body.blur(); // permet de supprimer le focus sur l'élément qui a le focus
		firstEl.focus();
	});
	return endMenu;
};

export const openModal = (element, action) => {
	createShadow(action); // création du shadow
	element.style.backgroundColor = 'initial';
	element.style.boxShadow = 'none';
	action;
};

// modal events

export const closeItem = (action) => {
	cancel(action);
};
