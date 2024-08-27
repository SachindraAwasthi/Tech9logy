<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Model;

class Action extends \Magento\Rule\Model\AbstractModel
{
    /**
     * Rule Statues
     */
    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 0;

 
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
        \Tech9logy\CouponCode\Model\Action\Condition\CombineFactory $condCombineFactory,
        \Tech9logy\CouponCode\Model\Action\CombineFactory $condProdCombineF,
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
    }

    /**
     * @return Tech9logy\FollowUpEmail\Model\Condition\Combine
     */
    public function getConditionsInstance()
    {
        $combine = $this->_combineFactory->create();
        return $combine;
    }

    /**
     * Getter for rule actions collection
     *
     * @return \Tech9logy\FollowUpEmail\Model\Combine
     */
    public function getActionsInstance()
    {
        return $this->_condProdCombineF->create();
    }
}
