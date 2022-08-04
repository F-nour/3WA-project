import { responsive } from './modules/responsive.js'
import { generateCollapse } from './modules/collapse.js'
import { initMenu } from './modules/menus.js'
import { timer } from './modules/timer.js'

initMenu()

responsive()

const uploadFile = (typeFile) => {
  const TypeFile = typeFile.charAt(0).toUpperCase() + typeFile.slice(1)

  return document.getElementById(`upload${TypeFile}Input`)
}

const userMenu = document.getElementById('userMenu')
const uploadPicture = uploadFile('picture')
if (uploadPicture !== null) {
  generateCollapse ([userMenu, uploadPicture])
} else {
  generateCollapse([userMenu])
}
timer()