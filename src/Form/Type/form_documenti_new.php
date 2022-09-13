<?php

namespace App\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class form_documenti_new extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder->add('titolo_documento',TextType::class)
                 ->add('descrizione_documento', TextType::class);
    }
}