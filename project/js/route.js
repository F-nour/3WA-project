'use strict';

export default function Route(name, htmlName, defaultRoute) {
	try {
		if (!name || !htmlName) {
			throw 'error: name and htmlName params are mandatories';
		}
		this.constructor(name, htmlName, defaultRoute);
	} catch (e) {
		console.error(e);
	}
}

Route.prototype = {
	name: undefined,
	htmlName: undefined,
	default: undefined,
	posssibleRoutes: ['home', 'about'],
	constructor: function (name, htmlName, defaultRoute) {
		this.name = name;
		this.htmlName = htmlName;
		this.default = defaultRoute;
	},
	isAutorisated: function () {
		for (let i = 0, length = this.posssibleRoutes.length; i < length; i++) {
			const route = this.posssibleRoutes[i];
			if (route === this.name) {
				return true;
			}
		}
	},
	isActiveRoute: function (hashedPath) {
		return hashedPath.replace('#', '') === this.name;
	},
};
