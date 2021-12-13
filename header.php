<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php bloginfo('name') ?></title>
    <meta name="author" content="Timo Lehtonen">
    <meta name="description" content="description here">
    <meta name="keywords" content="Etiam vitae purus dignissim">
    <?php wp_head(); ?>
</head>

<body>
    <a href="#maincontent" class="skip anchor-button">Skip to main content</a>
    <div class="grid">
        <header>
            <div class="flex-container top-bar">
                <a class="logo anchor-button" href="<?php echo home_url(); ?>">
                    <img class="dark" src="img/logoipsum-logo-14.svg" alt="Link to home page."
                        height="232" width="232">
                    <img class="light" src="img/logoipsum-logo-14.svg" alt="Link to home page."
                        height="232" width="232">
                </a>
                <div class="settings">
                    <button aria-label="Format size" id="format_size">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px"
                            height="24px">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 4v3h5v12h3V7h5V4H9zm-6 8h3v7h3v-7h3V9H3v3z" />
                        </svg>
                    </button>
                    <button aria-label="Invert colors" id="invert_colors">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                            fill="black" width="24px" height="24px">
                            <g>
                                <path d="M0,0h24v24H0V0z" fill="none" />
                            </g>
                            <g>
                                <path
                                    d="M12,4.81L12,19c-3.31,0-6-2.63-6-5.87c0-1.56,0.62-3.03,1.75-4.14L12,4.81 M6.35,7.56L6.35,7.56C4.9,8.99,4,10.96,4,13.13 C4,17.48,7.58,21,12,21c4.42,0,8-3.52,8-7.87c0-2.17-0.9-4.14-2.35-5.57l0,0L12,2L6.35,7.56z" />
                            </g>
                        </svg>
                    </button>
                </div>
            </div>
            <h1>Quisque sit amet auctor leo, quis dapibus libero.</h1>
        </header>