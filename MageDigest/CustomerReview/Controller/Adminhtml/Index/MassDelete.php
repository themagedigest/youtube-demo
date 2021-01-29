<?php

namespace MageDigest\CustomerReview\Controller\Adminhtml\Index;
/**
 * Class MassDelete
 * @package MageDigest\CustomerReview\Controller\Adminhtml\Index
 */
class MassDelete extends \Magento\Backend\App\Action
{
    protected $_reviewsFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \MageDigest\CustomerReview\Model\ReviewsFactory $reviewsFactory
    )
    {
        $this->_reviewsFactory = $reviewsFactory;
        parent::__construct($context);
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $selectedIds = $data['selected'];
        try {
            foreach ($selectedIds as $selectedId) {
                $deleteData = $this->_reviewsFactory->create()->load($selectedId);
                $deleteData->delete();
            }
            $this->messageManager->addSuccess(__('Row data has been successfully deleted.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('md_cr/index/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('MageDigest_CustomerReview::home');
    }
}
