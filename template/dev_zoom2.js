const windowZoom = function () {
    try {
        const windowWidth = window.innerWidth;
        let windowScale = 1;
        if (windowWidth > 1760 && windowWidth <= 2200) {
            windowScale = window.innerWidth / 1536; // 96rem = 1536px
            document.body.style.setProperty('--zoom', windowScale);
        } else {
            document.body.style.removeProperty('--zoom');
        }
    } catch (e) {
    }
}
window.addEventListener('resize', function () { windowZoom(); });
window.addEventListener('DOMContentLoaded', windowZoom);
windowZoom();
setTimeout(function() {
    windowZoom();
}, 10);
