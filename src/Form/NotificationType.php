<?php

namespace App\Form;

use App\Form\DataTransformer\UserToNumberTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NotificationType extends AbstractType
{
    private $userToNumberTransformer = null;

    public function __construct(UserToNumberTransformer $userToNumberTransformer)
    {
        $this->userToNumberTransformer = $userToNumberTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('dateOfSending', DateTimeType::class, [
                'invalid_message' => 'Please enter a valid date with time for sending date: yyyy-MM-dd HH:mm:ss',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ])
            ->add('sender', TextType::class)
            ->add('recipient', TextType::class)
        ;

        $builder->get('sender')->addModelTransformer($this->userToNumberTransformer);
        $builder->get('recipient')->addModelTransformer($this->userToNumberTransformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false
        ]);
    }
}
