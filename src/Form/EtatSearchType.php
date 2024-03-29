<?php

namespace App\Form;
use App\Entity\EtatSearch;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EtatSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etat',ChoiceType::class,['choices'=>['en Cours'=>'en Cours','Valide'=>'Valide','Termine'=>'Termine','Annule'=>'Annule','Expire'=>'Expire']] ) ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EtatSearch::class,
        ]);
    }
}
