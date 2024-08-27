<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Psr\Log\LoggerInterface;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\SalesRule\Model\Coupon\Massgenerator;
use Magento\SalesRule\Model\RuleFactory;
use Tech9logy\CouponCode\Helper\Data as CouponCodeHelper;
use Tech9logy\CouponCode\Model\CampaignsFactory;
use Tech9logy\CouponCode\Model\ResourceModel\Campaigns\CollectionFactory as CampaignCollectionFactory;

class EmailFormSubmitObserver implements ObserverInterface
{
    protected $transportBuilder;
    protected $logger;
    protected $storeManager;
    protected $inlineTranslation;
    protected $scopeConfig;
    protected $massGenerator;
    protected $ruleFactory;
    protected $couponFactory;
    protected $couponCodeHelper;
    protected $_ruleFactory;
    protected $_ruleCollectionFactory;
    protected $campaignsFactory;
    protected $campaignCollectionFactory;

    public function __construct(
        \Tech9logy\CouponCode\Model\RuleFactory $_ruleFactory,
        \Tech9logy\CouponCode\Model\ResourceModel\Rule\CollectionFactory $_ruleCollectionFactory,
        TransportBuilder $transportBuilder,
        LoggerInterface $logger,
        StoreManagerInterface $storeManager,
        StateInterface $state,
        ScopeConfigInterface $scopeConfig,
        Massgenerator $massGenerator,
        RuleFactory $ruleFactory,
        \Tech9logy\CouponCode\Model\LoyaltyProgramFactory $couponFactory,
        CouponCodeHelper $couponCodeHelper,
        CampaignsFactory $campaignsFactory,
        CampaignCollectionFactory $campaignCollectionFactory
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->logger = $logger;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $state;
        $this->scopeConfig = $scopeConfig;
        $this->massGenerator = $massGenerator;
        $this->ruleFactory = $ruleFactory;
        $this->couponFactory = $couponFactory;
        $this->couponCodeHelper = $couponCodeHelper;
        $this->_ruleFactory = $_ruleFactory;
        $this->_ruleCollectionFactory = $_ruleCollectionFactory;
        $this->campaignsFactory = $campaignsFactory;
        $this->campaignCollectionFactory = $campaignCollectionFactory;
    }

    public function execute(Observer $observer)
    {
        
        // Load campaign data
        $campaignCollection = $this->campaignCollectionFactory->create();
        $campaignData = $campaignCollection->getData();
        foreach ($campaignData as $campaignItem) {
            $senderEmail = $campaignItem["sender_email"];
            $cpruleID = $campaignItem["cart_price_rule_id"];
            $cartpriceruleid = $campaignItem["sendgrid_list_id"];
            $emailTemplate = $campaignItem["email_template"];
            $formName = $campaignItem["email_template"];
            $homeorother = $campaignItem["display_mode_home"];
            $couponcodesetting = $campaignItem["sendgrid_mode"];
            $staticcouponcode = $campaignItem["specific_coupon"];
            // Process campaign data as needed
        }
        
        $templateId = "tech9logy_email_template_form";
        $fromEmail = $senderEmail;
        $fromName = "Admin";
        $data = $observer->getData("data");
        if (isset($data["coupon_email"])) {
            $data["email"] = $data["coupon_email"];
        }
        $email = $data["email"];
        $selectedRuleId = $cartpriceruleid;
        
        try {
            $receiverEmail = $data["email"];
            
            $couponCode = "";
            
            // Determine coupon code based on the couponcodesetting value
            if ($couponcodesetting == 1) {
                
                // Generate coupon code based on cart price rule ID
                $couponCode = $this->generateCouponCode($selectedRuleId);
            } elseif ($couponcodesetting == 2) {
                // Use static coupon code "THANKYOU"
                $couponCode = $staticcouponcode;
            }
            $templateVars = [
                "data" => $data,
                "couponcode" => $couponCode,
            ];
            $storeId = $this->storeManager->getStore()->getId();
            $from = ["email" => $fromEmail, "name" => $fromName];
            $this->inlineTranslation->suspend();
            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $templateId = "tech9logy_email_template_form";
            $templateVars = [
                "data" => $data,
                "couponcode" => $couponCode,
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier($templateId, $storeScope)
                ->setTemplateOptions([
                    "area" => \Magento\Framework\App\Area::AREA_FRONTEND,
                    "store" => $storeId,
                ])
                ->setTemplateVars($templateVars)
                ->setFrom(["email" => $fromEmail, "name" => $fromName])
                ->addTo($receiverEmail)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
            $this->saveCouponCode($couponCode, $receiverEmail, $selectedRuleId);
        } catch (\Exception $e) {
            $this->logger->info($e->getMessage());
        }
    }

    protected function generateCouponCode($ruleId)
    {
        $model = $this->_ruleFactory->create()->loadbyalias($ruleId);
        $rule = $this->ruleFactory->create()->load($ruleId);
        if (!$rule->getId()) {
            $this->logger->error("Rule with ID $ruleId not found.");
            return false;
        }

        try {
            $data = [
                "rule_id" => $ruleId,
                "qty" => 1,
                "length" => $model->getData("coupons_length") ?: "12",
                "format" => $model->getData("coupons_format") ?: "alphanum",
                "prefix" => $model->getData("coupons_prefix") ?: "",
                "suffix" => $model->getData("coupons_suffix") ?: "",
                "dash" => $model->getData("coupons_dash") ?: 0,
            ];

            if (!$this->massGenerator->validateData($data)) {
                $this->logger->error("Invalid coupon data.");
                return false;
            }

            $this->massGenerator->setData($data);
            $this->massGenerator->generatePool();
            $generated = $this->massGenerator->getGeneratedCount();
            $codes = $this->massGenerator->getGeneratedCodes();

            return $codes[0];
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return false;
        }
    }

    protected function saveCouponCode($code, $receiverEmail, $selectedRuleId)
    {
        try {
            $coupon = $this->couponFactory->create();
            $coupon->setData([
                "email" => $receiverEmail,
                "code" => $code,
                "coupon_id" => 50,
                "rule_id" => $selectedRuleId,
                "customer_id" => null,
            ]);
            $coupon->save();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
