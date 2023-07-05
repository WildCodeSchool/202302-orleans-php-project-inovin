<?php

namespace App\Twig\Components;

use App\Entity\Wine;
use App\Service\SendOrderService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveProp;

#[IsGranted('ROLE_USER')]
#[AsLiveComponent()]
class SendWineOrderComponent extends AbstractController
{
    use DefaultActionTrait;

    #[LiveProp]
    public int $nbrSendOrder = 0;

    #[LiveProp]
    public ?Wine $wine = null;

    public function __construct(private SendOrderService $sendOrderService)
    {
    }

    #[LiveAction]
    public function sendOrderByMail(): void
    {
        if ($this->sendOrderService->sendOrder($this->wine)) {
            $this->nbrSendOrder++;
        }
    }
}