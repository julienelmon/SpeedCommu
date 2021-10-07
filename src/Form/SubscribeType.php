<?php

namespace App\Form;

use App\Entity\Login;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\File;

class SubscribeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Rentrez un mots de passe',
                    ]),
                    New Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit être plus grand que {{ limit }}',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('category')
            ->add('visible')
            ->add('firstname')
            ->add('lastname')
            ->add('url_picture', FileType::class, [
                'label' => false,
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/gif',
                            'image/x-icon',
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => "Cette image n'est pas valide"
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Login::class,
            'translation_domain' => 'forms'
        ]);
    }
}
