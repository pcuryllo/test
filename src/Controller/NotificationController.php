<?php

namespace App\Controller;

use App\Form\NotificationType;
use App\Model\Base\BaseNotification;
use App\Model\Message;
use App\Model\Notification;
use App\Model\NotificationObject;
use App\Service\NotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;

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

        // stworzenie przykładowej wiadomości
        $message = new Message();
        $message->setTitle('Testowa wiadomość');
        $message->setMessage('Treść wiadomości');

        // stworzenie nowej notyfikacji typu obiektowego
        $notification1 = new NotificationObject($message);
        $notification1->setTitle('Tytuł notyfikacji');
        $notification1->setDateOfSending(new \DateTime("+6 days"));

        $notificationService->send($notification1);

        $notification2 = new Notification();
        $notification2->setDateOfSending(new \DateTime());
        $notification2->markAsSeen();
        $notification2->setTitle('Przykładowa tekstowa notyfikacja');

        $notificationService->send($notification2);

        return $this->json([
            'notification1' => $notification1->toArray(),
            'notification2' => $notification2->toArray()
        ]);
    }

    /**
     * @Route("/create", name="notification_create")
     */
    public function create(Request $request)
    {
        $messageModel = new Notification();
        $form = $this->createForm(NotificationType::class, $messageModel);

        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
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
