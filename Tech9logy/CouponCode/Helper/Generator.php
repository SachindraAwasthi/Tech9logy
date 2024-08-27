<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */
namespace Tech9logy\CouponCode\Helper;

class Generator extends \Magento\Framework\App\Helper\AbstractHelper
{
    const EMAILIDENTIFIER = 'sent_mail_with_visitor';
    protected $_couponHelper;
    /**
     * @var \Magento\SalesRule\Model\CouponFactory
     */
    protected $couponFactory;
    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    protected $dateTime;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $date;

    protected $customerHelper;

    protected $tech9logyCoupon;

    protected $_urlInterface;

    protected $_customer_name;
    protected $_customer_email;
    protected $_coupon_alias;
    protected $_customer_id;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Tech9logy\CouponCode\Helper\Data $couponHelper,
        \Magento\SalesRule\Model\CouponFactory $couponFactory,
        \Magento\Framework\Stdlib\DateTime $dateTime,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Tech9logy\CouponCode\Model\CouponFactory $tech9logyCoupon
    ) {
        parent::__construct($context);
         $this->_couponHelper = $couponHelper;
        $this->couponFactory = $couponFactory;
        $this->dateTime = $dateTime;
        $this->date = $date;
        $this->tech9logyCoupon = $tech9logyCoupon;
    }
    public function initRequireModels()
    {
        //do nothing
        return $this;
    }
    public function setCustomerName($name = '')
    {
        $this->_customer_name = $name;
        return $this;
    }

    public function setCustomerEmail($email = '')
    {
        $this->_customer_email = $email;
        return $this;
    }
    public function setCustomerId($customer_id = '')
    {
        $this->_customer_id = $customer_id;
        return $this;
    }
    public function setCouponAlias($coupon_alias = '')
    {
        $this->_coupon_alias = $coupon_alias;
        return $this;
    }
    public function getCustomerName()
    {
        return $this->_customer_name;
    }

    public function getCustomerEmail()
    {
        return $this->_customer_email;
    }


    public function generateCoupon($couponRuleId, $alias = '', $limit = 1, $email_address = '')
    {
        $coupon_code = '';
        $couponRuleData = $this->_couponHelper->getCouponRuleData($couponRuleId);
        $ruleId = (int)$couponRuleData->getRuleId();
        if ($couponRuleData && $ruleId) {
            if (!is_numeric($couponRuleId)) {
                $couponRuleId = $couponRuleData->getId();
            }
            $limit_time_generated_coupon = (int)$couponRuleData->getLimitGenerated();
            $email_address = $this->_customer_email?$this->_customer_email:$email_address;
            $coupon = $this->couponFactory->create();
            $emailFrom = $this->_couponHelper->getConfig('general_settings/sender_email_identity');
            $emailidentifier = self::EMAILIDENTIFIER;

            $nowTimestamp = $this->dateTime->formatDate($this->date->gmtTimestamp());
            $expirationDate = $couponRuleData->getToDate();
            if ($expirationDate && !($expirationDate instanceof \DateTime)) {
                $expirationDate = \DateTime::createFromFormat('Y-m-d', $expirationDate);
            }
            if ($expirationDate instanceof \DateTime) {
                $expirationDate = $expirationDate->format('Y-m-d H:i:s');
            }
            $_tech9logyCoupon = $this->tech9logyCoupon->create();

            //if $limit == 1, then get the coupon code which was created for the email address and rule id and check if not exists will generate new coupon code, if exists will get curren coupon code
            try {
                $exists_coupon_code = "";
                $coupon_collection = $_tech9logyCoupon->getCollection();
                $number_generated_coupon = (int)$coupon_collection->getTotalByEmail($email_address, $ruleId);
                if ($limit_time_generated_coupon > 0 && $number_generated_coupon >= $limit_time_generated_coupon) {
                    //check number coupons was generated for same email address
                    $exists_coupon_code = $coupon_collection->getFirstItem()->getCode();
                }
                
                if (!$exists_coupon_code) {
                    $coupon_code = $this->_couponHelper->generateCode($couponRuleId);

                    $coupon->setId(null)
                            ->setRuleId($ruleId)
                            ->setExpriationDate($expirationDate)
                            ->setCreatedAt($nowTimestamp)
                            ->setType(1)
                            ->setCode($coupon_code)
                            ->save();
                    if ($coupon->getId()) {
                        $customer_id = $this->_customer_id;
                        $coupon_alias = $this->_coupon_alias;

                        $_tech9logyCoupon->setRuleId($ruleId)
                            ->setCouponId($coupon->getId())
                            ->setCode($coupon_code)
                            ->setEmail($email_address);

                        if ($customer_id) {
                            $_tech9logyCoupon->setCustomerId($customer_id);
                        }
                        if ($coupon_alias) {
                            $_tech9logyCoupon->setCouponAlias($coupon_alias);
                        }
                        
                        $_tech9logyCoupon->save();

                        $couponsGeneratedOld =$couponRuleData->getCouponsGenerated();
                        $couponGenerateNew = $couponsGeneratedOld + 1;
                        $couponRuleData->setData('coupons_generated', $couponGenerateNew)->save();
                    } else {
                        $coupon_code = '';
                    }
                } else {
                    $coupon_code = $exists_coupon_code;
                }

            } catch (\Exception $e) {
                if ($alias) {
                    $_tech9logyCoupon->getCouponByAlias($alias);
                    if ($_tech9logyCoupon->getId()) {
                        $coupon_code = $_tech9logyCoupon->getCode();
                    }
                }
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
            }
        }
        return $coupon_code;
    }
    public function getCouponCode($alias)
    {
        $_tech9logyCoupon = $this->tech9logyCoupon->create();
        $_tech9logyCoupon->getCouponByAlias($alias);
        if ($_tech9logyCoupon->getId()) {
            return $_tech9logyCoupon->getCode();
        }
        return '';
    }
    public function getCouponExpirationDate($alias)
    {
        $_tech9logyCoupon = $this->tech9logyCoupon->create();
        $_tech9logyCoupon->getCouponByAlias($alias);
        if ($_tech9logyCoupon->getId()) {
            //get coupon expiration date
            return $_tech9logyCoupon->getToDate();
        }
        return '';
    }
    public function getCouponDiscount($alias)
    {
        $_tech9logyCoupon = $this->tech9logyCoupon->create();
        $_tech9logyCoupon->getCouponByAlias($alias);
        if ($_tech9logyCoupon->getId()) {
            //get coupon discount
            return $_tech9logyCoupon->getDiscountAmount();
        }
        return '';
    }
    public function getUsesPerCoupon($alias)
    {
        $_tech9logyCoupon = $this->tech9logyCoupon->create();
        $_tech9logyCoupon->getCouponByAlias($alias);
        if ($_tech9logyCoupon->getId()) {
            //get users per coupon
            return $_tech9logyCoupon->getUsesPerCoupon();
        }
        return '';
    }
}
