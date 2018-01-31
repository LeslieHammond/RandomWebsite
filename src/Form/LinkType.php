<?php
// src/Form/LinkType.php
namespace App\Form;

use App\Entity\Link;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', UrlType::class, [
                'attr' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Link...'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr'  => [
                    'class' => 'btn btn-default btn-primary'
                ],
                'label' => 'Add link'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Link::class
        ]);
    }

}
