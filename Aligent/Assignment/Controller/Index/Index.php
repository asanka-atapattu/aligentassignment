<?php

namespace Aligent\Assignment\Controller\Index;

use Magento\Framework\App\Action\Action;

/**
 * Class Index
 * @package Aligent\Assignment\Controller\Index
 */
class Index extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
