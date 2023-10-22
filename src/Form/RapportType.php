<?php

namespace App\Form;

use App\Entity\Rapport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            ->add('nature', ChoiceType::class, [
                'choices' => [
                    'Kilos' => 'Kilos',
                    'Tonnes' => 'Tonnes',
                    'Sacs' => 'Sacs',
                    'Cartons' => 'Cartons',
                    'Bidons' => 'Bidons'
                ],
            ])
            ->add('date_fabrication')
            ->add('date_expiration')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'DGDA' => 'DGDA',
                    'Division Provincial' => 'Division Provincial'
                ],
            ])
            ->add('nom_producteur')
            ->add('produit')
            ->add('operateur')
            ->add('auteur')
            ->add('editer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
        ]);
    }
}
