<?php

namespace App\Form;

use App\Entity\PeopleSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeopleSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Catégorie'
                ],
                'choices' => [
                    'Développeur WEB' => 'Développeur WEB',
                    'Développeur Logiciel' => 'Développeur Logiciel',
                    'Vidéaste' => 'Vidéaste'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PeopleSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
