<?php

namespace MageDigest\CustomerReview\Controller\Adminhtml\Index;
/**
 * Class Save
 * @package MageDigest\CustomerReview\Controller\Adminhtml\Index
 */
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \MageDigest\CustomerReview\Model\ReviewsFactory
     */
    protected $_reviewsFactory;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \MageDigest\CustomerReview\Model\ReviewsFactory $reviewsFactory
     */
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
        $reviewId = isset($data['entity_id']) ? $data['entity_id'] : '';
        if (!$data) {
            $this->_redirect('md_cr/index/index');
        }
        try {
            $rowData = $this->_reviewsFactory->create()->load($reviewId);
            if (!$rowData->getId() && $reviewId) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('md_cr/index/index');
            }
            $rowData->setData($data);
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
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
