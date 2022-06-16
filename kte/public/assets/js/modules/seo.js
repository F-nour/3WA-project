'use strict';

const url = window.location.href;

const basic = (title, description, keywords) => {
	document.title = `Kiff ton Écharpe - ${title}`;
	const metaDescripion = document.querySelector('meta[name="description"]');
	metaDescripion.setAttribute('content', description);
	const metaKeywords = document.querySelector('meta[name="keywords"]');
	metaKeywords.setAttribute('content', keywords);
};

const openGraph = (title, description, image) => {
	const metaTitle = document.querySelector('meta[property="og:title"]');
	metaTitle.setAttribute('content', title);
	const metaDescription = document.querySelector(
		'meta[property="og:description"]'
	);
	metaDescription.setAttribute('content', description);
	const metaImage = document.querySelector('meta[property="og:image"]');
	metaImage.setAttribute('content', image);
	const metaUrl = document.querySelector('meta[property="og:url"]');
	metaUrl.setAttribute('content', url);
};

const twitter = (title, description, image) => {
	const metaTitle = document.querySelector('meta[property="twitter:title"]');
	metaTitle.setAttribute('content', title);
	const metaDescription = document.querySelector(
		'meta[property="twitter:description"]'
	);
	metaDescription.setAttribute('content', description);
	const metaImage = document.querySelector('meta[property="twitter:image"]');
	metaImage.setAttribute('content', image);
	const metaUrl = document.querySelector('meta[property="twitter:url"]');
	metaUrl.setAttribute('content', url);
}; // end of twitter

const dublinCore = (title, description) => {
	const metaTitle = document.querySelector('meta[name="DC.title"]');
	metaTitle.setAttribute('content', title);
	const metaDescription = document.querySelector('meta[name="DC.description"]');
	metaDescription.setAttribute('content', description);
	const metaUrl = document.querySelector('meta[name="DC.identifier"]');
	metaUrl.setAttribute('content', url);
};

export function seo(title, description, keywords, image) {
	if (image !== '') {
		image = `${window.location.hostname}public/images/screenshots/${image}.jpg`;
	}
	basic(title, description, keywords);
	openGraph(title, description, image);
	twitter(title, description, image);
	dublinCore(title, description);
};