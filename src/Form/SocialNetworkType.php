<?php

namespace App\Form;

use App\Entity\SocialNetwork;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocialNetworkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('linkFB', TextType::class, [
                'required' => false,
            ])
            ->add('linkInstagram', TextType::class, [
                'required' => false,
            ])
            ->add('linkTwitter', TextType::class, [
                'required' => false,
            ])
            ->add('linkTumblr', TextType::class, [
                'required' => false,
            ])
            ->add('linkDeviantArt', TextType::class, [
                'required' => false,
            ])
            ->add('linkGithub', TextType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SocialNetwork::class,
        ]);
    }
}
