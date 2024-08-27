<?php

/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2024 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_Tathastu
 */

namespace Tech9logy\Tathastu\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Cms\Model\BlockFactory;

class AllBlocks implements DataPatchInterface
{
    /**
     * @var BlockFactory
     */
    private $blockFactory;

    public function __construct(BlockFactory $blockFactory)
    {
        $this->blockFactory = $blockFactory;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $cmsBlocks = [
            [
                'title' => 'Top Header Icons',
                'identifier' => 'top_header_Icons',
                'content' => '<div class="top-header primary-bg-color">
                <div class="container">
                    <div class="tathastu-row">
                        <ul class="tathastu-row tathastu-col-right header-social">
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-square-instagram"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                            <li><a href="#"><span>Email</span> info@tech9logy.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Logo Image',
                'identifier' => 'home_page_logo_image',
                'content' => '<div class="tathastu-third-col">
                <div class="co-logo">
                    <a href="<?= $this->getBaseUrl(); ?>">
                        <img src="" class="desktop-logo">
                        <img src="" class="mobile-logo tathastu-none" >
                    </a>
                </div>
            </div>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 1,
            ],
            [
                'title' => 'Home Page Logo For Mobile',
                'identifier' => 'home_page_mobile_logo',
                'content' => '<li class="mobile-first-header">
                <img src="" class="desktop-logo">
                <div class="mobile-menu-head-close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            </li>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Notification Message Block',
                'identifier' => 'homepage_notification_message',
                'content' => '<div class="moving-text">
                <marquee>
                    <p>Welcome to Tech9logy Theme</p>
                </marquee>
            </div>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Banner Slider',
                'identifier' => 'banner_slider',
                'content' => '
                <div class="banner-slider">
                    <div class="owl-carousel">
                        <div><img src="{{media url=wysiwyg/hs-thu-gen-yes-blackfridayweekin-231123.jpg}}" alt="" /></div>
                        <div><img src="{{media url=wysiwyg/hs-thu-gen-yes-gurpurabessentials-231123.jpg}}" alt="" /></div>
                        <div><img src="{{media url=wysiwyg/hs-thu-gen-yes-theweddingtrunk-231123.jpg}}" alt="" /></div>
                        <div><img src="{{media url=wysiwyg/Damo-Theme-Home-Page-Banner-Design-1.jpg}}" alt="" /></div>
                        <div><img src="{{media url=wysiwyg/Damo-Theme-Home-Page-Banner-Design-2_1.jpg}}" alt="" /></div>
                        <!-- Add more banner slides as needed -->
                    </div>
   			    </div>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page USP Section',
                'identifier' => 'usp_section',
                'content' => '
                <div class="ups-home">
                    <div class="tathastu-row">
                        <div class="tathastu-third-col primary-bg-color default-radius">
                            <p><strong>1500+</strong> New Products Added Weekly</p>
                        </div>
                        <div class="tathastu-third-col primary-bg-color default-radius">
                            <p>Top Trending Styles</p>
                        </div>
                        <div class="tathastu-third-col primary-bg-color default-radius">
                            <p>View Your <strong>Personalized Favorites</strong></p>
                        </div>
                    </div>
                 </div>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Top Category Block',
                'identifier' => 'Home_page_topcategory',
                'content' => '
                <div class="shop-role">
                <div class="category-top-heading"><h2 class="common-heading">Shop By Role</h2></div>
                <div class="category-product  tathastu-row  tathastu-col-gap ">	
                            <div class="tathastu-fourth-col">
                <a href="/men-dress.html">
                                <div class="product-box default-radius">
                                    <div class="ct-product-fig">
                                        <img src="{{media url=wysiwyg/11.jpg}}" alt="" />
                                    </div>
                                    <div class="title-product">
                                        <h3 class="common-heading-bright common-heading-bright">Women</h3>
                                    </div>
                                </div>
                </a>
                            </div>
                            <div class="tathastu-fourth-col">
                <a href="/testing.html">
                                <div class="product-box default-radius">
                                    <div class="ct-product-fig">
                                        <img src="{{media url=wysiwyg/12.jpg}}" alt="" />
                                    </div>
                                    <div class="title-product">
                                        <h3 class="common-heading-bright common-heading-bright">Men</h3>
                                    </div>
                                </div>
                </a>
                            </div>
                            <div class="tathastu-fourth-col">
                <a href="/accessories.html">
                                <div class="product-box default-radius">
                                    <div class="ct-product-fig">
                                        <img src="{{media url=wysiwyg/14.jpg}}" alt="" />
                                    </div>
                                    <div class="title-product">
                                        <h3 class="common-heading-bright common-heading-bright">Accessories</h3>
                                    </div>
                                </div>
                </a>
                            </div>
                            <div class="tathastu-fourth-col">
                <a href="/nokia.html">
                                <div class="product-box default-radius">
                                    <div class="ct-product-fig">
                                        <img src="{{media url=wysiwyg/13.jpg}}" alt="" />
                                    </div>
                                    <div class="title-product">
                                        <h3 class="common-heading-bright">Indo Western</h3>
                                    </div>
                                </div>
                </a>
                            </div>
                        </div>
                        </div>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Occassion',
                'identifier' => 'home_page_occassion',
                'content' => '<div class="tathastu-row occasion-box">
                <div class="tathastu-half-col">
                    <div class="occasion-left">
                        <a href="#">
                            <div class="occasion-figure">
                                <img src="{{media url=wysiwyg/occasion-banner-left.jpg}}" alt="" />
                            </div>
                            <div class="occasion-text">
                                <h4>Diwali Attractions</h4>
                                <span>Shop Now</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="tathastu-half-col">
                    <div class="occassion-right">
                        <div class="occassion-list">
                            <a href="#">
                            <div class="occasion-figure">
                                <img src="{{media url=wysiwyg/occassion-right-bottom.jpg}}" alt="" />
                            </div>
                            <div class="occasion-text">
                                <h4>Diwali Attractions</h4>
                                <span>Shop Now</span>
                            </div>
                        </a>
                            
                        </div>
                        <div class="occassion-list">
                            <a href="#">
                            <div class="occasion-figure">
                                <img src="{{media url=wysiwyg/occassion-right-top.jpg}}" alt="" />
                            </div>
                            <div class="occasion-text">
                                <h4>Diwali Attractions</h4>
                                <span>Shop Now</span>
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class=shopping-banner><a href="#"><img src="{{media url=wysiwyg/single-banner-shop.jpg}}" alt="" /></a></div>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Single Banner',
                'identifier' => 'single_banner',
                'content' => '<div class="banner-add">
                                <img src="{{media url=wysiwyg/single-banner-shop.jpg}}" alt="" />
                            </div>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Featured Products',
                'identifier' => 'featured_products',
                'content' => '<div class="category-product tathastu-row">
                <div class="tathastu-fourth-col">
            <a href="#">
                    <div class="offerbox-product">
                        <div class="product-box ">
                            <img src="{{media url=wysiwyg/M1.jpg}}" alt="" />
                                
                        </div>
                        <div class="product-card-detail">
                            <h6>Admirable in Pink</h6>
                            <p class="price"><span class="new-price">₹  1750.00</span></p>
                        </div>
                    </div>
                  </a>
                </div>
                <div class="tathastu-fourth-col">
            <a href="#">
                    <div class="offerbox-product">
                        <div class="product-box ">
                            <img src="{{media url=wysiwyg/M4.jpg}}" alt="" />
                                
                        </div>
                        <div class="product-card-detail">
                            <h6>Admirable in Pink</h6>
                            <p class="price"><span class="new-price">₹  1750.00</span></p>
                        </div>
                    </div>
                  </a>
                </div>
                <div class="tathastu-fourth-col">
            <a href="#">
                    <div class="offerbox-product">
                        <div class="product-box ">
                            <img src="{{media url=wysiwyg/M3.jpg}}" alt="" />
                                
                        </div>
                        <div class="product-card-detail">
                            <h6>Admirable in Pink</h6>
                            <p class="price"><span class="new-price">₹  1750.00</span></p>
                        </div>
                    </div>
                  </a>
                </div>
            <div class="tathastu-fourth-col">
            <a href="#">
                    <div class="offerbox-product">
                        <div class="product-box ">
                            <img src="{{media url=wysiwyg/M4.jpg}}" alt="" />
                                
                        </div>
                        <div class="product-card-detail">
                            <h6>Admirable in Pink</h6>
                            <p class="price"><span class="new-price">₹  1750.00</span></p>
                        </div>
                    </div>
                  </a>
                </div>
            </div>
            ',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Footer',
                'identifier' => 'hfooter_block',
                'content' => '<footer>
                <div class="container">
                            <div class="footer-row tathastu-row tathastu-col-gap ">
                                <div class="tathastu-fourth-col">
                                    <div class="footer-logo">
                                        <a href="#"><img src=""></a>
                                    </div>
                                    
                                    <div class="footer-links-box">
                                    <ul class="tathastu-row header-social ft-social">
                                        <li><a href="https://www.facebook.com/Tech9logyCreators"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/t9lcreators"><i class="fa-brands fa-twitter"></i></a></li>
                                        <li><a href="https://www.youtube.com/channel/UC604KkQAltLuubFjkJ8moog?view_as=subscriber"><i class="fa-brands fa-youtube"></i></a></li>
                                        <li><a href="https://www.linkedin.com/company/tech9logy-creators"><i class="fa-brands fa-square-instagram"></i></a></li>
                                        <li><a href="https://in.pinterest.com/tech9logy/"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                        <li><a href=""><span>Email</span> info@tech9logy.com</a></li>
                                    </ul>
                                    </div>
                                </div>
                                <div class="tathastu-fourth-col">
                                    <div class="footer-links-box">
                                        <h6 class="common-heading">Quick Links</h6>
                                        <ul class="ft-link">
                                            <li><a href="/about-us">About Us</a></li>
                                            <li><a href="contact-us">Contact Us</a></li>
                                            <li><a href="/our-businesses">Our Businesses</a></li>
                                            <li><a href="/career">Career</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tathastu-fourth-col">
                                    <div class="footer-links-box">
                                        <h6 class="common-heading">Categories</h6>
                                        <ul class="ft-link">
                                            <li><a href="/mens">Mens</a></li>
                                            <li><a href="/boys">Saree</a></li>
                                            <li><a href="/category">Indo Western</a></li>
                                            <li><a href="/category 4">Plus</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tathastu-fourth-col">
                                    <div class="footer-links-box">
                                        <h6 class="common-heading">My Account</h6>
                                        <ul class="ft-link">
                                            <li><a href="/cart">Cart</a></li>
                                            <li><a href="/shipping">Shipping </a></li>
                                            <li><a href="/myaccount">My Account</a></li>
                                            <li><a href="return">Return Policy</a></li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                <div class="footer-bottom ">
                            <div class="container">
                                <div class="tathastu-row tathastu-col-gap">
                                    <div class="tathastu-half-col">
                                        <ul>
                                            <li><a href="/privacy-policy">Privacy Policy</a></li>
                                            <li><a href="#">Terms of Use</a></li>
                                        </ul>
                                    </div>
                                    <div class="tathastu-half-col">
                                        <p>Copyright © 2023 <a href="https://tech9logy.com/">tech9logy.com</a> All Rights Reserved</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </footer>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Accessiories Block Home Page',
                'identifier' => 'accessiories_block_homepage',
                'content' => '<div class="Accessories-box">
                <div class="accessories-heading">
                              <a href="/accessories.html">
                    <h2 class="common-heading">Accessories</h2>
                              </a>
                </div>
                <div class="Accessories-content">
                    <div class="accessories-col">
                        <div class="access-fig">
                            <a href="/accessories/pagri.html">
                                <img src="{{media url=wysiwyg/Pagri.jpg}}" alt="" />
                            </a>
                        </div>
                        <div class="access-content">
                            <h6><a href="/accessories/pagri.html">Pagri</a></h6>
                            <a href="/accessories/mojri.html" class="accessories-viewall">View All</a>
                        </div>
                    </div>
                    <div class="accessories-col">
                        <div class="access-fig">
                            <a href="/accessories/mojri.html">
                                <img src="{{media url=wysiwyg/Mojri_1.jpg}}" alt="" />
                            </a>
                        </div>
                        <div class="access-content">
                            <h6><a href="/accessories/mojri.html">Mojri</a></h6>
                            <a href="/accessories/mojri.html" class="accessories-viewall">View All</a>
                        </div>
                    </div>
                    <div class="accessories-col">
                        <div class="access-fig">
                            <a href="/accessories/mermaid-style.html">
                                <img src="{{media url=wysiwyg/mala.jpg}}" alt="" />
                            </a>
                        </div>
                        <div class="access-content">
                            <h6><a href="/accessories/mermaid-style.html">Mala</a></h6>
                            <a href="/accessories/mermaid-style.html" class="accessories-viewall">View All</a>
                        </div>
                    </div>
                    <div class="accessories-col">
                        <div class="access-fig">
                            <a href="/accessories/indowestern-lehenga.html">
                                <img src="{{media url=wysiwyg/Ring.jpg}}" alt="" />
                            </a>
                        </div>
                        <div class="access-content">
                            <h6><a href="/accessories/indowestern-lehenga.html">Rings</a></h6>
                            <a href="/accessories/indowestern-lehenga.html" class="accessories-viewall">View All</a>
                        </div>
                    </div>
                </div>
            </div>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Client Diaries Block Home Page',
                'identifier' => 'client_diaries_block_home_page',
                'content' => '<div class="client-diaries">
                <div class="client-diaries-content">
                    <i class="fa-brands fa-instagram"></i>
                    <h2 class="common-heading">#Clientdiaries</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                </div>
                <div class="diaries-slider">
                    <div><div class="diaries-fig"><img src="{{media url=wysiwyg/C1.jpg}}" alt="" /></div></div>
                    <div><div class="diaries-fig"><img src="{{media url=wysiwyg/C2.jpg}}" alt="" /></div></div>
                    <div><div class="diaries-fig"><img src="{{media url=wysiwyg/C3.jpg}}" alt="" /></div></div>
                    <div><div class="diaries-fig"><img src="{{media url=wysiwyg/C4.jpg}}" alt="" /></div></div>
                    <div><div class="diaries-fig"><img src="{{media url=wysiwyg/C5.jpg}}" alt="" /></div></div>
                    <div><div class="diaries-fig"><img src="{{media url=wysiwyg/C6.jpg}}" alt="" /></div></div>
                    <div><div class="diaries-fig"><img src="{{media url=wysiwyg/C3.jpg}}" alt="" /></div></div>
                </div>
            </div>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Category Page Banner Image',
                'identifier' => 'category_page_banner_image',
                'content' => '<img src="{{media url=wysiwyg/hs-thu-gen-yes-gurpurabessentials-231123.jpg}}" alt="" />',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Sign IN / Sign UP Page Banner',
                'identifier' => 'sign_in_banner',
                'content' => '<img src="{{media url=wysiwyg/hs-thu-gen-yes-gurpurabessentials-231123.jpg}}" alt="" />',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'All Static Pages Banner',
                'identifier' => 'static_page_banners',
                'content' => "<h1>Write your Home Page Block 5 content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            // Add more blocks as needed
        ];

        foreach ($cmsBlocks as $blockData) {
            $this->blockFactory->create()->setData($blockData)->save();
        }
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }
}
