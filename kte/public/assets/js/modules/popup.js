import { CLASSNAME, ID, STYLES } from '../lib/constants.js'
import {
  addClass,
  clickEvent,
  removeClass,
  removeElement,
} from '../lib/utilities.js'
import {
  closeBtn,
  closeItem,
  createShadow,
  modalFocus,
  scrollable,
} from './modals.js'

('use strict')

const root = document.getElementById (ID.CONTAINER)

const closePopupIcon = (popup) => {
  const closePopupIcon = closeBtn (popup, `${CLASSNAME.CLOSEICON}`, `4rem`,
    ID.CLOSEPOPUP, () => closeModal (popup))
  return closePopupIcon
}

const popupFocus = (popup) => {
  const iconClose = document.getElementById (ID.CLOSEPOPUP)
  modalFocus (popup, iconClose)
}

const openModal = (popup) => {
  closePopupIcon (popup)
  popupFocus (popup)
  addClass (popup, CLASSNAME.OPENED)
  createShadow (root, () => closeModal (popup))
}

export const closeModal = (popup) => {
  const iconClose = document.getElementById (ID.CLOSEPOPUP)
  const shadow = document.getElementById (ID.SHADOW)
  removeElement (shadow)
  removeElement (iconClose)
  removeClass (popup, CLASSNAME.OPENED)
  scrollable (document.body, STYLES.AUTO)
  closeItem (() => closeModal (popup))
}

export const eventPopup = (btn) => {
  for (let i = 0; i < btn.length; i++) {
    const openPopup = btn[i]
    openPopup.tabIndex = 0
    const popup = openPopup.nextElementSibling
    if (popup.classList.contains (CLASSNAME.OPENED)) {
      closeModal (popup)
    } else {
      clickEvent (openPopup, () => openModal (popup))
    }
  }
}
