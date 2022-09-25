<?php

namespace SanctionList\Form;

use SanctionList\Entity\Directive;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DirectiveType extends AbstractType
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
            ->add('name', null, [
                'label' => 'Название директивы'
            ])
            ->add('description', null, [
                'label' => 'Описание директивы'
            ])
        ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            $data = $event->getData();
            if (!$data->getDateCreate()) {
                $data->setDateCreate(new \DateTime());
            }
            if (!$data->getDateUpdate()) {
                $data->setDateUpdate(new \DateTime());
            }
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
            'data_class' => Directive::class,
        ]);
    }
}
