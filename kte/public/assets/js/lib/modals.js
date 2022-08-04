import { CLASSNAME, ID, SCREENWIDTH, STYLES } from './constants.js'
import {
  cancel,
  clickEvent,
  createElement,
  keyEvent,
  size,
} from './utilities.js'

('use strict')

// modal
export const createShadow = (action) => {
  const container = document.body
  const shadow = createElement ('div', container, CLASSNAME.SHADOW, ID.SHADOW)
  container.style.overflow = STYLES.HIDDEN
  shadow.addEventListener ('click', action)
  size (shadow, '100vw', '100vh')
  return shadow
}

export const scrollable = (element, overflow) => {
  element.style.overflow = overflow
}

export const closeBtn = (
  parentElement,
  className,
  width,
  id,
  action,
) => {
  const closeBtn = document.createElement ('button')
  closeBtn.classList.add ('btn', 'btn-no-style', 'btn-close', className)
  closeBtn.id = id
  parentElement.prepend (closeBtn)
  closeBtn.tabIndex = 0
  closeBtn.style.width = `${width}px`
  closeBtn.innerHTML = `<span class="sr-only">Fermer</span>`
  document.body.removeAttribute ('style')
  parentElement.prepend (closeBtn)
  clickEvent (closeBtn, action)
  keyEvent (closeBtn, action)
  return closeBtn
}

export const modalFocus = (parentEl, firstEl) => {
  scrollable (document.body, STYLES.HIDDEN)
  const endMenu = document.createElement ('div')
  endMenu.tabIndex = 0
  parentEl.append (endMenu)
  endMenu.addEventListener ('focus', () => {
    endMenu.blur ()
    document.body.blur () // permet de supprimer le focus sur l'élément qui a le focus
    firstEl.focus ()
  })
  return endMenu
}

export const openModal = (element, action) => {
  createShadow (action) // création du shadow
  element.style.backgroundColor = 'initial'
  element.style.boxShadow = 'none'
  action
}

// modal events

export const closeItem = (action) => {
  cancel (action)
}
