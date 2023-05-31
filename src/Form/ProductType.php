<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'number',
                null,
                                [
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                ]
            )
            ->add(
                'name',
                null,
                                [
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                ]
            )
            ->add(
                'price',
                null,
                                [
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                ]
            )
            ->add(
                'priceNet',
                null,
                                [
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                ]
            )
            ->add(
                'vat',
                null,
                                [
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                ]
            )
            ->add(
                'description',
                null,
                                [
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                ]
            )
            ->add(
                'published',
                null,
                                [
                    'attr' => ['class' => 'form-check-input'],
                    'required' => false,
                    'label_attr' => ['class' => 'form-check-label'],
                    'label' => 'Published'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
