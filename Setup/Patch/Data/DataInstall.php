<?php
namespace Crisp\Crisp\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Integration\Model\ConfigBasedIntegrationManager;

class DataInstall implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ConfigBasedIntegrationManager
     */
    private $integrationManager;

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param ConfigBasedIntegrationManager $integrationManager
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        ConfigBasedIntegrationManager $integrationManager
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->integrationManager = $integrationManager;
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $this->integrationManager->processIntegrationConfig(['Crisp']);
        $this->moduleDataSetup->endSetup();
    }

    /**
     * @inheritDoc
     */
    public function revert()
    {
        $this->moduleDataSetup->startSetup();
        // Revert code if necessary
        $this->moduleDataSetup->endSetup();
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }
}
