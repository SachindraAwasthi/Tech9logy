<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Plugin;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class CouponManagementPlugin
{
    /**
     * Quote repository.
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * Quote repository.
     *
     * @var \Magento\Checkout\Model\SessionFactory
     */
    protected $sessionFactory;

    /**
     * @var \Tech9logy\CouponCode\Model\CouponFactory
     */
    protected $couponFactory;

    /**
     * @var \Tech9logy\CouponCode\Helper\Data $helperData
     */
    protected $helperData;

    /**
     * @var bool
     */
    protected $flag = false;

    /**
     * Constructs a coupon read service object.
     *
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
     * @param \Tech9logy\CouponCode\Model\CouponFactory $couponFactory
     * @param \Magento\Checkout\Model\SessionFactory $sessionFactory
     * @param \Tech9logy\CouponCode\Helper\Data $helperData
     */
    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \Tech9logy\CouponCode\Model\CouponFactory $couponFactory,
        \Magento\Checkout\Model\SessionFactory $sessionFactory,
        \Tech9logy\CouponCode\Helper\Data $helperData
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->couponFactory = $couponFactory;
        $this->sessionFactory = $sessionFactory;
        $this->helperData = $helperData;
    }

    /**
     * @param \Magento\Quote\Api\CouponManagementInterface $subject
     * @param \Closure $proceed
     * @param string|int $cartId
     * @param string $couponCode
     */
    public function aroundSet(
        \Magento\Quote\Api\CouponManagementInterface $subject,
        \Closure $proceed,
        $cartId,
        $couponCode
    ) {
        if ($this->helperData->isEnabled()) {
            //get info by couponcode
            $couponCollection = $this->couponFactory->create()->getCollection();
            $data = $couponCollection->getByCouponCode($couponCode);
            if ($data && count($data) > 0 && isset($data["rule_id"])) {
                $rule = $couponCollection->getRule((int)$data["rule_id"]);
                //get checkout info
                $customer_checkout = $this->sessionFactory->create()->getQuote()->getCustomer();
                $customer_email = $customer_checkout->getEmail();
                $customer_id = $customer_checkout->getId();
                if (isset($rule['is_check_email']) && $rule["is_check_email"]) {
                    if ((isset($data["email"]) && $data["email"] == $customer_email) || (isset($data["customer_id"]) && $data["customer_id"] == $customer_id)) {
                        $this->flag = true;
                    }
                } else {
                    $this->flag = true;
                }
            }
            if ($this->flag) {
                return $proceed($cartId, $couponCode);
            } else {
                throw new NoSuchEntityException(__('Coupon code is not valid!'));
            }
        } else {
            return $proceed($cartId, $couponCode);
        }
    }
}
