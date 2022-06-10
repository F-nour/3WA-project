import { initDOM } from './compiler.js';
import { actualLinkMenu } from '/assets/js/modules/menus.js';

('use strict');

export default function Router(routes) {
	try {
		if (!routes) {
			throw 'error: routes param is mandatory';
		}
		this.constructor(routes);
		this.init();
	} catch (e) {
		console.error(e);
	}
}

Router.prototype = {
	routes: undefined,
	rootElem: undefined,
	constructor: function (routes) {
		this.routes = routes;
		this.rootElem = document.getElementById('main');
	},
	init: function () {
		const r = this.routes;
		(function (scope, r) {

			window.addEventListener('hashchange', function (e) {
				e.preventDefault();
				scope.hasChanged(scope, r);
			});
		})(this, r);
		this.hasChanged(this, r);
	},
	hasChanged: function (scope, r) {
		if (window.location.hash.length > 0) {
			for (let i = 0, length = r.length; i < length; i++) {
				const route = r[i];
				if (route.isActiveRoute(window.location.hash.substr(1))) {
					scope.goToRoute(route.htmlName);
				}
			}
		} else if (
			window.location.hash === '' ||
			window.location.hash.length === 0
		) {
			for (let i = 0, length = r.length; i < length; i++) {
				const route = r[i];
				if (route.default) {
					scope.goToRoute(route.htmlName);
				}
			}
		} else if (window.location.hash !== r.length >= 0) {
			for (let i = 0, length = r.length; i < length; i++) {
				const route = r[i];
				if (!route.isAutorisated()) {
					scope.goToRoute((route.htmlName = '404.html'));
				}
			}
		}
	},

	goToRoute: function (htmlName) {
		(function (scope) {
			const url = './public/Views/Templates/Pages/' + htmlName;
			fetch(url)
				.then(function (response) {
					return response.text();
				})
				.then(function (html) {
					document.body.scrollTop = 0;
					document.body.overflow = 'auto';
					scope.rootElem.innerHTML = html;
					initDOM(htmlName);
					actualLinkMenu();
				})
				.catch(function (error) {
					console.error(error);
				});
		})(this);
	},
};
