<?php

namespace Shubham\Us4\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;


class Router implements RouterInterface
{
    private $actionFactory;
    private $response;
    

    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response
    ) {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
    }

    public function match(RequestInterface $request): ?ActionInterface
    {
        $identifier = trim($request->getPathInfo(), '/');
        

        $parts = preg_split('/(?=[A-Z])/', $identifier, -1, PREG_SPLIT_NO_EMPTY);

        if (count($parts) === 3) {

            $parts = array_map('strtolower', $parts);

            $request->setModuleName($parts[0])
                ->setControllerName($parts[1])
                ->setActionName($parts[2]);
            
            // dump($request);
            
            return $this->actionFactory->create(Forward::class, ['request' => $request]);
        }
        return null;
        
    }
}