<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */
namespace Tech9logy\CouponCode\Ui\Component\MassAction\Group;

use Magento\Framework\UrlInterface;
use Magento\SalesRule\Model\ResourceModel\Rule\CollectionFactory;

class Options
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Additional options params
     *
     * @var array
     */
    protected $data;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * Base URL for subactions
     *
     * @var string
     */
    protected $urlPath;

    /**
     * Param name for subactions
     *
     * @var string
     */
    protected $paramName;

    /**
     * Additional params for subactions
     *
     * @var array
     */
    protected $additionalData = [];

    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $resource;

    public function __construct(
        CollectionFactory $collectionFactory,
        UrlInterface $urlBuilder,
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->data = $data;
        $this->urlBuilder = $urlBuilder;
        $this->resource                     = $resource;
    }

    /**
     * Get action options
     *
     * @return mixed
     */
    public function jsonSerialize()
    {
        if ($this->options === null) {
            $tech9logyRuleTable = $this->resource->getTableName('tech9logy_couponcode_rule');
            $options = $this->collectionFactory->create()->addFieldToFilter('coupon_rule_id', ['gt' => 0]);
            $options->getSelect()->join(
                ['tech9logy_couponcode_rule' => $tech9logyRuleTable],
                'main_table.rule_id = tech9logy_couponcode_rule.rule_id',
                ['coupon_rule_id'],
                null,
                'left'
            );
            $this->prepareData();
            if (count($options->getData())) {
                foreach ($options->getData() as $optionCode) {
                    $this->options[$optionCode['coupon_rule_id']] = [
                    'type' => 'rule_' . $optionCode['coupon_rule_id'],
                    'label' => $optionCode['name'],
                    ];


                    if ($this->urlPath && $this->paramName) {
                        $this->options[$optionCode['coupon_rule_id']]['url'] = $this->urlBuilder->getUrl(
                            $this->urlPath,
                            [$this->paramName => $optionCode['coupon_rule_id']]
                        );
                    }

                    $this->options[$optionCode['coupon_rule_id']] = array_merge_recursive(
                        $this->options[$optionCode['coupon_rule_id']],
                        $this->additionalData
                    );
                }
                $this->options = array_values($this->options);
            }


        }

        return $this->options;
    }

    /**
     * Prepare addition data for subactions
     *
     * @return void
     */
    protected function prepareData()
    {
        foreach ($this->data as $key => $value) {
            switch ($key) {
                case 'urlPath':
                    $this->urlPath = $value;
                    break;
                case 'paramName':
                    $this->paramName = $value;
                    break;
                default:
                    $this->additionalData[$key] = $value;
                    break;
            }
        }
    }
}
