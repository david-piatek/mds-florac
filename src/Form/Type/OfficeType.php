<?php

namespace App\Form\Type;

use App\Dto\News;
use App\Dto\Office;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfficeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void

    {
        $builder
            ->add('title', TextType::class)
            ->add('imagePath', FileType::class, [
                'label' => 'Brochure (PDF file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using attributes
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File(
                        maxSize: '1024k',
                        extensions: ['pdf'],
                        extensionsMessage: 'Please upload a valid PDF document',
                    )
                ],
            ])
            ->add('history', TextareaType::class, [
                'attr' => ['class' => 'pell-target'],
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'pell-target'],
                'required' => false,
            ])
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
    ;
    }

}
