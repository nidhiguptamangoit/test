<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Salecto2\Magento2FrontendTheme\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Framework\App\Helper\Context;
class Data extends AbstractHelper
{
    /**
     * @var $_context
     */
    protected $_context;

    /**
     * @var load config file
     */
    protected $_loadConfigFile;

    /**
     * @var scope config
     */
    protected $_scopeConfig;

    public function __construct(
		Context $context,
        \Magento\Framework\App\DeploymentConfig\Reader $loadConfigFile,
         \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->_context = $context;
        $this->_loadConfigFile = $loadConfigFile;
        $this->_scopeConfig = $scopeConfig;
        return 	parent::__construct($context);
    }
    
    /**
     * {@get theme configuration from config file}
     */
    public function getThemeConfig($scope, $key)
    {
        try {	
            if($scope) {
                if($scope == 'theme') {
                    $data = $this->_loadConfigFile->load('app_config');
                    if(is_array($data) && array_key_exists('themes', $data)) {
                       $headerType = $data['themes']['frontend/Salecto/default'][$key];
                       return $headerType ;
                    }
                }
            }
        } catch (\Exception $e) {
           return false;
        }
    }
    /**
     * {@get core config data from data base}
     */
    public function getConfig($config_path)
    {
        return $this->_scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}