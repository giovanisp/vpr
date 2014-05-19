<?php

namespace PROCERGS\VPR\CoreBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends BaseType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'number', array(
            'required' => true,
            'max_length' => 12,
            'attr' => array(
                'type' => 'number',
                'pattern' => '[0-9]*'
            )
        ));
        $builder->add('firstname', 'text', array('required' => true));
        $builder->add('email', 'email', array('required' => false));
        $builder->add('mobile', 'number', array(
            'required' => false,
            'attr' => array(
                'type' => 'tel',
                'pattern' => '[0-9- ()+]*'
            )
        ));
    }

    public function getName()
    {
        return 'vpr_person_registration';
    }

}
