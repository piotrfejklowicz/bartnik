<style>
html {
    background-color: #fff;
<?php if (isset($_COOKIE['DEV']) && defined('DEV') && DEV) { ?>
    &::before {
        content: 'main xxl desktop d1k ~1536px';
        position: fixed;
        top: 2px;
        left: 2px;
        background-color: #fff;
        padding: 2px;
        color: #000;
        opacity: .6;
        font-size: 1rem;
        z-index: 999;
    }
    /* \/ desktop \/ */ /* 77 < 88 < [99] < 110 => [99] main */
    @media screen and (min-width: 154.01rem) { /* 154rem = 2464px */
        &::before {content: '154+ hd desktop d4k+ +1760px';}
    }
    @media screen and (min-width: 132.01rem) { /* 132rem = 2112px */
        &::before {content: '132+ hd desktop d3k+ +1760px';}
    }
    @media screen and (min-width: 110.01rem) { /* 110rem = 1760px */
        &::before {content: '110+ hd desktop d2k+ +1760px';}
    }
    @media screen and (max-width: 88rem) { /* 88rem = 1408px */
        &::before {content: '-88 xl desktop -1408px';}
    }
    @media screen and (max-width: 77rem) { /* 77rem = 1232px */
        &::before {content: '-77 lg desktop -1232px';}
    }
    /* /\ desktop /\ */
    /* \/ tablet \/ */ /* 44 < [55] < 66 => [55] main */
    @media screen and (max-width: 66rem) { /* 66rem = 1056px */
        &::before {content: '-66 md mobile tablet -1056px';}
    }
    @media screen and (max-width: 55rem) { /* 55rem = 880px */
        &::before {content: '-55 md mobile tablet -880px';}
    }
    /* /\ tablet /\ */
    /* \/ mobile \/ */ /* ... < [33] < 44 => [33] main */
    @media screen and (max-width: 44rem) { /* 44rem = 704px */
        &::before {content: '-44 sm mobile phone -704px';}
    }
    @media screen and (max-width: 33rem) { /* 33rem = 528px */
        &::before {content: '-33 sm mobile phone -528px';}
    }
    @media screen and (max-width: 24rem) { /* 24rem = 384px */
        &::before {content: '-24 sm mobile phone -384px';}
    }
    @media screen and (max-width: 23rem) { /* 23rem = 368px */
        &::before {content: '-23 sm mobile phone -368px';}
    }
    @media screen and (max-width: 22rem) { /* 22rem = 352px */
        &::before {content: '-22 sm mobile phone -352px';}
    }
    /* /\ mobile /\ */
<?php } ?>


    /*--rpx: 1px;*/
<?php if (!isset($_GET['scale2'])) { ?>
    --zoom: 1; /* Default zoom level */
    /* \/ desktop \/ */ /* 77 < 88 < [99] < 110 => [99] main */

    @media screen and (min-width: 110.01rem) { /* 110rem = 1760px */
        --zoom: 1.15;
    }
    /*@media screen and (min-width: 121.01rem) { !* 121rem = 1936px *!*/
    /*	--zoom: 1.2;*/
    /*}*/
    /*@media screen and (min-width: 132.01rem) { !* 132rem = 2112px *!*/
    /*	--zoom: 1.25;*/
    /*}*/
    /*@media screen and (min-width: 154.01rem) { !* 154rem = 2464px *!*/
    /*  --zoom: 1.5;*/
    /*}*/

    @media screen and (max-width: 88rem) { /* 88rem = 1408px */
        --zoom: 0.9;
        /*--rpx: 0.9px;*/
    }
    @media screen and (max-width: 77rem) { /* 77rem = 1232px */
        --zoom: 0.83;
        /*--rpx: 0.8px;*/
    }
    /* /\ desktop /\ */
    /* \/ tablet \/ */ /* 44 < [55] < 66 => [55] main */
    @media screen and (max-width: 66rem) { /* 66rem = 1056px */
        --zoom: 1.1;
    }
    @media screen and (max-width: 55rem) { /* 55rem = 880px */
        --zoom: 1;
    }
    /* /\ tablet /\ */
    /* \/ mobile \/ */ /* ... < [33] < 44 => [33] main */
    @media screen and (max-width: 44rem) { /* 44rem = 704px */
        --zoom: 1.25;
    }
    @media screen and (max-width: 33rem) { /* 33rem = 528px */
        --zoom: 1;
    }
    @media screen and (max-width: 24rem) { /* 24rem = 384px */
        --zoom: 0.95;
    }
    @media screen and (max-width: 23rem) { /* 23rem = 368px */
        --zoom: 0.9;
    }
    @media screen and (max-width: 22rem) { /* 22rem = 352px */
        --zoom: 0.8;
    }
    @media screen and (max-width: 21rem) { /* 21rem = 336px */
        --zoom: 0.75;
    }
    @media screen and (max-width: 20rem) { /* 20rem = 320px */
        --zoom: 0.7;
    }
    /* /\ mobile /\ */
<?php } else { ?>
    /*body {*/
    /*    zoom: var(--zoom, 1);*/
    /*    --scale: clamp(.5, var(--zoom), 1);*/
    /*}*/
    @media screen and (min-width: 77.01rem) and (max-width: 88rem) { /* 88rem = 1408px */
        /*--rpx: calc(100vw / 1536);*/
        p, li, *:not(p, li) > a {
            zoom: calc(1.5 - (var(--zoom) / 2));
        }
    }
<?php } ?>
}
body {
    zoom: var(--zoom, 1);
    --mscale: 1;
    --scale: calc(clamp(.5, var(--zoom), 1) * var(--mscale, 1));
}
main {
    overflow: clip;
}

@font-face {
	font-family: 'Chakra Petch';
	src: url('/fonts/chakrapetch-bold-webfont.woff2') format('woff2');
	font-weight: normal;
	font-style: normal;
}
@font-face {
	font-family: 'Poppins';
	src: url('/fonts/Poppins-Medium.woff2') format('woff2');
	font-weight: 500;
	font-style: normal;
	font-display: swap;
}
@font-face {
	font-family: 'Poppins';
	src: url('/fonts/Poppins-Regular.woff2') format('woff2');
	font-weight: normal;
	font-style: normal;
	font-display: swap;
}
@font-face {
	font-family: 'Poppins';
	src: url('/fonts/Poppins-SemiBold.woff2') format('woff2');
	font-weight: 600;
	font-style: normal;
	font-display: swap;
}
@font-face {
	font-family: 'Poppins';
	src: url('/fonts/Poppins-Bold.woff2') format('woff2');
	font-weight: 700;
	font-style: normal;
	font-display: swap;
}
@font-face {
	font-family: 'Poppins';
	src: url('/fonts/Poppins-Bold.woff2') format('woff2');
	font-weight: bold;
	font-style: normal;
	font-display: swap;
}
@font-face {
	font-family: 'Poppins';
	src: url('/fonts/Poppins-ExtraBold.woff2') format('woff2');
	font-weight: 800;
	font-style: normal;
	font-display: swap;
}

@font-face {
	font-family: 'Chakra';
	src: url('/fonts/chakrapetch-bold-webfont.woff2') format('woff2');
	font-weight: normal;
	font-style: normal;
}
</style>