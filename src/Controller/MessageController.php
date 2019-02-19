<?php

namespace App\Controller;

use App\Form\MessageType;
use App\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MessageController
 * @package App\Controller
 * @Route("/message")
 */
class MessageController extends DefaultController
{
    /**
     * @Route("/create", name="message_create")
     */
    public function index(Request $request)
    {
        $messageModel = new Message();
        $form = $this->createForm(MessageType::class, $messageModel);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->json([
                'success' => true
            ]);
        } else {
            return $this->json([
                'success' => false,
                'errors' => $this->getErrorsFromForm($form),
            ], 500);
        }

        return $this->json([
            'success' => false,
        ]);
    }
}
