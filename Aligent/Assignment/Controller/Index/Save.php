<?php
namespace Aligent\Assignment\Controller\Index;

use Exception;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Assignment
 * @package Aligent\Assignment\Controller\Index
 */
class Save extends Action
{
    /**
     * Constant values
     */
    const LIVECHAT_LICENSE_NUMBER = 'livechat_license_number';
    const LIVECHAT_GROUP = 'livechat_groups';
    const LIVECHAT_PARAMS = 'livechat_params';
    const CONFIG_TABLE = 'core_config_data';
    const CONFIG_CONFIG = 'default';
    const CONFIG_SCOPE_ID = '0';

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Assignment constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param LoggerInterface $logger
     * @param Context $context
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        LoggerInterface $logger,
        Context $context
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->logger = $logger;
        return parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        // Do needfull
        $this->postAction();
    }

    /**
     * Post Action
     * Below code address the required functionality of the given M1 sample code
     */
    public function postAction()
    {
        // initiate variables
        $livechatLicenseNumber = '';
        $livechatGroups = '0';
        $livechatParams = '';

        // assign post values
        if ($this->getRequest()->getParam(self::LIVECHAT_LICENSE_NUMBER) !== null) {
            $livechatLicenseNumber = $this->getRequest()->getParam(self::LIVECHAT_LICENSE_NUMBER);
        }
        if ($this->getRequest()->getParam(self::LIVECHAT_GROUP) !== null) {
            $livechatGroups = $this->getRequest()->getParam(self::LIVECHAT_GROUP);
        }
        if ($this->getRequest()->getParam(self::LIVECHAT_PARAMS) !== null) {
            $livechatParams = $this->getRequest()->getParam(self::LIVECHAT_PARAMS);
        }

        // prepare insert|update array
        $submitArray = [
            [
                'scope' => self::CONFIG_CONFIG,
                'scope_id' => self::CONFIG_SCOPE_ID,
                'path' => self::LIVECHAT_LICENSE_NUMBER,
                'value' => $livechatLicenseNumber
            ],
            [
                'scope' => self::CONFIG_CONFIG,
                'scope_id' => self::CONFIG_SCOPE_ID,
                'path' => self::LIVECHAT_GROUP,
                'value' => $livechatGroups
            ],
            [
                'scope' => self::CONFIG_CONFIG,
                'scope_id' => self::CONFIG_SCOPE_ID,
                'path' => self::LIVECHAT_PARAMS,
                'value' => $livechatParams
            ]
        ];
        // do insert|update
        try {
            $this->moduleDataSetup->getConnection()->insertOnDuplicate(
                $this->moduleDataSetup->getTable(self::CONFIG_TABLE),
                $submitArray
            );
        } catch (Exception $e) {
            // log if error occurred
            $this->logger->critical($e->getMessage());
        }
        $this->_redirect('*/*/index');
    }
}
