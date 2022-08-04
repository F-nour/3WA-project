import { CLASSNAME } from '../lib/constants.js'
import {
  cancel,
  clickEvent,
  keyEvent,
  size,
  visible,
} from '../lib/utilities.js'

('use strict')

const title = document.getElementsByClassName (CLASSNAME.ACTIVE)

const closeCollapse = () => {
  for (let i = 0; i < title.length; i++) {
    const parentDiv = title[i]
    const childDiv = parentDiv.nextElementSibling
    childDiv.removeAttribute ('style')
    parentDiv.classList.remove (CLASSNAME.ACTIVE)
  }
}

const closeAll = () => {
  const active = document.querySelector ('.active')
  if (active !== null) {
    closeCollapse ()
  }
}

const openCollapse = (el) => {
  const height = el.scrollHeight
  const container = document.querySelector ('.container')
  clickEvent (container, closeAll)
  closeCollapse (el.parentElement)
  cancel (() => closeCollapse (el.parentElement))
  size (el, '', `${height}px`, '')
  visible (el, 'visible')
}

const linkCollapse = (element) => {
  const parentDiv = element
  const childDiv = element.nextElementSibling
  if (childDiv !== null) {
    const height = childDiv.clientHeight
    if (height != '') {
      closeCollapse ()
    } else {
        openCollapse (childDiv)
      childDiv.scrollTop = childDiv.scrollHeight
      parentDiv.classList.add (CLASSNAME.ACTIVE)
    }
  }
}

const handleCollapse = (e) => {
  if (e.target.tagName === 'BUTTON') {
    const parentDiv = e.target
    if (parentDiv.dataset.toggle === 'collapse') {
      e.preventDefault ()
      linkCollapse (parentDiv)
    }
  }
}

export const generateCollapse = (elements) => {
  for (let i = 0; i <= elements.length; i++) {
    const element = elements[i]
    if (element) {
      clickEvent (parent, handleCollapse)
      keyEvent (parent, 'Enter', ' ', handleCollapse)
    }
  }
}
