<?php

namespace MageDigest\CustomerReview\Block\Adminhtml\Reviews\Edit;
/**
 * Class Form
 * @package MageDigest\CustomerReview\Block\Adminhtml\Reviews\Edit
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var
     */
    protected $_systemStore;

    /**
     * @var \MageDigest\CustomerReview\Model\Source\Approved
     */
    protected $_approved;

    /**
     * Form constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \MageDigest\CustomerReview\Model\Source\Approved $approved
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \MageDigest\CustomerReview\Model\Source\Approved $approved,
        array $data = []
    )
    {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_approved = $approved;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return Form
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(['data' => ['id' => 'edit_form', 'enctype' => 'multipart/form-data', 'action' => $this->getData('action'), 'method' => 'post']]);
        $form->setHtmlIdPrefix('md_cr_');
        if ($model) {
            $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Review Details'), 'class' => 'fieldset-wide']);
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        } else {
            $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Review Details'), 'class' => 'fieldset-wide']);
        }
        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Customer Email'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => $model ? true : false,
            ]
        );
        $fieldset->addField(
            'review',
            'text',
            [
                'name' => 'review',
                'label' => __('Review'),
                'title' => __('Review'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => $model ? true : false,
            ]
        );
        $fieldset->addField(
            'approved',
            'select',
            [
                'name' => 'approved',
                'label' => __('Approved'),
                'id' => 'approved',
                'title' => __('Approved'),
                'class' => 'required-entry approved',
                'values' => $this->_approved->toOptionArray(),
                'required' => true,
            ]
        );
        $form->setValues($model ? $model->getData() : '');
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
