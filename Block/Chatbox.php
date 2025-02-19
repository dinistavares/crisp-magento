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

class Chatbox extends Template
{
    /**
     * @param Template\Context      $context
     * @param ScopeConfigInterface  $scopeConfig
     * @param SessionFactory        $session
     * @param CustomerFactory       $customer
     * @param StoreManagerInterface $storeManager
     * @param array                 $data
     */

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        SessionFactory $session,
        CustomerFactory $customer,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_scopeConfig  = $scopeConfig;
        $this->_session      = $session;
        $this->_customer     = $customer;
        $this->_storeManager = $storeManager;
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
     * Get current currency code
     *
     * @return string
     */
    public function getCurrentCurrency()
    {
        return $this->_storeManager->getStore()->getCurrentCurrencyCode();
    }
}
