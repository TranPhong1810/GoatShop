/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
document.addEventListener("DOMContentLoaded", function () {
    var currentUrl = window.location.href;
    var menuItems = document.querySelectorAll('.sidebar-menu a');

    menuItems.forEach(function (item) {
        if (item.href === currentUrl) {
            item.classList.add('active');
            // Thêm class active cho thẻ li cha nếu có
            var parentLi = item.closest('li');
            if (parentLi) {
                parentLi.classList.add('active');
            }
            // Thêm class active cho dropdown nếu có
            var parentDropdown = item.closest('.dropdown');
            if (parentDropdown) {
                parentDropdown.classList.add('active');
            }
        }
    });
});
