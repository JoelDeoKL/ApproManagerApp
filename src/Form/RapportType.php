<?php

namespace App\Form;

use App\Entity\Rapport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            ->add('nature')
            ->add('date_fabrication')
            ->add('date_expiration')
            ->add('type')
            ->add('nom_producteur')
            ->add('produit')
            ->add('operateur')
            ->add('auteur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
        ]);
    }
}
