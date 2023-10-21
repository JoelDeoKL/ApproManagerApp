<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_produit')
            ->add('date_arrive')
            ->add('provenance')
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
            ->add('user')
            ->add('editer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
