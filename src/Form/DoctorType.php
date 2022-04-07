<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Entity\MedicalArea;
use App\Entity\Speciality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class DoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('photo', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image()
                ],
            ])
            ->add('description')
            ->add('email')
            ->add('phone')
            ->add('speciality', EntityType::class, [
                'class' => Speciality::class,
                'choice_label' => 'name'
            ])
            ->add('medicalAreas', EntityType::class, [
                'class' => MedicalArea::class,
                'choice_label' => 'name',
                'multiple' => true,
                // 'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Doctor::class,
        ]);
    }
}
