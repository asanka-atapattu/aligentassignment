<?php

namespace Aligent\Assignment\Block\Index;

use Magento\Catalog\Block\Product\Context;
use Magento\Framework\View\Element\Template;

/**
 * Class Index
 * @package Aligent\Assignment\Block\Index
 */
class Index extends Template
{
    /**
     * Index constructor.
     * @param Context $context
     * @param array $data
     */
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * @return Template
     */
    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    /**
     * Get form action URL for POST booking request
     *
     * @return string
     */
    public function getFormAction()
    {
        return '/assignment/index/save';
        // here controller_name is index, action is save
    }
}
