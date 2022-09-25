/*
 * Добро пожаловать в главный файл JavaScript вашего приложения!
 *
 * Мы рекомендуем включать встроенную версию этого файла JavaScript
 * (и его CSS-файл) в ваш базовый макет (base.html.twig).
 */

// любой CSS, который вы импортируете, будет выводиться в один css-файл (в этом случае app.css)
import './styles/app.css';
// import './styles/app.scss';
// Нужен jQuery? Установите его с помощью "yarn и jquery", а затем раскомментируйте его для импорта.
// загружает пакет jquery из node_modules
// import $ from 'jquery';

// импортирует функцию из greet.js (расширение .js необязательно)
// ./ (or ../) means to look for a local file
// import greet from './greet';

// $(document).ready(function () {
//   $('body').prepend('<h1>' + greet('jill') + '</h1>');
// });
// import 'bootstrap';
// import bsCustomFileInput from 'bs-custom-file-input';
//
// start the Stimulus application
import 'bootstrap';
// import './fontawesome.min';
// import 'font-awesome';
// import './bootstrap/js/bootstrap.min';
// const $ = require('jquery');
// это "модифицирует" модуль jquery: добавляя к нему поведение
// модуль bootstrap ничего не экспортирует/возвращает
// require('bootstrap');

// или вы можете включить конкретные части
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

// $(document).ready(function() {
//   $('[data-toggle="popover"]').popover();
// });

// bsCustomFileInput.init();
//
// var $ = require('./jquery');
// global.$ = global.jQuery = $;
// require('./bootstrap/js');
