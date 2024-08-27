<?php

/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2024 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_Tathastu
 */

declare(strict_types=1);

namespace Tech9logy\Tathastu\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

class TopHeaderIcons implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var BlockFactory
     */
    private $blockFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockFactory $blockFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockFactory = $blockFactory;
    }

    public static function getVersion()
    {
        return '1.0.0';
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $content = '<div class="top-header primary-bg-color">
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
    </div>';

        $this->blockFactory->create()->setData([
            'title' => 'Top Header Icons',
            'identifier' => 'top_header_icons',
            'content' => $content,
            'is_active' => 1,
            'stores' => [0], // Set store IDs where you want to display the block
        ])->save();

        $this->moduleDataSetup->endSetup();
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }
}
