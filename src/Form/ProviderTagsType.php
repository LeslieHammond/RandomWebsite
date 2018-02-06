<?php
// src/Form/ProviderTagsType.php
namespace App\Form;

use App\Entity\ProviderTags;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderTagsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tag', TextType::class, [
                'attr' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Tag'
                ]
            ])
            ->add('value', TextType::class, [
                'attr' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Value'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProviderTags::class
        ]);
    }

}
