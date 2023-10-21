<?php

namespace App\Form;

use App\Entity\Declaration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeclarationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('qte_achete')
            ->add('qte_vendue')
            ->add('date_declaration')
            ->add('nature', ChoiceType::class, [
                'choices' => [
                    'Kilos' => 'Kilos',
                    'Tonnes' => 'Tonnes',
                    'Sacs' => 'Sacs',
                    'Cartons' => 'Cartons',
                    'Bidons' => 'Bidons'
                ],
            ])
            ->add('produit')
            ->add('user')
            ->add('stocks')
            ->add('editer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Declaration::class,
        ]);
    }
}
