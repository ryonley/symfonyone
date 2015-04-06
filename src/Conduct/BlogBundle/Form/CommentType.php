<?php

namespace Conduct\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('author')
                ->add('author_email')
                ->add('author_url')
                ->add('content');


    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
           'data_class' => 'Conduct\BlogBundle\Entity\Comment'
        ));
    }

    public function getName()
    {
        return 'conduct_blogbundle_comment';
    }
}