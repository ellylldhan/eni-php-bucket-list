<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Idea;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\BooleanToStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdeaType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
           $builder
            ->add('title', TextType::class, [
                "label" => "Titre",
                "attr"  => [
                    "class"       => "form-control",
                    "placeholder" => "ex. Sauter en parachute !",
                ]
            ])
            ->add('description', TextareaType::class, [
                "label" => "Description",
                "attr"  => [
                    "class" => "form-control",
                ]
            ])
            ->add('author', TextType::class, [
                "label" => "Auteur",
                "attr"  => [
                    "class" => "form-control",
                ]
            ])
            ->add('category', ChoiceType::class, [
                "label"        => "Category",
                "choice_label" => "name",
                "attr"         => [
                    "class" => "form-control",
                ]
            ]);
//            ->add('dateCreated', DateTimeType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(['data_class' => Idea::class,]);
    }
}
