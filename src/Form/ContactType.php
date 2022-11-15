<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => 'true',
                'attr' => [
                    'placeholder' => 'Juste',
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => 'true',
                'attr' => [
                    'placeholder' => 'LEBLANC',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => 'true',
                'attr' => [
                    'placeholder' => 'quandtereveraisje@message.com',
                ]
            ])
            ->add('nickname', TextType::class, [
                'label' => 'Pseudo si inscrit (Falcutatif)',
                'required' => 'false',
                'attr' => [
                    'placeholder' => 'PaysMerveilleux',
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'required' => 'true',
                'attr' => [
                    'placeholder' => 'Mettez votre message ici !',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
