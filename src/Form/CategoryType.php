<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Category name
            ->add('name', TextType::class, [
                'label' => "Nom de la catégorie",
                'label_attr' => [
                    'class' => "col-sm-3 col-form-label",
                ],
                'required' => true,
                'attr' => [
                    'class' => "form-control",
                ],
                'help' => "Saisir le nom de la catégorie.",
                'help_attr' => [
                    'class' => "form-text text-muted",
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Le nom de la catégorie est obligatoire.",
                    ]),
                    new Length([
                        'max' => 80,
                        'maxMessage' => "Le nom de la catégorie est limité à {{ limit }} caractères.",
                    ])
                ]
            ])

            // Category description
            ->add('description', TextareaType::class, [
                'label' => "Description de la catégorie",
                'label_attr' => [
                    'class' => "col-sm-3 col-form-label",
                ],
                'required' => false,
                'attr' => [
                    'class' => "form-control",
                ],
                'help' => "Saisir la description de la catégorie.",
                'help_attr' => [
                    'class' => "form-text text-muted",
                ],
                // 'constraints' => [
                // ]
            ])

            // Category color (hexadecimal)
            ->add('color', ColorType::class, [
                'label' => "Couleur de la catégorie",
                'label_attr' => [
                    'class' => "col-sm-3 col-form-label",
                ],
                'required' => true,
                'attr' => [
                    'class' => "form-control",
                ],
                'help' => "Sélectionner la couleur de la catégorie.",
                'help_attr' => [
                    'class' => "form-text text-muted",
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "La couleur est obligatoire."
                    ]),
                    new Regex([
                        'pattern' => "/^#[\da-f]{6}$/i",
                        'message' => "La couleur doit être définie en hexadecimal."
                    ]),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
