<?php

namespace App\Form;

use App\Entity\UserMedia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserMediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('avatar', FileType::class, [
            'required' => false,
            'label' => 'Avatar',
            'data_class' => null,
            'constraints' => [
                new File([
                    'maxSize' => '500k',
                ])
            ],
        ]);
    }   

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserMedia::class,
        ]);
    }
}
