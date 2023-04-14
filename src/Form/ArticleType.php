<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class)
            ->add('contenu', TextareaType::class)
            ->add('date', DateType::class)
            ->add('categories', EntityType::class,
            [
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Liste des catégories',
                
            ])
            ->add('user',EntityType::class,
            [
                'class' => User::class,
                'choice_label' => 'nom',
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'label' => 'Utilisateur',
                
            ])
            ->add('submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
