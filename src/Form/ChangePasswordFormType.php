<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                    ],
                ],
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez entrer votre mot de passe.',
                        ]),
                        new Length([
                            'min' => 12,
                            'minMessage' => 'Le mot de passe doit comporter un minimum de {{ limit }} caractères.',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),

                        new NotCompromisedPassword([
                            'message' => 'Ce mot de passe figure dans une base de données compromise, veuillez en sélectionner un différent.',
                        ]),
                        new PasswordStrength(
                            ['message' => 'Votre mot de passe doit contenir au moins un caractère spécial tel que "@", "!", "?", ";"..."',]
                        ),
                        
                    ],
                    'label' => 'Saisissez votre nouveau mot de passe',
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                ],
                'invalid_message' => 'Les mots de passe doivent être identiques.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
