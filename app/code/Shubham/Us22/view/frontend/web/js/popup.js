define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'text!Shubham_Us22/template/popup.html'
], function ($, model, template) {
    'use strict';

    return function (settings) {
        const content = settings.content,
              timeout = settings.timeout;
        const options = {
            type: 'popup',
            responsive: true,
            autoOpen: true,
            modalClass: 'shubham_popup',
            popupTpl: template,
        };
        setTimeout(function () {
            $('<div />').html(content).modal(options);
        }, timeout*1000);
    };
})