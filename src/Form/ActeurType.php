<?php

namespace App\Form;

use App\Entity\Acteur;
use App\Entity\Film;
use App\Repository\FilmRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance')
            ->add('films', EntityType::class, 
                [
                    'label'=> "Films censure a vide",
                    'class' => Film::class,
    
                    'choice_label' => 'titre',
                    'multiple' => true,
                    'query_builder' => function(FilmRepository $repo) { 
                        return $repo->findByCensureVideQueryBuilder();
                }
                ]
            )      ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Acteur::class,
        ]);
    }
}
