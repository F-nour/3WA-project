import { CLASSNAME, ID, SCREENWIDTH, STYLES } from '../lib/constants.js'
import {
  cancel,
  clickEvent,
  createElement,
  keyEvent,
  removeElement,
  size,
  visible,
} from '../lib/utilities.js'
import { closeBtn, modalFocus, openModal, scrollable } from './modals.js'

('use strict')

// global variables

const header = document.querySelector ('#header')
const headerMenu = document.querySelector ('#headerMenu')
const headerWidth = `300px`

// export functions

/**
 * @function initMenu
 * @description initialize the menu
 * @callback actualLinkMenu
 * @callback logoEvent
 *
 */
export const initMenu = () => {
  actualLinkMenu ()
  logoEvent ()
}

/**
 * @function displayResponsiveMenu
 * @description display responsive menu
 *
 */
export const displayResponsiveMenu = () => {
  if (window.innerWidth <= SCREENWIDTH.LARGE) {
    size (header, '0px')
    visible (header, STYLES.HIDDEN)
    menuIcon ()
    closeMenu ()
    cancel (closeMenuAction)
  } else {
    size (header, '')
    visible (header, STYLES.VISIBLE)
    visible (headerMenu, STYLES.VISIBLE)
    removeElement (document.getElementById (ID.HAMBERGERMENU))
    removeElement (document.getElementById (ID.CLOSEMENU))
  }
}

// create icons for the menu

/**
 * @function menuIcon
 * @description create the hamberger menu icon
 */
const menuIcon = () => {
  const hambergerMenu = createElement (
    'button',
    document.body,
    CLASSNAME.HAMBERGERMENU,
    ID.HAMBERGERMENU,
  )
  hambergerMenu.innerHTML = `<span class="sr-only">Ouvrir le menu</span>`
  clickEvent (hambergerMenu, openMenu)
  keyEvent (hambergerMenu, 'Enter', openMenu)
  return hambergerMenu
}

/**
 * @function closeMenuIcon
 * @description create the close menu icon
 * @returns {*}
 */
const closeMenuIcon = () => {
  const hambergerMenu = document.getElementById (ID.HAMBERGERMENU)
  const closeMenuIcon = closeBtn (
    headerMenu,
    hambergerMenu,
    `${CLASSNAME.CLOSEICON}`,
    `${headerWidth}`,
    ID.CLOSEMENU,
    closeMenuAction,
  )
  closeMenuIcon.innerHTML = `<span class="sr-only">Ouvrir le menu</span>` // ajoute un texte à l'icône pour l'accessibilité
  return closeMenuIcon
}


// create events for the menu

/**
 * @function openMenu
 * @description open the menu
 */
const openMenu = () => {
  size (header, headerWidth)
  visible (header, STYLES.VISIBLE)
  visible (headerMenu, STYLES.VISIBLE)
  closeMenuIcon ()
  const hambergerMenu = document.getElementById (ID.HAMBERGERMENU)
  openModal (hambergerMenu, closeMenuAction)
  hambergerMenu.removeEventListener ('click', openMenu)
  headerOnFocus
}

/**
 * @function closeMenu
 * @description close the menu
 */
const closeMenu = () => {
  const shadow = document.querySelector (`#${ID.SHADOW}`)
  const closeBtn = document.getElementById (ID.CLOSEMENU)
  header.classList.remove (CLASSNAME.ACTIVE)
  size (header, '0px')
  visible (header, STYLES.HIDDEN)
  visible (headerMenu, STYLES.HIDDEN)
  removeElement (shadow)
  removeElement (closeBtn)
  scrollable (document.body, STYLES.AUTO)
}

/**
 * @function closeMenuAction
 * @description actions to do when the menu is closed
 */
const closeMenuAction = () => {
  closeMenu ()
  const hambergerMenu = document.getElementById (ID.HAMBERGERMENU)
  hambergerMenu.removeAttribute ('style')
  hambergerMenu.addEventListener ('click', openMenu)
}

/**
 * @function cance
 * @param closeMenuAction()
 * @description close the menu when the user keypresses escape
 */
cancel (closeMenuAction)

/**
 * @function headerOnFocus
 * @description focus on the header when the user clicks on the menu
 */
const headerOnFocus = () => {
  const closeIcon = document.getElementById (ID.CLOSEMENU)
  modalFocus (header, closeIcon)
}

/**
 * @function getActualClass
 * @description get the url and change the class of the element
 * @param menus
 * @param action
 */
const getActualClass = (menus, action = null) => {
  for (let i = 0; i < menus.length; i += 1) {
    const menu = menus[i]
    const link = menu.querySelector ('a')
    menu.classList.remove (CLASSNAME.ACTUAL)
    if (link.href === window.location.href) {
      menu.classList.add (CLASSNAME.ACTUAL)
      action
    }
  }
}

/**
 * @function ActualLinkMenu
 * @description get the url and change the class of the link in the menu
 */
const actualLinkMenu = () => {
  const headerMenus = document.querySelectorAll ('.header-menu__link')
  const footerMenu = document.querySelectorAll ('.footer-menu__link')
  getActualClass (headerMenus, closeMenu ())
  getActualClass (footerMenu)
}

/**
 * @function logoEvent
 * @description create the event for the logo
 */
const logoEvent = () => {
  const logo = document.querySelector ('.logo')
  clickEvent (logo, function () {
    window.location.href = '/kte/'
  })
  keyEvent (logo, 'Enter', function () {
    window.location.href = '/kte/'
  })
}
