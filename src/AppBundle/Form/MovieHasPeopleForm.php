<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 12/05/2018
 * Time: 13:42
 */

namespace AppBundle\Form;


use AppBundle\Entity\Movie;
use AppBundle\Entity\MovieHasPeople;
use AppBundle\Entity\Person;
use AppBundle\Enum\MovieRoleEnum;
use AppBundle\Enum\MovieSignificanceEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieHasPeopleForm extends AbstractType
{
    private $movie;

    public function MovieHasPeopleForm(Movie $movie) {
        $this->movie = $movie;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('person', EntityType::class, [
                "class" => Person::class,
                'choice_label' => 'fullname'
            ])
            ->add('role', ChoiceType::class, [
                'choices' => MovieRoleEnum::$values,
                'required' => true
            ])
            ->add('significance', ChoiceType::class, [
                'choices' => MovieSignificanceEnum::$values,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MovieHasPeople::class,
        ));
    }
}