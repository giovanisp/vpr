<?php

namespace PROCERGS\VPR\CoreBundle\Form\Type\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class BallotBoxFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('poll', 'entity', array(
                'class' => 'PROCERGSVPRCoreBundle:Poll',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.openingTime', 'DESC');
                },                
                'property' => 'name',
                'empty_value' => 'Todos',
                'required' => false
            ))
            ->add('city', 'entity', array(
                'class' => 'PROCERGSVPRCoreBundle:City',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'empty_value' => 'Todos',
                'property' => 'name',
                'required' => false
            ))
            ->add('is_online', 'choice', array(
                'choices' => array(true => 'Sim', false => 'Não'),
                'empty_value' => 'Todos',
                'required' => false
            ));
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'procergs_vpr_corebundle_ballotbox_filter';
    }
}
