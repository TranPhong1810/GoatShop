/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
/* sider detail user */
function showDetail(user) {
    document.getElementById('detailName').innerText = user.name;
    document.getElementById('detailPhone').innerText = user.phone;
    document.getElementById('detailEmail').innerText = user.email;
    document.getElementById('detailAddress').innerText = user.address;
    document.getElementById('detailStatus').innerText = user.status == 1 ? 'Hoạt động' : 'Không hoạt động';

    document.getElementById('userDetailSidebar').style.display = 'block';
}

function closeSidebar() {
    document.getElementById('userDetailSidebar').style.display = 'none';
}
