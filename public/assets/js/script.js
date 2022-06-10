('use strict');
import { responsive, screenResize } from './modules/menus.js';

responsive();

addEventListener('resize', screenResize());
