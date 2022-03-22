<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Firstname
            ->add('firstname', TextType::class, [

                // label
                'label' => "Prénom",
                'label_attr' => [
                    'class' => "col-form-label",
                ],

                // make it required
                'required' => true,

                // Field attributes
                'attr' => [
                    'class' => "form-control",
                ],

                // Form constraints and error messages
                'constraints' => [
                    new NotBlank([
                        'message' => "Le prénom est obligatoire",
                    ]),
                    new Length([
                        'max' => 80,
                        'maxMessage' => "Votre prénom est limité à {{ limit }} caractères",
                    ]),
                ],
            ])

            // Lastname
            ->add('lastname', TextType::class, [

                // label
                'label' => "nom",
                'label_attr' => [
                    'class' => "col-form-label",
                ],

                // make it required
                'required' => true,

                // Field attributes
                'attr' => [
                    'class' => "form-control",
                ],

                // Form constraints and error messages
                'constraints' => [
                    new NotBlank([
                        'message' => "Le nom est obligatoire",
                    ]),
                    new Length([
                        'max' => 80,
                        'maxMessage' => "Votre nom est limité à {{ limit }} caractères",
                    ]),
                ],
            ])

            // Gender
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    "Homme" => "M",
                    "Femme" => "F",
                    "Ne sais pas" => "N",
                ],


                // label
                'label' => "Genre",
                'label_attr' => [
                    'class' => "col-form-label",
                ],

                // make it required
                'required' => true,

                // Field attributes
                'attr' => [
                    'class' => "form-control",
                ],

                // Form constraints and error messages
                'constraints' => [
                    new NotBlank([
                        'message' => "Le genre est obligatoire",
                    ]),
                ],
            ])

            // Email
            ->add('email' , EmailType::class, [

                // label
                'label' => "Email",
                'label_attr' => [
                    'class' => "col-form-label",
                ],

                // make it required
                'required' => true,

                // Field attributes
                'attr' => [
                    'class' => "form-control",
                ],

                // Form constraints and error messages
                'constraints' => [
                    new NotBlank([
                        'message' => "L'adresse email est obligatoire",
                    ]),
                ],
            ])

            // Password
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,

                'first_options'  => [
                    // label
                    'label' => "Mot de passe",
                    'label_attr' => [
                        'class' => "col-form-label",
                    ],

                    'empty_data' => '',

                    // Field attributes
                    'attr' => [
                        'class' => "form-control",
                    ],

                    'constraints' => [
                        new NotBlank([
                            'message' => "Le mot de passe est obligatoire",
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => "Le mot de passe doit avoir {{ limit }} caractères minimum.",
                            'max' => 40,
                            'maxMessage' => "Le mot de passe doit avoir {{ limit }} caractères maximum.",
                        ]),
                    ],
                ],

                'second_options' => [
                    // label
                    'label' => "Repeter le mot de passe",
                    'label_attr' => [
                        'class' => "col-form-label",
                    ],
                    // Field attributes
                    'attr' => [
                        'class' => "form-control",
                    ],
                ],

                'invalid_message' => "Le mot de passe ne sont pas identiques",
            ])

            // ->add('plainPassword', PasswordType::class, [
            //     // instead of being set onto the object directly,
            //     // this is read and encoded in the controller
            //     'mapped' => false,
            //     'attr' => ['autocomplete' => 'new-password'],
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Please enter a password',
            //         ]),
            //         new Length([
            //             'min' => 6,
            //             'minMessage' => 'Your password should be at least {{ limit }} characters',
            //             // max length allowed by Symfony for security reasons
            //             'max' => 4096,
            //         ]),
            //     ],
            // ])

            // Repeated Password

            // Birthday
            ->add('birthday')

            // Agree Terms
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
