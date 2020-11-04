<?php
namespace MageDigest\Demo\Observer\Customer;

class RegisterSuccess implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(
        \Magento\Framework\Event\Observer $observer
    )
    {
        $customer = $observer->getEvent()->getData('customer');
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('Customer Details');
        $logger->info($customer->getEmail());
        $logger->info($customer->getFirstname());
    }
}