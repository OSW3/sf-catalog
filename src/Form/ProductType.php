<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
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
            ->add('description', TextareaType::class)

            // Price
            // label: Prix du produit en dollar
            // max : 999,99
            ->add('price', MoneyType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
