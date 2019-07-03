<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null, ['attr' => ['class' => 'form-control form-control-sm']])
            ->add('emailCanonical', HiddenType::class)
            ->add('username', null, ['attr' => ['class' => 'form-control form-control-sm']])
            ->add('usernameCanonical', HiddenType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                        'class' => 'form-control form-control-sm'
                    ),
                ),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('enabled', HiddenType::class)
            ->add('salt', HiddenType::class)
            ->add('lastLogin', HiddenType::class)
            ->add('confirmationToken', HiddenType::class)
            ->add('passwordRequestedAt', HiddenType::class)
            ->add('last_activity', HiddenType::class, ['data' => 'Register'])
            ->add('tel_nr', null, ['attr' => ['class' => 'form-control form-control-sm']])
            ->add('mobile_nr', null, ['attr' => ['class' => 'form-control form-control-sm']])
            ->add('first_name', null, ['attr' => ['class' => 'form-control form-control-sm']])
            ->add('insertion_name', null, ['data' => '', 'label' => 'Middle name','required' => false, 'attr' => ['class' => 'form-control form-control-sm']])
            ->add('last_name', null, ['attr' => ['class' => 'form-control form-control-sm']])
            ->add('adress', null, ['attr' => ['class' => 'form-control form-control-sm']])
            ->add('zip', null, ['attr' => ['class' => 'form-control form-control-sm']])
            ->add('city', null, ['attr' => ['class' => 'form-control form-control-sm']])
            ->add('organisaties', HiddenType::class, ['data' => null, 'attr' => ['class' => 'form-control form-control-sm']])
            ->add('functions', HiddenType::class, ['data' => null, 'attr' => ['class' => 'form-control form-control-sm']])
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
