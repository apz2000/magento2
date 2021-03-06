<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Magento_Captcha
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Captcha block for adminhtml area
 *
 * @category   Core
 * @package    Magento_Captcha
 * @author     Magento Core Team <core@magentocommerce.com>
 */
namespace Magento\Captcha\Block\Adminhtml\Captcha;

class DefaultCaptcha extends \Magento\Captcha\Block\Captcha\DefaultCaptcha
{
    /**
     * @var \Magento\Backend\Model\Url
     */
    protected $_url;

    /**
     * @var \Magento\Backend\App\ConfigInterface
     */
    protected $_config;

    /**
     * @param \Magento\View\Block\Template\Context $context
     * @param \Magento\Core\Helper\Data $coreData
     * @param \Magento\Captcha\Helper\Data $captchaData
     * @param \Magento\Backend\Model\Url $url
     * @param \Magento\Backend\App\ConfigInterface $config
     * @param array $data
     */
    public function __construct(
        \Magento\View\Block\Template\Context $context,
        \Magento\Core\Helper\Data $coreData,
        \Magento\Captcha\Helper\Data $captchaData,
        \Magento\Backend\Model\Url $url,
        \Magento\Backend\App\ConfigInterface $config,
        array $data = array()
    ) {
        parent::__construct($context, $coreData, $captchaData, $data);
        $this->_url = $url;
        $this->_config = $config;
    }


    /**
     * Returns URL to controller action which returns new captcha image
     *
     * @return string
     */
    public function getRefreshUrl()
    {
        return $this->_url->getUrl('adminhtml/refresh/refresh', array(
            '_secure' => $this->_config->getFlag('web/secure/use_in_adminhtml'),
            '_nosecret' => true
        ));
    }
}
