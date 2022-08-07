import { CLASSNAME, ID, STYLES } from '../lib/constants.js'
import {
  addClass,
  cancel,
  clickEvent,
  keyEvent,
  removeClass,
  removeElement,
} from '../lib/utilities.js'
import {
  closeBtn,
  closeItem,
  createShadow,
  modalFocus,
  scrollable,
} from '../lib/modals.js'
import { closeMenuAction } from './menus.js'

('use strict')

const closePopupIcon = (popup) => {
  const popupHeader = popup.querySelector ('.popup-header')
  if (popup !== null) {
    closeBtn (
      popupHeader,
      CLASSNAME.CLOSEICON, popup.offsetWidth,
      popup.id + '-' + ID.CLOSEPOPUP, () => closeModal (popup),
    )
  }
}

const popupFocus = (popup) => {
  const iconClose = document.getElementById (ID.CLOSEPOPUP)
  modalFocus (popup, iconClose)
}

const openModal = (popup) => {
  const headerMenu = document.querySelector ('#headerMenu')
  closeMenuAction ()
  closePopupIcon (popup)
  popupFocus (popup)
  addClass (popup, CLASSNAME.OPENED)
  createShadow (() => closeModal (popup))
  closeConditional (popup)
}

const closeModal = (popup) => {
  const iconClose = document.getElementById (popup.id + '-' + ID.CLOSEPOPUP)
  const shadow = document.getElementById (ID.SHADOW)
  removeElement (shadow)
  removeElement (iconClose)
  removeClass (popup, CLASSNAME.OPENED)
  scrollable (document.body, STYLES.AUTO)
  closeItem (() => closeModal (popup))
}

const closeConditional = (popup) => {
  const cancelButton = popup.querySelector ('[name="cancel"]')
  if (cancelButton) {
    if (cancelButton.getAttribute ('data-target') !== null) {
      clickEvent (cancelButton, () => handlePopup (cancelButton))
      keyEvent (cancelButton, 'Enter', ' ', () => handlePopup (cancelButton))
      cancel (() => handlePopup (cancelButton))
    } else if (popup) {
      clickEvent (cancelButton, () => closeModal (popup))
      keyEvent (cancelButton, 'Enter', ' ', () => closeModal (popup))
      cancel (() => closeModal (popup))
    }
  } else if (popup && !cancelButton) {
    cancel (() => closeModal (popup))
  }
}

const handlePopup = (btn) => {
  btn.tabIndex = 0
  const popup = document.querySelector (btn.dataset.target)
  const divs = document.getElementsByTagName ('div')
  for (let i = 0; i < divs.length; i++) {
    const otherPopup = divs[i].classList.contains (CLASSNAME.OPENED)
    if (otherPopup) {
      const popupOpened = document.querySelector ('.popup.opened')
      closeModal (popupOpened)
    }
  }
  openModal (popup)
}

export const generatePopup = (elements) => {
  for (let i = 0; i <= elements.length; i++) {
    const element = elements[i]
    if (element) {
      clickEvent (element, () => handlePopup (element))
    }
  }
}