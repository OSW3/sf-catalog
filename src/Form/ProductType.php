<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Brand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            // Title
            ->add('title', TextType::class, [

                // label
                'label' => "Nom du produit",
                'label_attr' => [
                    'class' => "col-sm-3 col-form-label",
                ],

                // make it required
                'required' => true,

                // Field attributes
                'attr' => [
                    'class' => "form-control",
                    'placeholder' => "Saisir le nom du produit",
                ],

                // Field helper
                'help' => "Merci de le nom du produit dans le champ",
                'help_attr' => [
                    'class' => "form-text text-muted",
                ],

                // Form constraints and error messages
                'constraints' => [
                    new NotBlank([
                        'message' => "Le nom du produit est obligatoire",
                    ]),
                    new Length([
                        'max' => 120,
                        'maxMessage' => "Le nom du produit est limité à {{ limit }} caracteres",
                    ]),
                ],

            ])

            // Description
            // label: Description du produit
            // min : 10 caracteres
            // max : 80 caracters
            ->add('description', TextareaType::class, [
                'label' => "Description du produit",
                'label_attr' => [
                    'class' => "col-sm-3 col-form-label",
                ],

                // make it required
                'required' => false,

                // Field attributes
                'attr' => [
                    'class' => "form-control",
                    'placeholder' => "Saisir la description du produit",
                ],

                // Field helper
                'help' => "Merci de saisir la description du produit dans le champ",
                'help_attr' => [
                    'class' => "form-text text-muted",
                ],

                // Form constraints and error messages
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'max' => 80,
                        'minMessage' => "La description du produit doit contenir au moin {{ limit }} caracteres",
                        'maxMessage' => "La description du produit est limité à {{ limit }} caracteres",
                    ]),
                ],

            ])

            // Price
            // label: Prix du produit en dollar
            // max : 999,99
            ->add('price', MoneyType::class, [

                // label
                'label' => "Prix du produit",
                'label_attr' => [
                    'class' => "col-sm-3 col-form-label",
                ],

                // make it required
                'required' => true,

                // Currency 
                'currency' => "USD",

                // convert <input type="text"> to <input type="number">
                'html5' => true,

                // Field attributes
                'attr' => [
                    'class' => "form-control",
                    'placeholder' => "Saisir le prix du produit",
                ],

                // Field helper
                'help' => "Merci de renseigner le prix du produit",
                'help_attr' => [
                    'class' => "form-text text-muted",
                ],

                // Form constraints and error messages
                'constraints' => [
                    new NotBlank([
                        'message' => "Le prix du produit est obligatoire",
                    ]),
                    new Length([
                        'max' => 120,
                        'maxMessage' => "Le prix du produit est limité à {{ limit }} caracteres",
                    ]),
                ],
            ])

            // Marque
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                
                // 'choice_label' => "name", 
                'choice_label' => function ($brand) {
                    return $brand->getId() ." - ". $brand->getName();
                }

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,

            'csrf_protection' => true,
            'csrf_field_name' => '_csrf_product_token',
            'csrf_token_id'   => '_csrf_product_token_id',
        ]);
    }
}
