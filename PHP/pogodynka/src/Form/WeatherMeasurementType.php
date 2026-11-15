<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\WeatherMeasurement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeatherMeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('measuredAt', DateTimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])
            ->add('temperature', NumberType::class, [
                'scale' => 2,
                'html5' => true,
            ])
            ->add('pressure', NumberType::class, [
                'scale' => 2,
                'html5' => true,
            ])
            ->add('humidity', IntegerType::class)
            ->add('windSpeed', NumberType::class, [
                'scale' => 2,
                'html5' => true,
            ])
            ->add('windDirection', IntegerType::class)
            ->add('cloudCover', IntegerType::class)
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WeatherMeasurement::class,
        ]);
    }
}
