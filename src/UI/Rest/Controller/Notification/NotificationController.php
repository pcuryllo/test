<?php

namespace App\UI\Rest\Controller\Notification;

use App\Domain\Message\Model\Message;
use App\Domain\Notification\Model\Notification;
use App\Domain\Notification\Model\NotificationObject;
use App\Domain\Notification\ValueObject\DateOfSending;
use App\Domain\User\Model\User;
use App\Infrastructure\Notification\Factory\Form\NotificationType;
use App\Service\NotificationService;
use App\UI\Rest\Controller\DefaultController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/notification")
 */
class NotificationController extends DefaultController
{
    /**
     * @Route("/test", name="notification_test")
     */
    public function index(Request $request, NotificationService $notificationService)
    {

        $user = new User("Admin", "Test");

        $notification1 = new Notification(
            "Tytuł notyfikacji",
            "Opis",
            new \DateTime(),
            $user,
            $user);

        $notificationService->send($notification1);

        return $this->json([
            'notification' => $notification1->toArray(),
        ]);
    }

    /**
     * @Route("/create", name="notification_create")
     */
    public function create(Request $request)
    {
        $user = new User("Test", "test");

        $messageModel = new Notification();

        $form = $this->createForm(NotificationType::class, $messageModel);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            return $this->json([
                'success' => true
            ]);
        } else {
            return $this->json([
                'success' => false,
                'errors' => $this->getErrorsFromForm($form),
                'post' => $request->request->all()
            ], 500);
        }

        return $this->json([
            'success' => false,
        ]);
    }
}
