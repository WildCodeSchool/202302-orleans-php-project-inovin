<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control border border-secondary placeholder-style',
                ],
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'form-label text-uppercase letter-spacing'
                ],
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control border border-secondary placeholder-style',
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label text-uppercase letter-spacing'
                ],
            ])
            ->add('date_birth', BirthdayType::class, [
                'attr' => [
                    'required' => false,
                    'placeholder' => 'JJ-MM-YYYY',
                    'class' => 'form-control border border-secondary placeholder-style w-100',
                ],
                'label' => 'Date de naissance',
                'label_attr' => [
                    'class' => 'form-label text-uppercase letter-spacing'
                ],
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd-MM-yyyy',
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'placeholder' => 'Adresse complète',
                    'class' => 'form-control border border-secondary placeholder-style',
                ],
                'label' => 'Adresse',
                'label_attr' => [
                    'class' => 'form-label text-uppercase letter-spacing'
                ],
            ])
            ->add('zip_code', TextType::class, [
                'attr' => [
                    'class' => 'form-control border border-secondary placeholder-style',
                ],
                'label' => 'Code postal',
                'label_attr' => [
                    'class' => 'form-label text-uppercase letter-spacing',
                ],
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'form-control border border-secondary placeholder-style',
                ],
                'label' => 'Ville',
                'label_attr' => [
                    'class' => 'form-label text-uppercase letter-spacing'
                ],
            ])
            ->add('country', TextType::class, [
                'attr' => [
                    'class' => 'form-control border border-secondary placeholder-style',
                ],
                'label' => 'Pays',
                'label_attr' => [
                    'class' => 'form-label text-uppercase letter-spacing'
                ],
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control border border-secondary placeholder-style',
                ],
                'label_attr' => [
                    'class' => 'form-label text-uppercase letter-spacing'
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'always_empty' => false,
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control border border-secondary placeholder-style'
                ],
                'label' => 'Mot de passe',
                'label_attr' => [
                    'class' => 'form-label text-uppercase letter-spacing'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6, 'max' => 50]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
