<?php
header("Content-type: text/css; charset: UTF-8");

if(isset($_GET['color']))
{
  $color = '#'.htmlspecialchars($_GET['color']);
}
else {
  $color = "'" . htmlspecialchars($color) . "'";
}
?>

.main-btn.main-btn-2 {
    background-color: <?php echo htmlspecialchars($color); ?> !important;
    border-color: <?php echo htmlspecialchars($color); ?> !important;
}
.main-btn.main-btn-2:hover {
    color: <?php echo htmlspecialchars($color); ?>;
    background: transparent !important;
    border-color: <?php echo htmlspecialchars($color); ?>;
}

.navigation .navbar .navbar-btns .header-times i {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.navigation .navbar .navbar-nav .nav-item a:hover {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.navigation .navbar .navbar-nav .nav-item .sub-menu > li:hover > a {
    background-color: <?php echo htmlspecialchars($color); ?> !important;
}

.infos span i {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.links a:hover {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

ul.language-dropdown li a::before {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.main-btn:hover {
    background-color: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?> !important;
}

.fress-area .single-fress:hover a {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.fress-area .single-fress::before {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.section-title span {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.food-menu-area .tabs-btn ul li a.active p {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.food-menu-area .food-menu-items .single-menu-item .menu-price-btn span {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.menu-price-btn del {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.food-menu-area .food-menu-items .single-menu-item .menu-price-btn a::before {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.food-menu-area .food-menu-items .single-menu-item .menu-price-btn a::after {
    border: 1px solid <?php echo htmlspecialchars($color); ?> !important;
}

.client-area .client-items .single-client .client-info .item-1 span {
    color:<?php echo htmlspecialchars($color); ?> !important;
}
.client-area .client-items .single-client .text p::before {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.client-area .client-items .single-client .text p::after {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.client-area .client-items .single-client .client-info .item-2 ul li {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.blog-area .blog-content a .title:hover {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.blog-area .blog-content .blog-comments a::before {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.blog-area .blog-content .blog-comments a::before {
    background: <?php echo htmlspecialchars($color); ?>!important;
}
.blog-area .blog-content .blog-comments a::after {
    border: 1px solid <?php echo htmlspecialchars($color); ?>!important;
}
.reservation-area .reservation-item .book-table .input-box button {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.footer-area.footer-area-2 .footer-widget-1 .header-times i {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.go-top-area .go-top::before {
    background-color: <?php echo htmlspecialchars($color); ?> !important;
}
.go-top-btn::after {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.go-top-area .go-top {
    background-color: <?php echo htmlspecialchars($color); ?> !important;
}

.page-title-area .page-title-item nav ol li {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.food-menu-area.food-menu-3-area .tabs-btn .nav li a.active p {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.food-menu-area.food-menu-3-area .food-menu-items .single-menu-item .menu-price-btn a {
    color:<?php echo htmlspecialchars($color); ?> !important;
}

.food-menu-area.food-menu-3-area .food-menu-items .single-menu-item .menu-price-btn a::before {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.food-menu-area.food-menu-3-area .food-menu-items .single-menu-item .menu-price-btn a::after {
    border-color: <?php echo htmlspecialchars($color); ?> !important;
}

.shop-search i {
    color: <?php echo htmlspecialchars($color); ?> !important;
}

.shop-sidebar .shop-box .sidebar-title .title::before {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.shop-sidebar .shop-box .sidebar-title .title::after {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

li.active-search a {
    color: <?php echo htmlspecialchars($color); ?> !important;
}

.pricing-area .single-pricing span {
    color: <?php echo htmlspecialchars($color); ?> !important;
}

.pricing-area .single-pricing a.main-btn:hover {
    background: <?php echo htmlspecialchars($color); ?> !important;
    border-color: <?php echo htmlspecialchars($color); ?> !important;
}

.ui-slider-horizontal .ui-slider-range {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

button.filter-button {
    background-color: <?php echo htmlspecialchars($color); ?> !important;
}

.gallery-area .single-gallery .gallery-overlay a {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.blog-details-area .blog-sidebar .blog-box .blog-cat-list ul li a:hover {
    color: <?php echo htmlspecialchars($color); ?> !important;
}

.single-form button:hover {
    color: <?php echo htmlspecialchars($color); ?> !important;
}

.single-form button:hover::before {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

button:hover::after {
    border: 1px solid <?php echo htmlspecialchars($color); ?> !important;
}

.single-form button:hover::after {
    border: 1px solid <?php echo htmlspecialchars($color); ?> !important;
}

.menu-contents .menu-tabs .nav li a.active {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.shop-details-area .shop-content .shop-btns a {
    background: <?php echo htmlspecialchars($color); ?> !important;
    border-color:  <?php echo htmlspecialchars($color); ?> !important;
}
.cart-area .cart-table tbody .available-info .icon {
    background: <?php echo htmlspecialchars($color); ?> !important;
}
.cart-middle .update-cart button {
    border: 1px solid <?php echo htmlspecialchars($color); ?> !important;
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.cart-area .cart-table tbody tr td .remove span:hover {
    color: <?php echo htmlspecialchars($color); ?> !important;
}

.login-area .login-content .input-btn button {
    background: <?php echo htmlspecialchars($color); ?> !important;
    border-color: <?php echo htmlspecialchars($color); ?> !important;
}

.login-area .login-content .input-btn button:hover {
    color: <?php echo htmlspecialchars($color); ?> !important;
}

.login-area .login-content .input-btn a {
    color: <?php echo htmlspecialchars($color); ?> !important;
}

.user-dashbord .user-sidebar .links li a.active {
    color: <?php echo htmlspecialchars($color); ?> !important;
}

.user-dashbord .main-table .dataTables_wrapper td a.btn {
    border: 1px solid <?php echo htmlspecialchars($color); ?> !important;
}
.user-dashbord .main-table .dataTables_wrapper td a.btn:hover {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.user-dashbord .user-profile-details .order-details .progress-area-step .progress-steps li.active .icon {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.user-dashbord .view-order-page .order-info-area .prinit .btn {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.user-dashbord .user-sidebar .links li a:hover {
    color: <?php echo htmlspecialchars($color); ?> !important;
}
.user-dashbord .user-profile-details .edit-info-area .file-upload-area span {
    background: <?php echo htmlspecialchars($color); ?> !important;
}

.user-dashbord .user-profile-details .edit-info-area .btn {
    background: <?php echo htmlspecialchars($color); ?>!important ;
}

.placeorder-button .main-btn {
    border-color: <?php echo htmlspecialchars($color); ?> !important;
    background-color: <?php echo htmlspecialchars($color); ?>;
}

.placeorder-button .main-btn:hover,
.placeorder-button .main-btn:focus {
    color: <?php echo htmlspecialchars($color); ?> !important;
}

.revolve .round {

    background-color: <?php echo htmlspecialchars($color); ?>;
    border-top-color: <?php echo htmlspecialchars($color); ?>;
    border-right-color: <?php echo htmlspecialchars($color); ?>;
}

.banner-slide-3 .slick-arrow, .banner-slide-2 .slick-arrow, .banner-slide .slick-arrow {
    border: 2px solid <?php echo htmlspecialchars($color); ?>;
}
.banner-slide-3 .slick-arrow:hover, .banner-slide-2 .slick-arrow:hover, .banner-slide .slick-arrow:hover {
    background: <?php echo htmlspecialchars($color); ?>;
}
.experience-area .experience-contact {
    background: <?php echo htmlspecialchars($color); ?>;
}
.good-food-area .good-food-item a.title {
    color: <?php echo htmlspecialchars($color); ?>;
}
.good-food-area .good-food-item a {
    background: <?php echo htmlspecialchars($color); ?>;
}
.good-food-area .special-items .slick-arrow {
    color: <?php echo htmlspecialchars($color); ?>;
}
.footer-area .footer-widget-1 ul li a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.navigation .cart span {
    background-color: <?php echo htmlspecialchars($color); ?>;
}
.navigation .cart a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.links ul.social-links li a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.footer-area .footer-widget-2 ul li a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.footer-area .footer-widget-3 ul li a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.pagination-part nav .pagination li a:hover {
    background: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}
.page-link{
    color: <?php echo htmlspecialchars($color); ?>;
}
.page-item.active .page-link {
    border-color: <?php echo htmlspecialchars($color); ?>;
    background-color: <?php echo htmlspecialchars($color); ?>;
}
.menu-contents .menu-tabs .tab-content .tab-pane .shop-review-area .shop-review-form .input-box ul li a {
    color: <?php echo htmlspecialchars($color); ?>;
}
.menu-contents .menu-tabs .tab-content .tab-pane .shop-review-area .shop-review-form .input-btn button {
    background: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}
.menu-contents .menu-tabs .tab-content .tab-pane .shop-review-area .shop-review-form .input-btn button:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.main-btn.main-btn-2.proceed-checkout-btn:hover {
    color: <?php echo htmlspecialchars($color); ?>;
    border: 2px solid <?php echo htmlspecialchars($color); ?>;
}
.cart-middle .update-cart button:hover {
    color: <?php echo htmlspecialchars($color); ?>;
    background: transparent !important;
    border-color: <?php echo htmlspecialchars($color); ?>;
}
form.subscribe-form button {
    background-color: <?php echo htmlspecialchars($color); ?>;
}
h3.subscribe-title::before {
    background: <?php echo htmlspecialchars($color); ?>;
}
h3.subscribe-title::after {
    background: <?php echo htmlspecialchars($color); ?>;
}
.faq-section .accordion .card .card-header .btn:hover {
    background-color: <?php echo htmlspecialchars($color); ?>;
}
.faq-section .accordion .card .card-header .btn[aria-expanded="true"] {
    background-color: <?php echo htmlspecialchars($color); ?>;
}
.single-job a.title {
    color: <?php echo htmlspecialchars($color); ?>;
}

.single-job strong i {
    color: <?php echo htmlspecialchars($color); ?>;
}
.job-details h3 {
    color: <?php echo htmlspecialchars($color); ?>;
}
.category-lists ul li a::after {
    color: <?php echo htmlspecialchars($color); ?>;
}
.category-lists ul li a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.category-lists ul li.active a {
    color: <?php echo htmlspecialchars($color); ?>;
}
#variationModal .btn-primary {
    background-color: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}

#variationModal .form-check span {
    color: <?php echo htmlspecialchars($color); ?>;
}

#variationModal .modal-title small {
    color: <?php echo htmlspecialchars($color); ?>;
}
.modal-quantity span {
    color: <?php echo htmlspecialchars($color); ?>;
}
button.cookie-consent__agree {
    background-color: <?php echo htmlspecialchars($color); ?>;
}
.food-menu-area .food-menu-items .single-menu-item .menu-content a.title:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.food-menu-area.food-menu-2-area .food-menu-items .single-menu-item:hover {
    border: 1px solid <?php echo htmlspecialchars($color); ?>;
}
.shop-details-area .shop-item .shop-thumb .slick-arrow {
    background: <?php echo htmlspecialchars($color); ?>;
}
.shop-details-area .shop-item .shop-list .shop-thumb-active .slick-arrow {
    background: <?php echo htmlspecialchars($color); ?>;
}
.base-btn {
    background-color: <?php echo htmlspecialchars($color); ?>;
    border: 1px solid <?php echo htmlspecialchars($color); ?>;
}
.checkout-area .coupon:before {
    background: <?php echo htmlspecialchars($color); ?>;
}
.food-menu-area .button-group button.is-checked {
    background-color: <?php echo htmlspecialchars($color); ?> !important;
    color: #fff;
}
.food-menu-area .button-group button {
    color: <?php echo htmlspecialchars($color); ?>;
    border: 1px solid <?php echo htmlspecialchars($color); ?>;
    background-color: transparent !important;
}

#toast-container>div {
    background-color:<?php echo htmlspecialchars($color) ?> !important;
}

.form-check-input:checked {
    background-color: <?php echo htmlspecialchars($color) ?> !important;;
    border-color: <?php echo htmlspecialchars($color) ?> !important;
}

<!--- Theme Color--->
/* Theme Color CSS */

.theme-color-1 {
  --color-primary: <?php echo htmlspecialchars($color) ?> !important;
  --color-primary-rgb: 193, 159, 95 !important;
  <!-- --btn-color: var(--color-dark) !important; -->
}
.theme-color-bakery {
  --color-primary: <?php echo htmlspecialchars($color) ?> !important;
  --color-primary-rgb: 193, 159, 95 !important;
  <!-- --btn-color: var(--color-dark) !important; -->
}

.theme-color-2 {
  --color-primary: <?php echo htmlspecialchars($color) ?> !important;;
  --color-primary-rgb: 250, 185, 64;
  --btn-color: var(--color-dark);
  --font-heading: "Josefin Sans", sans-serif;
}

.theme-color-3 {
  --color-primary: <?php echo htmlspecialchars($color) ?> !important;;
  --color-primary-rgb: 69, 42, 28;
  --font-heading: "Playfair Display", serif;
}

.theme-color-4 {
  --color-primary: <?php echo htmlspecialchars($color) ?> !important;;
  --color-primary-rgb: 73, 154, 250;
  --font-heading: "Plus Jakarta Sans", sans-serif;
  --font-body: "Inter", sans-serif;
}

.theme-color-5 {
  --color-primary: <?php echo htmlspecialchars($color) ?> !important;
  --color-primary-rgb: 133, 195, 60;
  --font-heading: "Jost", sans-serif;
  --font-body: "Inter", sans-serif;
}
.theme-color-6 {
  --color-primary: <?php echo htmlspecialchars($color) ?> !important;
  --color-primary-rgb: 238, 119, 18;
  --font-heading: "Poppins", sans-serif;
  --font-body: "Roboto", sans-serif;
}
.popup_main-content h1 {

    color:  <?php echo htmlspecialchars($color) ?> !important;
}
<?php

function rgb($color = null){
    if(!$color){
        echo "";
    }
    $hex = htmlspecialchars($color);
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    echo "$r, $g, $b";
}
?>

:root {
    --color-primary: <?php echo htmlspecialchars($color) ?> !important;
    --color-primary-rgb: <?php  rgb(htmlspecialchars($color)) ?> !important;
}
