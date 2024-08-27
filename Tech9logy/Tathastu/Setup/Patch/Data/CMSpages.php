<?php

/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2024 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_Tathastu
 */

namespace Tech9logy\Tathastu\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;

class CMSpages implements DataPatchInterface
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var PageRepositoryInterface
     */
    private $pageRepository;

    public function __construct(
        PageFactory $pageFactory,
        PageRepositoryInterface $pageRepository
    ) {
        $this->pageFactory = $pageFactory;
        $this->pageRepository = $pageRepository;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $cmsPageData = [
            [
                'title' => 'About Us',
                'page_layout' => '1column',
                'meta_keywords' => 'About Us',
                'meta_description' => 'About Our Company',
                'identifier' => 'about-us',
                'content_heading' => 'About Us',
                'content' => '<p>Your "About Us" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
                'url_key' => 'about-us'
            ],
            [
                'title' => 'Return Policy',
                'page_layout' => '1column',
                'meta_keywords' => 'Return Policy',
                'meta_description' => 'Our Return Policy',
                'identifier' => 'return-policy',
                'content_heading' => 'Return Policy',
                'content' => '<p>Your "Return Policy" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 1,
                'url_key' => 'return-policy'
            ],
            [
                'title' => 'Shipping Policy',
                'page_layout' => '1column',
                'meta_keywords' => 'Shipping Policy',
                'meta_description' => 'Our Shipping Policy',
                'identifier' => 'shipping-policy',
                'content_heading' => 'Shipping Policy',
                'content' => '<p>Your "Shipping Policy" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 2,
                'url_key' => 'shipping-policy'
            ],
            [
                'title' => 'Our Businesses',
                'page_layout' => '1column',
                'meta_keywords' => 'Our Businesses',
                'meta_description' => 'Information about Our Businesses',
                'identifier' => 'our-businesses',
                'content_heading' => 'Our Businesses',
                'content' => '<p>Your "Our Businesses" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 3,
                'url_key' => 'our-businesses'
            ],
            [
                'title' => 'Career',
                'page_layout' => '1column',
                'meta_keywords' => 'Career',
                'meta_description' => 'Career Opportunities',
                'identifier' => 'career',
                'content_heading' => 'Career',
                'content' => '<p>Your "Career" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 4,
                'url_key' => 'career'
            ],
            [
                'title' => 'Who we are',
                'page_layout' => '1column',
                'meta_keywords' => 'Who we are',
                'meta_description' => 'Learn about Our Company',
                'identifier' => 'who-we-are',
                'content_heading' => 'Who we are',
                'content' => '<p>Your "Who we are" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 5,
                'url_key' => 'who-we-are'
            ],
            [
                'title' => 'Awards & Accolades',
                'page_layout' => '1column',
                'meta_keywords' => 'Awards & Accolades',
                'meta_description' => 'Our Awards and Achievements',
                'identifier' => 'awards-accolades',
                'content_heading' => 'Awards & Accolades',
                'content' => '<p>Your "Awards & Accolades" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 6,
                'url_key' => 'awards-accolades'
            ],
            [
                'title' => 'Leaders',
                'page_layout' => '1column',
                'meta_keywords' => 'Leaders',
                'meta_description' => 'Meet Our Leadership Team',
                'identifier' => 'leaders',
                'content_heading' => 'Leaders',
                'content' => '<p>Your "Leaders" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 7,
                'url_key' => 'leaders'
            ],
            [
                'title' => 'Our Policy',
                'page_layout' => '1column',
                'meta_keywords' => 'Our Policy',
                'meta_description' => 'Our Company Policies',
                'identifier' => 'our-policy',
                'content_heading' => 'Our Policy',
                'content' => '<p>Your "Our Policy" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 8,
                'url_key' => 'our-policy'
            ],
            [
                'title' => 'Partner With Us',
                'page_layout' => '1column',
                'meta_keywords' => 'Partner With Us',
                'meta_description' => 'Partnering Opportunities',
                'identifier' => 'partner-with-us',
                'content_heading' => 'Partner With Us',
                'content' => '<p>Your "Partner With Us" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 9,
                'url_key' => 'partner-with-us'
            ],
            [
                'title' => 'Contact',
                'page_layout' => '1column',
                'meta_keywords' => 'Contact',
                'meta_description' => 'Get in Touch with Us',
                'identifier' => 'contact',
                'content_heading' => 'Contact',
                'content' => '<p>Your "Contact" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 10,
                'url_key' => 'contact'
            ],
            [
                'title' => 'Cookie Policy',
                'page_layout' => '1column',
                'meta_keywords' => 'Cookie Policy',
                'meta_description' => 'Our Cookie Policy',
                'identifier' => 'cookie-policy',
                'content_heading' => 'Cookie Policy',
                'content' => '<p>Your "Cookie Policy" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 11,
                'url_key' => 'cookie-policy'
            ],
            [
                'title' => 'News & Media',
                'page_layout' => '1column',
                'meta_keywords' => 'News & Media',
                'meta_description' => 'Latest News and Media',
                'identifier' => 'news-media',
                'content_heading' => 'News & Media',
                'content' => '<p>Your "News & Media" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 12,
                'url_key' => 'news-media'
            ],
            [
                'title' => 'Media contact',
                'page_layout' => '1column',
                'meta_keywords' => 'Media contact',
                'meta_description' => 'Media Contact Information',
                'identifier' => 'media-contact',
                'content_heading' => 'Media Contact',
                'content' => '<p>Your "Media Contact" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 13,
                'url_key' => 'media-contact'
            ],
            [
                'title' => 'Blogs',
                'page_layout' => '1column',
                'meta_keywords' => 'Blogs',
                'meta_description' => 'Our Blog Section',
                'identifier' => 'blogs',
                'content_heading' => 'Blogs',
                'content' => '<p>Your "Blogs" content goes here...</p>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 14,
                'url_key' => 'blogs'
            ],
        ];

        foreach ($cmsPageData as $cmsPage) {
            try {
                // Check if a page with the same URL key already exists
                $existingPage = $this->pageRepository->getById($cmsPage['identifier']);
            } catch (LocalizedException $e) {
                $existingPage = null;
            }

            if (!$existingPage) {
                // Page does not exist, so create it
                $this->pageFactory->create()->setData($cmsPage)->save();
            } else {
                // Optionally, update the existing page
                $existingPage->setData(array_merge($existingPage->getData(), $cmsPage));
                $this->pageRepository->save($existingPage);
            }
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
