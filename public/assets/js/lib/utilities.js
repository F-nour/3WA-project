('use strict');

// style change

export const size = (element, width = '', height = '', padding = '') => {
	element.style.width = width;
	element.style.height = height;
	element.style.padding = padding;
};

export const visible = (element, visibility) => {
	element.style.visibility = visibility;
};

export const display = (element, display) => {
	element.style.display = display;
};

// events

export const clickEvent = (element, action) => {
	element.addEventListener('click', action);
};

export const keyEvent = (element, key1, key2 = '', action) => {
	element.addEventListener('keydown', (e) => {
		if (e.key === key1 || e.key === key2) {
			action();
		}
	});
};

// Add or remove elements or attributes

export const removeElement = (element) => {
	if (element) {
		element.parentNode.removeChild(element);
	}
};

export const createElement = (tagName, parentElement, className, id) => {
	const element = document.createElement(tagName);
	element.classList.add(className);
	element.id = id;
	parentElement.prepend(element);
	return element;
};

export const addElement = (tagName, parentElement, className, id) => {
	const parent = document.querySelector(parentElement);
	const element = document.createElement(tagName);
	element.classList.add(className);
	element.id = id;
	parent.appendChild(element);
	return element;
};

export const toggleClass = (element, className) => {
	element.classList.toggle(className);
};

export const addClass = (element, className) => {
	element.classList.add(className);
};

export const removeClass = (element, className) => {
	element.classList.remove(className);
};

export const screens = (screenSize, action) => {
	const screen = window.matchMedia(`${screenSize}px`);
	screen.addEventListener('change', action);
	return screen;
};
