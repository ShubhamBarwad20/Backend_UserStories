<?php
use Magento\Framework\App\Bootstrap;
use Magento\Framework\App\Area;
use Magento\Framework\App\State;
require __DIR__ . '/app/bootstrap.php';

// Bootstrap Magento
$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();
$state = $objectManager->get(State::class);
$state->setAreaCode(Area::AREA_ADMINHTML);

// Increase the price of all products
$productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection');
$products = $productCollection->addAttributeToSelect('*')->load();
foreach ($products as $product) {
    // check if product is simple
    if ($product->getTypeId() === 'simple') {
        echo "Updating price for product: " . $product->getName() . "\n";
        $price = $product->getPrice();
        $newPrice = $price + 1.79;
        $product->setPrice($newPrice);
        $product->save();
    }
}

echo "Price update completed.";