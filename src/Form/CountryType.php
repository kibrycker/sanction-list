<?php

namespace SanctionList\Form;

use SanctionList\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryType extends AbstractType
{
    /**
     * Создание формы
     *
     * @param FormBuilderInterface $builder Строитель формы
     * @param array                $options Настройки формы
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Название страны, союза, организации'
            ])
            ->add('hash', HiddenType::class, ['mapped' => false])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            $data = $event->getData();
            if (($name = $data->getName()) && !$data->getHash()) {
                $data->setHash(md5($name));
            }
            if (!$data->getDateCreate()) {
                $data->setDateCreate(new \DateTime());
            }
            if (!$data->getDateUpdate()) {
                $data->setDateUpdate(new \DateTime());
            }
        });

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();

            $normData = $form->getNormData();
            $normData->setHash(md5($data['name']));

            $form->setData($normData);
        });


    }

    /**
     * Конфигурация настроек
     *
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
        ]);
    }
}
