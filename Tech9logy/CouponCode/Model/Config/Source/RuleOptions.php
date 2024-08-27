<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Model\Config\Source;

use Magento\SalesRule\Model\ResourceModel\Rule\CollectionFactory;

class RuleOptions implements \Magento\Framework\Option\ArrayInterface
{
    protected $ruleCollectionFactory;

    public function __construct(CollectionFactory $ruleCollectionFactory)
    {
        $this->ruleCollectionFactory = $ruleCollectionFactory;
    }

    public function toOptionArray()
    {
        $options = [['value' => '', 'label' => __('-- Please Select A Rule --')]];

        $collection = $this->ruleCollectionFactory->create();
        foreach ($collection as $rule) {
            $label = $rule->getId() . ' - ' . addslashes($rule->getName()); // Concatenate ID with the name
            $options[] = [
                'value' => $rule->getId(),
                'label' => $label
            ];
        }

        return $options;
    }
}


// namespace Tech9logy\CouponCode\Model\Config\Source;

// use Magento\SalesRule\Model\ResourceModel\Rule\CollectionFactory;

// class RuleOptions implements \Magento\Framework\Option\ArrayInterface
// {
//     protected $ruleCollectionFactory;

//     public function __construct(CollectionFactory $ruleCollectionFactory)
//     {
//         $this->ruleCollectionFactory = $ruleCollectionFactory;
//     }

//     public function toOptionArray()
//     {
//         $options = [['value' => '', 'label' => __('-- Please Select --')]];

//         $rules = $this->ruleCollectionFactory->create();
//         foreach ($rules as $rule) {
//             $options[] = [
//                 'value' => $rule->getId(),
//                 'label' => $rule->getName() // Use any other field for the label if needed
//             ];
//         }

//         return $options;
//     }
// }
