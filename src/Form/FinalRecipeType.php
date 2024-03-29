<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\TastingSheet;
use App\Form\RecipeDosageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FinalRecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Nom de la recette',
                    'attr' => [
                        'required' => false,
                        'class' => 'form-control border border-secondary placeholder-style'
                    ],
                    'label_attr' => [
                        'class' => 'form-label text-uppercase letter-spacing'
                    ],
                ]
            )
            ->add('tastingSheet', CollectionType::class, [
                'label' => false,
                'entry_type' => RecipeDosageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'allow_extra_fields' => true,
                'entry_options' => [
                    'label' => false
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
