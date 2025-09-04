<?php

namespace App\Form\Type;

use App\Dto\MedicalProfessional;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicalProfessionalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('uuid', TextType::class)

            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('placePosition', TextType::class)
            ->add('job', TextType::class)
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'pell-target'],
                'required' => false,
            ])            ->add('imagePath', TextType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MedicalProfessional::class,
        ]);
    }
}
