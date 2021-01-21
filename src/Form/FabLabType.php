<?php

namespace App\Form;

use App\Entity\Fablab;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class FabLabType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
            ])
            ->add('siret', NumberType::class, [
                'label' => false,
            ])
            ->add('category', TextType::class, [
                'label' => false,
            ])
            ->add('city', TextType::class, [
                'label' => false,
            ])
            ->add('address', TextType::class, [
                'label' => false,
            ])
            ->add('schedule', TextType::class, [
                'label' => false,
            ])
            ->add('mail', EmailType::class, [
                'label' => false,
            ])
            ->add('phone', TelType::class, [
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FabLab::class,
        ]);
    }
}
