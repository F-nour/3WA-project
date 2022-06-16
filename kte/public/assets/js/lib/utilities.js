('use strict')

// style change

/**
 * @function size
 * @description Change the size of an element
 * @param element
 * @param width
 * @param height
 * @param padding
 */
export const size = (element, width = '', height = '', padding = '') => {
	element.style.width = width
  element.style.height = height
  element.style.padding = padding
}

/**
 * @function visible
 * @description Change the visibility of an element
 * @param element
 * @param visibility
 */
export const visible = (element, visibility) => {
  element.style.visibility = visibility
}

/**
 * @function display
 * @description Change the display of an element
 * @param element
 * @param display
 */
export const display = (element, display) => {
  element.style.display = display
}

// events

/**
 * @function clickEvent
 * @description Add a click event to an element
 * @param element
 * @param action
 */
export const clickEvent = (element, action) => {
  element.addEventListener ('click', action)
}

/**
 * @function keyEvent
 * @description Add a key event to an element
 * @param element
 * @param key1
 * @param key2
 * @param action
 */
export const keyEvent = (element, key1, key2 = '', action) => {
  element.addEventListener ('keydown', (e) => {
    if (e.key === key1 || e.key === key2) {
      action ()
    }
  })
}

/**
 * @function cancel
 * @description Add key event to cancel an event
 * @param action
 */
export const cancel = (action) => {
  addEventListener ('keydown', (e) => {
    if (e.key === 'Escape') {
      action ()
    }
  })
}

// Add or remove Elements

/**
 * @function removeELement
 * @description Remove an element from the DOM
 * @param element
 */
export const removeElement = (element) => {
  if (element) {
    element.parentNode.removeChild (element)
  }
}

/**
 * @function createElement
 * @description prepend an element in the DOM
 * @param tagName
 * @param parentElement
 * @param className
 * @param id
 * @returns {*}
 */
export const createElement = (tagName, parentElement, className, id) => {
  const element = document.createElement (tagName)
  element.classList.add (className)
  element.id = id
  parentElement.prepend (element)
  return element
}

/**
 * @function addElement
 * @description Append an element to the DOM
 * @param tagName
 * @param parentElement
 * @param className
 * @param id
 * @returns {*}
 */
export const addElement = (tagName, parentElement, className, id) => {
  const parent = document.querySelector (parentElement)
  const element = document.createElement (tagName)
  element.classList.add (className)
  element.id = id
  parent.appendChild (element)
  return element
}

/**
 * @function toggleClass
 * @description Toggle a class on an element
 * @param element
 * @param className
 */
export const toggleClass = (element, className) => {
  element.classList.toggle (className)
}

/**
 * @function addClass
 * @description Add a class to an element
 * @param element
 * @param className
 */
export const addClass = (element, className) => {
  element.classList.add (className)
}

/**
 * @function removeClass
 * @description Remove a class from an element
 * @param element
 * @param className
 */
export const removeClass = (element, className) => {
  element.classList.remove (className)
}