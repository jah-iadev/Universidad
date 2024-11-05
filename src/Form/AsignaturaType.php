<?php

namespace App\Form;

use App\Entity\Asignatura;
use App\Entity\Aula;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AsignaturaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('creditos')
            ->add('aula', EntityType::class, [
                'class' => Aula::class, // Entidad relacionada
                'choice_label' => 'nombre', // Campo a mostrar en el select
                'label' => 'Aula',
                'placeholder' => 'Selecciona un Aula',
                'attr' => ['class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Asignatura::class,
        ]);
    }
}
