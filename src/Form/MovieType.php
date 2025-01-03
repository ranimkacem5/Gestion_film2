<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de la film',
                
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                    'required' => false,
    'allow_delete' => true,
    'delete_label' => 'Supprimer l\'image',
    'download_uri' => false,
    'image_uri' => true,
    'asset_helper' => true,
            ])
            ->add('description')
            ->add('releaseyear')
            ->add('duration')
            ->add('rating')
            ->add('director')
            ->add('Url')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
        
    }
}
