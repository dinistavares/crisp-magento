<?php
/**
 * @author: Crisp IM
 */

namespace Crisp\Crisp\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Customer\Model\SessionFactory;
use \Magento\Customer\Model\CustomerFactory;
use \Magento\Store\Model\StoreManagerInterface;
use \Hyva\Theme\Service\CurrentTheme;

class Chatbox extends Template
{
    /**
     * @param Template\Context      $context
     * @param ScopeConfigInterface  $scopeConfig
     * @param SessionFactory        $session
     * @param CustomerFactory       $customer
     * @param StoreManagerInterface $storeManager
     * @param CurrentTheme          $currentTheme
     * @param array                 $data
     */

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        SessionFactory $session,
        CustomerFactory $customer,
        StoreManagerInterface $storeManager,
        CurrentTheme $currentTheme,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_scopeConfig  = $scopeConfig;
        $this->_session      = $session;
        $this->_customer     = $customer;
        $this->_storeManager = $storeManager;
        $this->currentTheme  = $currentTheme;
    }

    /**
     * Returns website_id.
     *
     * @return string
     */
    public function getWebsiteId()
    {
        return $this->_scopeConfig->getValue(
            'crisp_settings/chatbox/crisp_website_id',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Returns customer_id.
     *
     * @return string
     */
    public function getCustomerId()
    {
        $customer = $this->_session->create();

        return $customer->getCustomer()->getId();
    }

    /**
     * Return Customer email
     *
     * @return string
     */
    public function getCustomerEmail()
    {
        $customerId = $this->getCustomerId();
        $customer   = $this->_customer->create()->load((int) $customerId);

        return $customer->getEmail();
    }

    /**
     * Get current currency code
     *
     * @return string
     */
    public function getCurrentCurrency()
    {
        return $this->_storeManager->getStore()->getCurrentCurrencyCode();
    }

    /**
     * Check if theme is Hyva
     *
     * @return boolean
     */
    public function isHyva()
    {
        if ($this->currentTheme === null) {
            return false;
        }

        return $this->currentTheme->isHyva();
    }
}
