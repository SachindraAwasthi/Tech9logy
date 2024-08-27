<?php

namespace Tech9logy\CouponCode\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Cms\Model\BlockFactory;

class AddCmsBlocks implements DataPatchInterface
{
    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * @param BlockFactory $blockFactory
     */
    public function __construct(
        BlockFactory $blockFactory
    ) {
        $this->blockFactory = $blockFactory;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $cmsBlockData = [
            'title' => 'Tech9logy Newsletter Popup Version 1',
            'identifier' => 'tech9logy_newsletter_popup_version_1',
            'content' => '{{block class="Magento\Framework\View\Element\Template" template="Tech9logy_CouponCode::newsletter/version1.phtml"}}',
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];
        $this->blockFactory->create()->setData($cmsBlockData)->save();
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
