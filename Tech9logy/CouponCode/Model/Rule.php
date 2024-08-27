<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Model;

class Rule extends \Magento\Rule\Model\AbstractModel
{
    /**
     * Rule Statues
     */
    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 0;

    const ALPHANUMBERIC = "alphanumberic";
    const ALPHABETICAL = "alphabetical";
    const NUMBERIC = "numberic";

    const DAYS = "days";
    const WEEKS = "weeks";
    const MONTHS = "months";
    const YEARS = "years";
    const RULE_ID = 'rule_id';
    const COUPON_RULE_ID = 'coupon_rule_id';

 
    protected $_combineFactory;

    /**
     * @var Tech9logy\FollowUpEmail\Model\Earmomg\Rule\Action\CollectionFactory
     */
    protected $_condProdCombineF;
  
    /**
     * AbstractModel constructor.
     *
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Tech9logy\CouponCode\Model\Rule\Condition\CombineFactory $condCombineFactory,
        \Tech9logy\CouponCode\Model\Rule\CombineFactory $condProdCombineF,
        \Magento\SalesRule\Model\Rule\Condition\Product\CombineFactory $condProdCombineF1,
        \Magento\SalesRule\Model\Rule\Condition\CombineFactory $condCombineFactory1,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        //\Magento\Framework\App\ResourceConnection $resource,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        //$this->_resource = $resource;
        $this->_formFactory = $formFactory;
        $this->_localeDate = $localeDate;
        parent::__construct($context, $registry, $formFactory, $localeDate, $resource, $resourceCollection, $data);
        $this->_combineFactory = $condCombineFactory;
        $this->_condProdCombineF = $condProdCombineF;
        $this->_combineFactory1 = $condCombineFactory1;
        $this->_condProdCombineF1 = $condProdCombineF1;
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tech9logy\CouponCode\Model\ResourceModel\Rule');
    }
    
    public function loadByAlias($alias)
    {
        $this->_beforeLoad($alias, 'rule_id');
        $this->_getResource()->load($this, $alias, 'rule_id');
        $this->_afterLoad();
        $this->setOrigData();
        $this->_hasDataChanges = false;
        return $this;
    }

    /**
     * Get Rule statues
     *
     * @return mixed
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
    public function getAllRule()
    {
        $collection = $this->getCollection();
        $param = [];
        foreach ($collection->getData() as $rule) {
            $param[$rule['rule_id']] = $rule['name'];
        }
        return $param;
    }

    public function getCodeFormat()
    {
        $param = [
        ['value' => 'rating', 'label' => __('Rating')],
        ['value' => 'cat_position', 'label' => __('Poisition')]
        ];
        return [self::ALPHANUMBERIC => __('Alphanumberic'), self::ALPHABETICAL => __('Alphabetical') , self::NUMBERIC => __('Numberic')];
    }

    public function getExpiryDate()
    {
        return[self::DAYS => __('Days'), self::WEEKS => __('Weeks'), self::MONTHS => __('Months'), self::YEARS => __('years')];
    }
 

    /**
     * @return Tech9logy\FollowUpEmail\Model\Condition\Combine
     */
    public function getConditionsInstance()
    {
        // $combine = $this->_combineFactory->create();
        $combine = $this->_combineFactory1->create();
        return $combine;
    }

    /**
     * Getter for rule actions collection
     *
     * @return \Tech9logy\FollowUpEmail\Model\Combine
     */
    public function getActionsInstance()
    {
        // return $this->_condProdCombineF->create();
        $actions = $this->_condProdCombineF1->create();
        return $actions;
    }
    
    public function validateData(\Magento\Framework\DataObject $dataObject)
    {
        $result = [];
        $fromDate = $toDate = null;

        if ($dataObject->hasActiveFrom() && $dataObject->hasActiveTo()) {
            $fromDate = $dataObject->getActiveFrom();
            $toDate = $dataObject->getActiveTo();
        }

        if ($fromDate && $toDate) {
            $fromDate = new \DateTime($fromDate);
            $toDate = new \DateTime($toDate);
            if ($fromDate > $toDate) {
                $result[] = __('End Date must follow Start Date.');
            }
        }

        return !empty($result) ? $result : true;
    }

    /**
     * Get rule_id
     * @return string
     */
    public function getRuleId()
    {
        return $this->getData(self::RULE_ID);
    }

    /**
     * Set rule_id
     * @param string $ruleId
     * @return \Tech9logy\CouponCode\Api\Data\RuleInterface
     */
    public function setRuleId($ruleId)
    {
        return $this->setData(self::RULE_ID, $ruleId);
    }

    /**
     * Get coupon_rule_id
     * @return string
     */
    public function getCouponRuleId()
    {
        return $this->getData(self::COUPON_RULE_ID);
    }

    /**
     * Set coupon_rule_id
     * @param string $coupon_rule_id
     * @return \Tech9logy\CouponCode\Api\Data\RuleInterface
     */
    public function setCouponRuleId($coupon_rule_id)
    {
        return $this->setData(self::COUPON_RULE_ID, $coupon_rule_id);
    }
}
