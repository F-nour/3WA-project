'use strict';

import { actualLinkMenu, createLogo } from '../../assets/js/modules/menus.js';
import { addElement } from '../../assets/js/lib/utilities.js';

export const insertPhp = (url, root, id = null, className = null) => {
	fetch(`/src/Modules/${url}.php`, {
		method: 'GET',
	})
		.then((response) => response.text())
		.then((data) => {
			const newElement = addElement('div', root, id, className);
			newElement.innerHTML = data;
			setActionOnFetch(url, root);
		});
}; // End of getPhp()

export const insertPhpGetter = (url, getter, root) => {
	link = `/src/Modules/${url}.phtml?${getter}`;
	method = 'GET';
	const parent = addElement('div', 'getter-output', root);
	fetch(link)
		.then((response) => response.text())
		.then((data) => {
			parent.innerHTML = data;
			setActionOnFetch(url, root);
		});
}; // End of getPhpGetter()

const setActionOnFetch = (url, root) => {
	switch (url) {
		case '_navbar':
			actualLinkMenu();
			break;
		default:
			break;
	}
}; // End of getNavBar()
