<?php

namespace App\Form;

use App\Entity\Alumno;
use App\Entity\Asignatura;
use App\Entity\Matricula;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatriculaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('curso')
            ->add('alumno', EntityType::class, [
                'class' => Alumno::class, // Entidad relacionada
                'choice_label' => 'nombre', // Campo a mostrar en el select
                'label' => 'Alumno',
                'placeholder' => 'Selecciona un Alumno',
                'attr' => ['class' => 'form-control'],
            ]) 
            ->add('asignatura', EntityType::class, [
                'class' => Asignatura::class, // Entidad relacionada
                'choice_label' => 'nombre', // Campo a mostrar en el select
                'label' => 'Asignatura',
                'placeholder' => 'Selecciona una Asignatura',
                'attr' => ['class' => 'form-control'],
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matricula::class,
        ]);
    }
}
