<?php

namespace MageDigest\Demo\Controller\Adminhtml\Post;

use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;

/**
 * Class Index
 * @package MageDigest\Demo\Controller\Adminhtml\Post
 */
class Index extends \Magento\Backend\App\Action
{
    /**
     * Result Page Factory
     *
     * @var PageFactory
     */
    protected $resultPageFactory;


    /**
     * Index constructor.
     * @param PageFactory $resultPageFactory
     * @param Context $context
     */
    public function __construct(
        PageFactory $resultPageFactory,
        Context $context
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("Post"));
        return $resultPage;
    }
}
