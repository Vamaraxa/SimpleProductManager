<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'number',
                TextType::class,
                [
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add(
                'name',
                TextType::class,
                [
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add(
                'price',
                NumberType::class,
                [
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add(
                'priceNet',
                NumberType::class,
                [
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add(
                'vat',
                NumberType::class,
                [
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'attr' => ['class' => 'form-control'],
                    'required' => false
                ]
            )
            ->add(
                'published',
                CheckboxType::class,
                [
                    'attr' => ['class' => 'form-check-input'],
                    'required' => false,
                    'label_attr' => ['class' => 'form-check-label'],
                    'label' => 'Published'
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'attr' => ['class' => 'btn btn-success']
                ]
            )
            
            ->add(
                'delete',
                SubmitType::class,
                [
                    'attr' => ['class' => 'btn btn-danger']
                ]
            )
        ;
    }
}