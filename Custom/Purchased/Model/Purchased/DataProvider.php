<?php

namespace Custom\Purchased\Model\Purchased;

use Custom\Purchased\Model\ResourceModel\Purchased\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider {

    protected $collection;
    protected $dataPersistor;
    protected $loadedData;

    public function __construct(
    $name, $primaryFieldName, $requestFieldName, CollectionFactory $pageCollectionFactory, DataPersistorInterface $dataPersistor, \Magento\Framework\App\Filesystem\DirectoryList $directoryList, \Magento\Store\Model\StoreManagerInterface $storeManager, array $meta = [], array $data = [], PoolInterface $pool = null
    ) {
        $this->collection = $pageCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->directoryList = $directoryList;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
        $this->storeManager = $storeManager;
    }

    public function prepareMeta(array $meta) {
        return $meta;
    }

    public function getData() {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $rootPath = $this->directoryList->getPath('media') . "/";
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
            $tempData = $model->getData();
        }
        
        

        $data = $this->dataPersistor->get('purchased_form_data');
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('purchased_form_data');
        }

        if (empty($this->loadedData)) {
            return $this->loadedData;
        } else {
            $t2[$model->getId()] = $tempData;
            return $t2;
        }
    }

}
