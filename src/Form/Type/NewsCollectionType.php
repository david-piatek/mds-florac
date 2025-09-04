<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('news', CollectionType::class, [
            // each entry in the array will be an "email" field
            'entry_type' => NewsType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => true,
            'entry_options' => [
                'attr' => ['class' => 'new-item'],
            ],
        ])
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
        ;
    }
}
