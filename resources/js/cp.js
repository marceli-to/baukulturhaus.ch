/**
 * When extending the control panel, be sure to uncomment the necessary code for your build process:
 * https://statamic.dev/extending/control-panel
 */

import ActionButton from './components/fieldtypes/ActionButton.vue';

Statamic.booting(() => {
    Statamic.$components.register('action_button-fieldtype', ActionButton);
});
