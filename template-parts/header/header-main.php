<?php
/**
 * Header main.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

?>

<div class="burger-menu-section">

    <div class="close-menu-burger"></div>

    <div class="logo__burger-menu">
        <?php get_template_part('template-parts/header/partials/element', 'logo'); ?>
    </div>


    <a href="https://nutribalance360.org/my-account/" data-open="#login-form-popup"
       class="mobile-nav-login-icon no-login">
        <img src="/wp-content/uploads/2023/10/user-b.svg" alt="">
    </a>

    <a href="https://nutribalance360.org/my-account/" class="mobile-nav-login-icon login">
        <img src="/wp-content/uploads/2023/10/user-b.svg" alt="">
    </a>


    <div class="valu">
        <?php echo do_shortcode('[woocs sd=1]'); ?>

        <?php echo do_shortcode('[fibosearch]'); ?>

    </div>

    <?php wp_nav_menu([
        'theme_location' => '',
        'menu' => 'Burger menu',
        'container' => 'div',
        'container_class' => '',
        'container_id' => '',
        'menu_class' => 'burger-menu',
        'menu_id' => '',
        'echo' => true,
        'fallback_cb' => 'wp_page_menu',
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',
        'depth' => 0,
        'walker' => '',
    ]); ?>

</div>

<div class="category-burger-menu-section">
    <?php echo do_shortcode('[fibosearch]'); ?>

    <span class="back-btn-menu">Back to menu</span>

    <div class="category-list-box">
        <?php
        $product_categories = get_terms('product_cat', array(
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'parent' => 0,
        ));

        // Перебираем родительские категории
        foreach ($product_categories as $category) {
            // Выводим название родительской категории в <h4> теге с ссылкой
            echo '<span class="category-link"><a href="' . get_term_link($category) . '">' . $category->name . '</a></span>';
        }
        ?>
    </div>
    <a href="/shop/"><span class="shop-btn">Go to shop</span></a>
</div>



<div id="masthead" class="header-main <?php header_inner_class('main'); ?>">
    <div class="header-inner flex-row container <?php flatsome_logo_position(); ?>" role="navigation">

        <div class="menuburger-btn"></div>

        <!-- Logo -->
        <div id="logo" class="flex-col logo">
            <?php get_template_part('template-parts/header/partials/element', 'logo'); ?>
        </div>

        <!-- Mobile Left Elements -->
        <div class="flex-col show-for-medium flex-left">
            <ul class="mobile-nav nav nav-left <?php flatsome_nav_classes('main-mobile'); ?>">
                <?php flatsome_header_elements('header_mobile_elements_left', 'mobile'); ?>
            </ul>
        </div>

        <!-- Left Elements -->
        <div class="flex-col hide-for-medium flex-left
            <?php if (get_theme_mod('logo_position', 'left') == 'left') echo 'flex-grow'; ?>">
            <ul class="header-nav header-nav-main nav nav-left <?php flatsome_nav_classes('main'); ?>">
                <?php flatsome_header_elements('header_elements_left'); ?>
            </ul>
        </div>

        <!-- Right Elements -->
        <div class="flex-col hide-for-medium flex-right">
            <ul class="header-nav header-nav-main nav nav-right <?php flatsome_nav_classes('main'); ?>">
                <?php flatsome_header_elements('header_elements_right'); ?>
            </ul>
        </div>

        <!-- Mobile Right Elements -->
        <div class="flex-col show-for-medium flex-right">
            <ul class="mobile-nav nav nav-right <?php flatsome_nav_classes('main-mobile'); ?>">
                <?php flatsome_header_elements('header_mobile_elements_right', 'mobile'); ?>
            </ul>
        </div>

    </div>
    <div class="container second-row">

        <?php /*wp_nav_menu( [
            'theme_location'  => '',
            'menu'            => 'Burger menu',
            'container'       => 'div',
            'container_class' => 'menu-second-row',
            'container_id'    => '',
            'menu_class'      => '',
            'menu_id'         => '',
            'echo'            => true,

            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<div id="%1$s" class="%2$s">%3$s</div>',
            'depth'           => 0,
            'walker'          => '',
        ] );*/?>

    </div>

    <?php if (get_theme_mod('header_divider', 1)) { ?>
        <div class="container">
            <div class="top-divider full-width"></div>
        </div>
    <?php } ?>
</div>


<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        // Дождемся загрузки DOM, чтобы убедиться, что все элементы доступны

        // Находим кнопку меню, элемент body, элемент #main и элемент .shop-link
        var menuBtn = document.querySelector('.menuburger-btn');
        var body = document.body;
        var main = document.querySelector('#main');
        var shopLink = document.querySelector('.shop-link');
        var backMenuBtn = document.querySelector('.back-btn-menu');
        var closeMenuBtn = document.querySelector('.close-menu-burger');


        // Проверяем, что кнопка меню, body, элемент #main и .shop-link существуют
        if (menuBtn && body && main && shopLink) {
            // Добавляем обработчик события клика на кнопку меню
            menuBtn.addEventListener('click', function () {
                // Переключаем класс у body
                body.classList.toggle('active-burger-menu');
            });

            // Добавляем обработчик события клика на элемент .shop-link
            shopLink.addEventListener('click', function () {
                // Переключаем класс у body
                body.classList.toggle('active-burger-menu-category');
            });

            backMenuBtn.addEventListener('click', function () {
                // Переключаем класс у body
                body.classList.remove('active-burger-menu-category');
            });

            closeMenuBtn.addEventListener('click', function () {
                // Переключаем класс у body
                body.classList.remove('active-burger-menu');
            });

            // Добавляем обработчик события клика на элемент #main
            main.addEventListener('click', function () {
                body.classList.remove('active-burger-menu');
                body.classList.remove('active-burger-menu-category');
            });
        }
    });


</script>