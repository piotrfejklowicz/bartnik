const windowZoom = function () {
const html = document.documentElement;
const windowWidth = window.innerWidth;
let windowScale = 1;
html.classList.remove('mobile', 'tablet', 'desktop');
if (windowWidth >= 1760) {
// windowScale = '1.' + (window.innerWidth - 300);
windowScale = window.innerWidth / 1536; // 96rem = 1536px
} else if (windowWidth >= 1232 && windowWidth < 1760) {
// document.body.setAttribute('data-device', 'desktop');
html.classList.add('desktop');
windowScale = window.innerWidth / 1536; // 96rem = 1536px
} else if (windowWidth >= 1056 && windowWidth < 1232) {
// document.body.setAttribute('data-device', 'desktop');
html.classList.add('desktop');
windowScale = 0.802083; // 1232 0.802083
// windowScale = 0.802083 + window.innerWidth / (1536 * 1500);
// windowScale = window.innerWidth / 1536 / (window.innerWidth / 1536 * 1.2 );
} else if (windowWidth >= 880 && windowWidth < 1056) {
// document.body.setAttribute('data-device', 'tablet');
html.classList.add('tablet');
windowScale = window.innerWidth / 880; // 55rem = 880px
} else if (windowWidth >= 704 && windowWidth < 880) {
// document.body.setAttribute('data-device', 'tablet');
html.classList.add('tablet');
windowScale = window.innerWidth / 768; // 55rem = 880px
} else if (windowWidth >= 528 && windowWidth < 704) {
// document.body.setAttribute('data-device', 'mobile');
html.classList.add('mobile');
windowScale = window.innerWidth / 528; // 48rem = 768px
} else if (windowWidth >= 400 && windowWidth < 528) {
// document.body.setAttribute('data-device', 'mobile');
html.classList.add('mobile');
windowScale = window.innerWidth / 412; // 48rem = 768px
} else {
// document.body.setAttribute('data-device', 'mobile');
html.classList.add('mobile');
windowScale = window.innerWidth *1.05 / 412; // 25.75rem = 412px
}
// document.body.style.zoom = windowScale;
// console.log('Window width:', windowWidth, 'Scale:', windowScale);

if (windowWidth < 1760) {
windowScale = windowScale.toFixed(3);
}
document.body.style.setProperty('--zoom', windowScale);
}
window.addEventListener('resize', function () { windowZoom(); });
windowZoom();


/*

Variant	Media query
max-sm	@media (width < 40rem) { ... } 40 rem = 640px  --> 44rem = 704px
max-md	@media (width < 48rem) { ... } 48 rem = 768px  --> 66rem = 1056px
max-lg	@media (width < 64rem) { ... } 64 rem = 1024px --> 77rem = 1232px
max-xl	@media (width < 80rem) { ... } 80 rem = 1280px --> 88rem = 1408px
max-2xl	@media (width < 96rem) { ... } 96 rem = 1536px --> 110rem = 1760px

Variant	Media query
max-sm	@media (width < 40rem) { ... } 40 rem = 640px  -- 33rem = 528px
max-md	@media (width < 48rem) { ... } 48 rem = 768px  -- 66rem = 1056px
max-lg	@media (width < 64rem) { ... } 64 rem = 1024px -- 88rem = 1408px
max-xl	@media (width < 80rem) { ... } 80 rem = 1280px -- 110rem = 1760px
max-2xl	@media (width < 96rem) { ... } 96 rem = 1536px -- 132rem = 2112px

 */