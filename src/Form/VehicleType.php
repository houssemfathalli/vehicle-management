<?php


namespace App\Form;

use App\Entity\Vehicle;
use App\Entity\Owner;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', TextType::class)
            ->add('modele', TextType::class)
            ->add('immatDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('immatNumber', TextType::class)
            ->add('owner', EntityType::class, [
                'class' => Owner::class,
                'choice_label' => 'name',
            ])
            ->add('features', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'entry_options' => [
                    'attr' => ['class' => 'form-control'],
                ],
                'by_reference' => false, // Pour gérer correctement les modifications
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
        ]);
    }
}
