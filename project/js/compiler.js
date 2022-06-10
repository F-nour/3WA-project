import Router from './router.js';
import Route from './route.js';
import initHome from '/assets/js/pages/home.js';
import initAbout from '/assets/js/pages/about.js';

('use strict');

export function init() {
	const home = new Router([new Route('home', 'homepage.phtml', true)]);
	const about = new Router([new Route('about', 'about.html')]);
	const product = new Router([new Route('products', '404.html')]);
	const legal = new Router([new Route('legal', 'legal.html')]);
}
export const initDOM = (htmlName) => {
	switch (htmlName) {
		case 'homepage.phtml':
			initHome();
			break;
		case 'about.html':
			initAbout();
			break;
		default:
			break;
	}
};
