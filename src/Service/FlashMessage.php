<?php
// src/Service/FlashMessage.php
namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class FlashMessage
{

    private $flashBag;

    public function __construct(RequestStack $requestStack)
    {
        $this->flashBag = $requestStack->getCurrentRequest()->getSession()->getFlashBag();
    }

    public function add($label, $message)
    {
        $this->flashBag->add($label, $message);
    }

    public function getAll($label)
    {
        return $this->flashBag->get($label, []);
    }
}
