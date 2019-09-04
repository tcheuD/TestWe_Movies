<?php
namespace AppBundle\Form;


use AppBundle\Entity\Movie;
use AppBundle\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    "maxlength" => 70,

                ]
            ])
            ->add('duration', IntegerType::class)
            ->add('type', EntityType::class, [
                "class" => Type::class,
                'choice_label' => 'name',
                'multiple' => true,
                "expanded" => true
            ])
            ->add('people', CollectionType::class, array(
                'type' => new MovieHasPeopleForm(),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_name' => '__opt_prot__'
            ))
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Movie::class,
        ));
    }
}