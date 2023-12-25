$(document).ready(function () {
    "use strict";
    $(".flatpickr1").flatpickr();
    $(".flatpickr2").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
    $(".flatpickr3").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
    });
});
