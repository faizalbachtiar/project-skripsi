// Sidebar

function openNav() {
    document.getElementById("leftsidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
    document.getElementById("leftsidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}

// Topbar

window.onscroll = function() {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("top-menu").style.top = "50";
    } else {
        document.getElementById("top-menu").style.top = "0";
    }
}

//fungsi untuk buat akun
function operatorCategory() {
    if (document.getElementById('radio1').checked) {
        document.getElementById('salesfield').style.display = 'block';
        document.getElementById('supplierfield').style.display = 'none';
    } else if (document.getElementById('radio2').checked) {
        document.getElementById('salesfield').style.display = 'none';
        document.getElementById('supplierfield').style.display = 'block';
    }
}