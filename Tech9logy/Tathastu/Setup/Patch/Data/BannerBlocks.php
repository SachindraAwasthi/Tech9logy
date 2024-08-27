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

class BannerBlocks implements DataPatchInterface
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
                'title' => 'Category Page Banner Block',
                'identifier' => 'category_page_banner',
                'content' => "<h1>Write your Category Page Banner Block content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'My Account Page Banner',
                'identifier' => 'myaccount_page_slider',
                'content' => "<h1>Write your My Account Page Banner content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 1,
            ],
            [
                'title' => 'Cart Page Banner',
                'identifier' => 'cart_page_banner',
                'content' => "<h1>Write your Cart Page Banner content.......</h1>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0,
            ],
            [
                'title' => 'Static Pages Banner',
                'identifier' => 'static_page_banner',
                'content' => "<h1>Write your Static Page Banner content.......</h1>",
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
