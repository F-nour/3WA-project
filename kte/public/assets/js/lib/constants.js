'use strict'

// Taille d'écran
export const SCREENWIDTH = {
  EXTRALARGE: 1440,
  LARGE: 1024,
  MEDIUM: 800,
  SMALL: 600,
  EXTRASMALL: 414,
}

// Liste des classes CSS
export const CLASSNAME = {
  ACTIVE: 'active',
  ACTUAL: 'actual',
  CLOSE: '...' + ['btn', 'btn-close', 'close-icon'],
  CLOSEICON: 'close-icon',
  COLLAPSTITLE: 'collaps__title',
  SUBTITLE: 'collaps__contentTitle',
  HAMBERGERMENU: 'hamberger-menu',
  HEADER: 'header',
  MAIN: 'main',
  OPEN: 'open',
  OPENPOPUP: 'openPopup',
  OPENED: 'opened',
  SHADOW: 'shadow',
  SRONLY: 'sr-only',
}

// Application de styles CSS
export const STYLES = {
  AUTO: 'auto',
  HIDDEN: 'hidden',
  VISIBLE: 'visible',
  NONE: 'none',
  FLEX: 'flex',
  SCROLLABLE: 'scrollable',
}

// Liste des ID des éléments HTML
export const ID = {
  CLOSEMENU: 'closeMenu',
  CLOSEPOPUP: 'closePopup',
  CONTAINER: 'container',
  FOOTER: 'footer',
  HAMBERGERMENU: 'hambergerMenu',
  HEADER: 'header',
  MAIN: 'main',
  ROOT: 'container',
  SHADOW: 'shadow',
}

// Intéraction avec des éléments HTML
export const DATA = {
  MENUS: 'data-menus',
}

// Accès aux éléments HTML
export const HTMLELEMENTS = {
  CONTAINER: document.getElementById (ID.CONTAINER),
  FOOTER: document.getElementById (ID.FOOTER),
  HEADER: document.getElementById (ID.HEADER),
  HAMBERGERMENU: document.getElementById (ID.HAMBERGERMENU),
  MAIN: document.getElementById (ID.MAIN),
  ROOT: document.body,
  SHADOW: document.querySelector (`#${ID.SHADOW}`),
}
