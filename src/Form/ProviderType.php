<?php
// src/Form/ProviderType.php
namespace App\Form;

use App\Entity\Provider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Name'
                ]
            ])
            ->add('domain', TextType::class, [
                'attr'     => [
                    'class'       => 'form-control',
                    'placeholder' => 'Domain'
                ],
                'disabled' => 'disabled'
            ])
            ->add('providerTags', CollectionType::class, [
                'allow_add'     => true,
                'by_reference'  => false,
                'entry_type'    => ProviderTagsType::class,
                'entry_options' => ['label' => false]
            ])
            ->add('submit', SubmitType::class, [
                'attr'  => [
                    'class' => 'btn btn-primary'
                ],
                'label' => 'Update'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr'       => [
                'class' => 'form-horizontal'
            ],
            'data_class' => Provider::class
        ]);
    }

}
