<?php

namespace App\Form;

use App\Entity\CharacterRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CharacterRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('characterName', TextType::class, [
                'label' => 'Nom du personnage',
                'required' => 'true',
                'attr' => [
                    'placeholder' => 'Golum',
                ]
            ])
            ->add('clan', ChoiceType::class, [
                'label' => 'Clan',
                'required' => 'true',
                'choices' => [
                    'Nosferatu' => 'Nosferatu',
                    'Ventrue' => 'Ventrue',
                    'Gangrel' => 'Gangrel',
                    'Brujah' => 'Brujah',
                    'Toréador' => 'Toréador',
                    'Malkavian' => 'Malkavian',
                    'Trémère' => 'Trémère',
                    'Ravnos' => 'Ravnos',
                    'Giovani' => 'Giovani',
                    'Assamite' => 'Assamite',
                    'Settite' => 'Settite',
                    'Lasombra' => 'Lasombra',
                    'Caïtif' => 'Caïtif',
                    'Tzimisce' => 'Tzimisce',
                ],
            ])
            ->add('secte', ChoiceType::class, [
                'label' => 'Secte',
                'required' => 'true',
                'choices' => [
                    'Camarilla' => 'Camarilla',
                    'Anarch' => 'Anarch',
                    'Sabbat' => 'Sabbat',
                    'Aubain' => 'Aubain',
                ],
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut d\'âge',
                'required' => 'true',
                'choices' => [
                    'Infant sous tutelle' => 'Infant sous tutelle',
                    'Nouveau née' => 'Nouveau née',
                    'Ancilla' => 'Ancilla',
                    'Ancien' => 'Ancien',
                    'Vénérable' => 'Vénérable',
                    'Aucun' => 'Aucun',
                ],
            ])
            ->add('pattern', TextareaType::class, [
                'label' => 'Motif de la demande',
                'required' => 'true',
                'attr' => [
                    'placeholder' => 'Mettez votre motif ici !',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CharacterRequest::class,
        ]);
    }
}
