<?php

namespace App\Form;

use App\Entity\WineTaste;
use App\Entity\WineRegion;
use App\Entity\UserPreference;
use App\DataFixtures\WineTasteFixtures;
use App\DataFixtures\WineRegionFixtures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class QuizIntroductionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'wineKnowledge',
                ChoiceType::class,
                [
                    'label' => 'TU ES PLUTÔT ?',
                    'choices' => [
                        'Un amateur de vin désireux de découvrir et d’apprendre' => 'Amateur',
                        'Un bon connaisseur pour qui le vin n’a pas de secrets' => 'Connaisseur',
                        'Un véritable oenologue' => 'Oenologue',
                    ],
                    'attr' => [
                        'class' => 'my-custom-radio color-primary letter-spacing mb-3',
                    ],
                    'multiple' => false,
                    'expanded' => true,
                ]
            )
            ->add(
                'wineColour',
                ChoiceType::class,
                [
                    'label' => 'TU PRÉFÈRES ?',
                    'choices' => [
                        'Le vin rouge' => 'Le vin rouge',
                        'Le vin blanc' => 'Le vin blanc',
                        'Le vin rosé' => 'Le vin rosé',
                    ],
                    'attr' => [
                        'class' => 'my-custom-radio color-primary letter-spacing mb-3',
                    ],
                    'multiple' => false,
                    'expanded' => true,
                ]
            )
            ->add(
                'wineTaste',
                EntityType::class,
                [
                    'label' => 'AU PALAIS? C\'EST PLUS ?',
                    'attr' => [
                        'class' => 'my-custom-radio color-primary letter-spacing mb-3',
                    ],
                    'class' => WineTaste::class,
                    'expanded' => true,
                    'choice_label' => 'tasteName',
                ]
            )
            ->add(
                'wineRegion',
                EntityType::class,
                [
                    'label' => 'CÔTÉ TERROIR ?',
                    'attr' => [
                        'class' => 'my-custom-radio color-primary letter-spacing mb-3',
                    ],
                    'class' => WineRegion::class,
                    'expanded' => true,
                    'choice_label' => 'regionName',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserPreference::class,
        ]);
    }
}
