<?php

namespace TSS\AutomailerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AutomailerType extends AbstractType implements \Symfony\Component\Form\FormTypeInterface
{
    private $class;

    /**
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fromEmail')
            ->add('fromName')
            ->add('toEmail')
            ->add('subject')
            ->add('body')
            ->add('altBody')
            ->add('createdAt')
            ->add('sentAt')
            ->add('isHtml')
            ->add('isSent')
            ->add('isFailed')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
        ));
    }

    public function getName()
    {
        return 'automailer';
    }
}
