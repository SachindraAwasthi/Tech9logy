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

class Blocks implements DataPatchInterface
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
                'title' => 'Header Block',
                'identifier' => 'home_page_header',
                'content' => "<h1>Write your Header Block content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Slider',
                'identifier' => 'home_page_slider',
                'content' => "<h1>Write your Home Page Slider content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 1,
            ],
            [
                'title' => 'USP Section',
                'identifier' => 'home_page_usp_setion',
                'content' => "<h1>Write your USP Section content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Category BLock',
                'identifier' => 'homepage_category_block',
                'content' => "<h1>Write your Cate BLock content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Occasion',
                'identifier' => 'occasion_block',
                'content' => "<h1>Write your Occasion content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Featured Products',
                'identifier' => 'homepage_featured_products',
                'content' => "<h1>Write your Featured Products content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Top Seller RC View',
                'identifier' => 'top_seller_rc_view',
                'content' => "<h1>Write your Top Seller RC View content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Banner',
                'identifier' => 'home_page_banner_1',
                'content' => "<h1>Write your Home Page Banner content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Client Diaries Block',
                'identifier' => 'client_diarie_block',
                'content' => "<h1>Write your Client Diaries Block content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Newsletter',
                'identifier' => 'newsletter_block',
                'content' => "<h1>Write your Newsletter content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Footer',
                'identifier' => 'home_page_footer_block',
                'content' => "<h1>Write your Home Page Footer content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Block 1',
                'identifier' => 'home_page_block_1',
                'content' => "<h1>Write your Home Page Block 1 content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Block 2',
                'identifier' => 'home_page_block_2',
                'content' => "<h1>Write your Home Page Block 2 content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Block 3',
                'identifier' => 'home_page_block_3',
                'content' => "<h1>Write your Home Page Block 3 content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Block 4',
                'identifier' => 'home_page_block_4',
                'content' => "<h1>Write your Home Page Block 4 content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Home Page Block 5',
                'identifier' => 'home_page_block_5',
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
