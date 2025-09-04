<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class MedicalProfessionalCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('medicalProfessionals', CollectionType::class, [
            'entry_type' => MedicalProfessionalType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => true,
            'entry_options' => [
                'attr' => ['class' => 'medical-item'],
            ],
        ])
            ->add('save', SubmitType::class, ['label' => 'Envoyer'])
        ;
    }
}
