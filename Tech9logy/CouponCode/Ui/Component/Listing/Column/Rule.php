<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */
namespace Tech9logy\CouponCode\Ui\Component\Listing\Column;
 
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
 
class Rule extends Column
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;
 
    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
 
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return mixed
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $fieldName = $this->getData('name');

                // Add a check to ensure that the 'name' index exists in the $item array
                if (isset($item['name'])) {
                    $rule_name = $item['name'];
                    $rule_link = $this->urlBuilder->getUrl('couponcode/rule/edit', ['coupon_rule_id' => $item['coupon_rule_id']]);
                    $item[$fieldName . '_html'] = '<a href="' . $rule_link . '">' . $rule_name . '</a><br />';
                }
            }
        }
 
        return $dataSource;
    }
}
