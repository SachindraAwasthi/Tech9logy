<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Model\Config\Source;

class Staticblock implements \Magento\Framework\Option\ArrayInterface
{
    protected $_blockModel;

    /**
     * @param \Magento\Cms\Model\Block $blockModel
     */
    public function __construct(
        \Magento\Cms\Model\Block $blockModel
    ) {
        $this->_groupModel = $blockModel;
    }

    /**
     * Options getter
     *
     * @return mixed
     */
    public function toOptionArray()
    {
        $collection = $this->_groupModel->getCollection();
        $blocks = [];
        foreach ($collection as $_block) {
            $blocks[] = [
            'value' => $_block->getId(),
            'label' => $_block->getTitle()
            ];
        }
        array_unshift($blocks, [
                'value' => 'custom_content',
                'label' => __('-- Please select static block --'),
                ]);
        return $blocks;
    }
}
