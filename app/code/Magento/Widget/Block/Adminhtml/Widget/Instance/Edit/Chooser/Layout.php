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
 * @package     Magento_Widget
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Widget\Block\Adminhtml\Widget\Instance\Edit\Chooser;

/**
 * Widget Instance layouts chooser
 *
 * @method getArea()
 * @method getTheme()
 */
class Layout extends \Magento\View\Block\Html\Select
{
    /**
     * @var \Magento\Core\Model\Layout\PageType\Config
     */
    protected $_config;

    /**
     * @param \Magento\View\Block\Context $context
     * @param \Magento\Core\Model\Layout\PageType\Config $config
     * @param array $data
     */
    public function __construct(
        \Magento\View\Block\Context $context,
        \Magento\Core\Model\Layout\PageType\Config $config,
        array $data = array()
    ) {
        $this->_config = $config;
        parent::__construct($context, $data);
    }

    /**
     * Add necessary options
     *
     * @return \Magento\View\Block\AbstractBlock
     */
    protected function _beforeToHtml()
    {
        if (!$this->getOptions()) {
            $this->addOption('', __('-- Please Select --'));
            $pageTypes = $this->_config->getPageTypes();
            $this->_addPageTypeOptions($pageTypes);
        }
        return parent::_beforeToHtml();
    }

    /**
     * Add page types information to the options
     *
     * @param array $pageTypes
     */
    protected function _addPageTypeOptions(array $pageTypes)
    {
        $label = array();
        // Sort list of page types by label
        foreach ($pageTypes as $key => $row) {
            $label[$key]  = $row['label'];
        }
        array_multisort($label, SORT_STRING, $pageTypes);

        foreach ($pageTypes as $pageTypeName => $pageTypeInfo) {
            $params = array();
            $this->addOption($pageTypeName, $pageTypeInfo['label'], $params);
        }
    }
}
