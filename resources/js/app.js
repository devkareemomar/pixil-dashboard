// import './bootstrap';

import Alpine from 'alpinejs';
import Tagify from '@yaireo/tagify'
import '@yaireo/tagify/dist/tagify.css'
import $ from 'jquery'
import { createApp } from 'vue/dist/vue.esm-bundler';
import PageBuilder from './components/PageBuilder.vue';

window.Alpine = Alpine;
Alpine.start();


createApp({})
    .component('PageBuilder', PageBuilder)
    .mount('#app')

class TagsManager {
    init() {
        $(document).find('.tags').each(function (index, element) {

            let tagify = new Tagify(element, {
                keepInvalidTags: $(element).data('keep-invalid-tags') !== undefined ? $(element).data('keep-invalid-tags') : true,
                enforceWhitelist: $(element).data('enforce-whitelist') !== undefined ? $(element).data('enforce-whitelist') : false,
                delimiters: $(element).data('delimiters') !== undefined ? $(element).data('delimiters') : ',',
                whitelist: element.value.trim().split(/\s*,\s*/),
            });

            if ($(element).data('url')) {
                tagify.on('input', e => {
                    tagify.settings.whitelist.length = 0; // reset current whitelist
                    tagify.loading(true).dropdown.hide.call(tagify) // show the loader animation

                    $.ajax({
                        type: 'GET',
                        url: $(element).data('url'),
                        success: data => {
                            tagify.settings.whitelist = data;

                            // render the suggestions dropdown.
                            tagify.loading(false).dropdown.show.call(tagify, e.detail.value);
                        },
                    });
                });
            }
        });
    }
}

$(document).ready(() => {
    (new TagsManager()).init();
})

class suggested_valuesManager {
    init() {
        $(document).find('.suggested_values').each(function (index, element) {
            let tagify = new Tagify(element, {
                keepInvalidTags: $(element).data('keep-invalid-tags') !== undefined ? $(element).data('keep-invalid-tags') : true,
                enforceWhitelist: $(element).data('enforce-whitelist') !== undefined ? $(element).data('enforce-whitelist') : false,
                delimiters: $(element).data('delimiters') !== undefined ? $(element).data('delimiters') : ',',
                whitelist: element.value.trim().split(/\s*,\s*/),
            });

            if ($(element).data('url')) {
                tagify.on('input', e => {
                    tagify.settings.whitelist.length = 0; // reset current whitelist
                    tagify.loading(true).dropdown.hide.call(tagify) // show the loader animation

                    $.ajax({
                        type: 'GET',
                        url: $(element).data('url'),
                        success: data => {
                            tagify.settings.whitelist = data;

                            // render the suggestions dropdown.
                            tagify.loading(false).dropdown.show.call(tagify, e.detail.value);
                        },
                    });
                });
            }
        });
    }
}

$(document).ready(() => {
    (new suggested_valuesManager()).init();
    window.Tagify = Tagify;
    new Tagify(document.getElementById('suggested_values'))

})

// make Tagify available globally
window.Tagify = Tagify;