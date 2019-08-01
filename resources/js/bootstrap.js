
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('popper.js').default;
    window.noUiSlider = require('nouislider');

    require('bootstrap');
    require('bootstrap-select');
    require('jquery-validation');
    require('jquery-mask-plugin');
    window.$.debounce = require('lodash.debounce')
} catch (e) {
  console.log(e);
}
