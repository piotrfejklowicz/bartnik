//
//* Set Cookie function
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

//* Get Cookie function
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

//* Get parameter from URL
function getURLparam(param) {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    return urlParams.get(param);
}


const ddSlider = function (sliderContainer, items = "1", options = {}) {
    // fixedWidth = options.fixedWidth ?? true;
    let autoplay = options.autoplay ?? true;
    let autoplayTimeout = options.autoplayTimeout ?? 5000;
    let grabbing = options.grabbing ?? true;
    let responsive = options.responsive ?? true;
    let gapDesktop = options.gapDesktop ?? 14;
    let gapMobile = options.gapMobile ?? 10;
    let fixedHeight = options.fixedHeight ?? false;
    let itemSelector = options.itemSelector ?? '.slides--item';
    let gap;
    // console.log(sliderContainer, options, grabbing, options.grabbing)

    setTimeout(function () {
        const sliderPath = sliderContainer + " " + ".dd-slider";
        const container = document.querySelector(sliderContainer);
        const slider =
            document.querySelector(sliderPath) ||
            document.querySelector(sliderContainer + " .dd-slider-container");
        if (!slider) return;
        if (!items) slider.classList.add("flexible");
        const wrapper = slider.querySelector(".slides");
        const btnPrev = document.querySelector(sliderContainer + " .prev");
        const btnNext = document.querySelector(sliderContainer + " .next");
        const pages = container.querySelector(".slider-pages");
        let mouseOver = false;
        let pauseAutoplay = !!getCookie("slider-autoplay");
        let currentSlide = wrapper.firstElementChild;
        let currentSlideWidth;
        currentSlide.classList.add("active");
        if (pages) {
            pages.children[0].classList.add("active")
        }

        const itemsInSlider = slider.querySelectorAll('.slides > *');
        const allSliderPages = Math.ceil(itemsInSlider.length / items);

        let autoplayInterval;
        const autoplay = function () {
            if (autoplay && autoplayTimeout > 1000) {
                clearInterval(autoplayInterval);
                autoplayInterval = setInterval(function () {
                    if (!mouseOver && !pauseAutoplay && items) moveNext();
                }, autoplayTimeout);
            }
        };
        if (autoplay && autoplayTimeout > 1000) {
            autoplay();
        }

        const refreshHeight = function (e, currentSlide_new = null) {
            if (fixedHeight) {
                wrapper.style.height = 'auto';
                setTimeout(function() {
                    // console.log('fixedHeight', fixedHeight);
                    // console.log('currentSlide', currentSlide);
                    if (currentSlide_new) {
                        currentSlide = currentSlide_new;
                    }
                    // console.log('currentSlide_new', currentSlide_new);
                    if (currentSlide.offsetHeight) {
                        let fixedHeightContent = currentSlide.querySelector(fixedHeight);
                        if (!fixedHeightContent) {
                            fixedHeightContent = currentSlide;
                            // console.log('no fixedHeightContent');
                        }
                        const currentHeight = fixedHeightContent.offsetHeight;
                        const height = currentHeight + "px";
                        // console.log('height', height);
                        wrapper.style.height = height;
                    } else {
                        wrapper.style.height = null;
                    }
                }, 2);
            }
        }

        const movePrev = function (e) {
            const items_ = container.style.getPropertyValue("--sl-items");
            const itemsInSlider = slider.querySelector(".slides").childElementCount;
            const allSliderPages = Math.ceil(itemsInSlider / items_);
            const page = parseFloat(container.style.getPropertyValue("--slide"));

            currentSlide = slider.querySelector(`.slides > ${itemSelector}.active`) || slider.querySelector(`.slides > ${itemSelector}`);
            let currentSlide_new = currentSlide.previousElementSibling;
            if (currentSlide_new) {
                // step x2 if possible - start
                let stepWidth;
                let currentSlide_new2 = currentSlide_new.previousElementSibling;
                if (currentSlide_new2) {
                    stepWidth =
                        currentSlide_new.offsetWidth +
                        gap +
                        currentSlide_new2.offsetWidth;
                }
                if (currentSlide_new2 && stepWidth < wrapper.offsetWidth) {
                    currentSlide_new = currentSlide_new2;
                    if (slider && page > 0) {
                        container.style.setProperty("--slide", Math.max(0, page - 2));
                    }
                } else {
                    // only one
                    stepWidth = currentSlide_new.offsetWidth;
                    if (slider && page > 0) {
                        container.style.setProperty("--slide", Math.max(0, page - 1));
                    }
                }
                // step x2 if possible - end
            } else {
                currentSlide_new = currentSlide.parentElement.lastElementChild;
            }
            currentSlide.classList.remove("active");
            currentSlide_new.classList.add("active");
            currentSlide = currentSlide_new;

            if (items) {
                autoplay();
                if (slider && page > 0) {
                    container.style.setProperty("--slide", Math.max(0, page - 1));
                } else {
                    container.style.setProperty("--slide", allSliderPages - 1);
                }
            } else {
                const translateX =
                    parseFloat(wrapper.style.getPropertyValue("--translateX")) || 0;
                wrapper.style.setProperty(
                    "--translateX",
                    translateX + stepWidth + gap
                );
            }
            removePagesActiveClass();
            const pageLabel = container.style.getPropertyValue("--slide");
            if (pages) {
                pages.children[pageLabel].classList.add("active")
            }
            setTimeout(function() {
                refreshHeight(currentSlide_new);
            }, 2);

        };
        const moveNext = function (e) {
            // console.log('next',[ container.offsetTop, container.offsetHeight, window.scrollY],
            //     [container.offsetTop - container.offsetHeight, container.offsetTop + container.offsetHeight]
            // )
            // if (fixedHeight &&
            //     (container.offsetTop - container.offsetHeight > window.scrollY || container.offsetTop + container.offsetHeight < window.scrollY)
            // ) {
            //     return;
            // }
            // if (container.offsetTop - container.offsetHeight - window.innerHeight > window.scrollY) {
            //     console.log(container.classList, 'next13', container.offsetTop - container.offsetHeight, window.scrollY)
            // }
            // if ( container.offsetTop + container.offsetHeight + window.innerHeight < window.scrollY) {
            //     console.log(container.classList, 'next23', container.offsetTop + container.offsetHeight,  window.scrollY)
            // }

            const items_ = container.style.getPropertyValue("--sl-items");
            const itemsInSlider = slider.querySelector(".slides").childElementCount;
            const allSliderPages = Math.ceil(itemsInSlider / items_);
            const page = parseFloat(container.style.getPropertyValue("--slide"));

            currentSlide = slider.querySelector(`.slides > ${itemSelector}.active`) || slider.querySelector(`.slides > ${itemSelector}`);
            let currentSlide_new = currentSlide.nextElementSibling;
            // console.log('1', currentSlide_new)
            if (currentSlide_new) {
                // step x2 if possible - start
                let stepWidth;
                let currentSlide_new2 = currentSlide_new.nextElementSibling;
                if (currentSlide_new2) {
                    stepWidth =
                        currentSlide.offsetWidth + gap + currentSlide_new.offsetWidth;
                }
                if (currentSlide_new2 && stepWidth < wrapper.offsetWidth) {
                    currentSlide_new = currentSlide_new2;
                    if (slider && page < allSliderPages - 1) {
                        container.style.setProperty("--slide", page + 2);
                    }
                } else {
                    // only one
                    stepWidth = currentSlide.offsetWidth;
                    if (slider && page < allSliderPages - 1) {
                        container.style.setProperty("--slide", page + 1);
                    }
                }
                // step x2 if possible - end
            } else {
                currentSlide_new = currentSlide.parentElement.firstElementChild;
            }
            currentSlide.classList.remove("active");
            currentSlide_new.classList.add("active");
            currentSlide = currentSlide_new;

            if (items) {
                autoplay();
                if (slider && page < allSliderPages - 1) {
                    container.style.setProperty("--slide", page + 1);
                } else {
                    container.style.setProperty("--slide", 0);
                }
            } else {
                const translateX =
                    parseFloat(wrapper.style.getPropertyValue("--translateX")) || 0;
                wrapper.style.setProperty(
                    "--translateX",
                    (translateX * -1 + stepWidth + gap) * -1
                );
            }

            removePagesActiveClass();
            const pageLabel = container.style.getPropertyValue("--slide");
            if (pages) {
                pages.children[pageLabel].classList.add("active")
            }
            setTimeout(function() {
                refreshHeight(currentSlide_new);
            }, 2);
        };

        if (btnPrev) {
            btnPrev.addEventListener("click", movePrev);
        }
        if (btnNext) {
            btnNext.addEventListener("click", moveNext);
        }

        window.addEventListener("keydown", (e) => {
            if (e.key === "F9") {
                console.log("autoplay", pauseAutoplay);
                setCookie("slider-autoplay", pauseAutoplay);
                pauseAutoplay = !pauseAutoplay;
            // } else if (e.key === 'ArrowLeft') {
            //     movePrev();
            // } else if (e.key === 'ArrowRight') {
            //     moveNext();
            }
        });

        //* Defaults
        const setProperties = function () {
            slider.style.setProperty("--width", slider.clientWidth + "px");
            slider.style.setProperty("--height", slider.clientHeight + "px");
            let items_ = items;
            gap = gapDesktop;
            if (responsive) {
                if (window.innerWidth < 600) {
                    items_ = 1;
                    gap = gapMobile;
                } else if (window.innerWidth <= 869) {
                    if (items >= 5) {
                        items_ = 3;
                    } else if (items >= 3) {
                        items_ = 2;
                    } else if (items <= 2) {
                        items_ = 1;
                    }
                    gap = gapMobile;
                } else if (window.innerWidth <= 1239) {
                    if (items >= 6) {
                        items_ = 4;
                    } else if (items >= 4) {
                        items_ = 3;
                    } else if (items === "3") {
                        items_ = 2;
                    }
                } else if (window.innerWidth <= 1319) {
                    if (items >= 6) {
                        items_ = 5;
                    } else if (items >= 5) {
                        items_ = 4;
                    } else if (items === "4") {
                        items_ = 3;
                    }
                }
            } else {
                items_ = items;
            }
            container.style.setProperty("--sl-items", items_);
            if (gap) {
                wrapper.style.setProperty("--gap-def", gap + "px");
            }

            if (!items) {
                const currentSlide = parseInt(container.style.getPropertyValue("--slide")) || 0;
                const step0_width = wrapper.children[0].offsetLeft;
                const stepWidth = wrapper.children[currentSlide].offsetLeft - step0_width;
                wrapper.style.setProperty("--translateX", stepWidth * -1);
            }

        };
        container.style.setProperty("--slide", 0);
        setProperties();

        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                refreshHeight();
            }, 2);
            setTimeout(function() {
                refreshHeight();
            }, 20);
        });

        //on resize - debounce
        let resizeTimer;
        window.addEventListener("resize", function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                setProperties();
                refreshHeight();
            }, 100);
        });


        // On window resize
        window.addEventListener("resize", setProperties);

        //* slide touch / Grab move
        if (grabbing) {
            let startX = 0;
            let startTouch = false;
            slider.addEventListener("dragstart", (e) => e.preventDefault());
            wrapper.addEventListener("dragstart", (e) => e.preventDefault());
            wrapper.addEventListener("click", (e) => {
                startTouch ? e.preventDefault() : null;
            });
            slider.addEventListener("touchstart", touchStart);
            slider.addEventListener("touchend", touchEnd);
            slider.addEventListener("mousedown", touchStart);
            slider.addEventListener("mouseup", touchEnd);

            function touchStart(e) {
                startTouch = true;
                startX = e.type.includes("mouse")
                    ? e.clientX
                    : e.changedTouches[0].clientX;
            }

            function touchEnd(e) {
                const endX = e.type.includes("mouse")
                    ? e.clientX
                    : e.changedTouches[0].clientX;
                if (endX < startX - 20) {
                    moveNext();
                } else if (endX > startX + 20) {
                    movePrev();
                } else {
                    startTouch = false;
                }
            }
        }

        function removePagesActiveClass() {
            if (pages) {
                var childElements = pages.children;
                for (var i = 0; i < childElements.length; i++) {
                    var childElement = childElements[i];
                    childElement.classList.remove("active");
                }
                // const sliderASActivePage = slider.querySelector('.active');
                // if(sliderASActivePage) {
                //     sliderASActivePage.classList.remove('active');
                // }
            }
        }

        //* Pages
        if (pages) {
            pages.addEventListener("click", function(e) {
                if (e.target) {
                    const items = container.style.getPropertyValue("--sl-items");
                    // console.log(e.target)
                    removePagesActiveClass();
                    e.target.classList.add("active");
                    const slide = e.target.getAttribute("data-slide");
                    if (slide) {
                        autoplay();
                        container.style.setProperty("--slide", (slide - 1) / items);
                    }
                }
            });
        }

        slider.addEventListener("mouseenter", function (e) {
            mouseOver = true;
        });
        slider.addEventListener("mouseleave", function (e) {
            autoplay();
            mouseOver = false;
        });
    }, 3);
};
