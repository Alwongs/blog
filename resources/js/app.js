require('./bootstrap');
require('./menu');
require('./category-tree');
require('./auth-panel');
require('./todo');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
