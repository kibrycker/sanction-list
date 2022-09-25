<?php

namespace SanctionList\Form;

use SanctionList\Entity\Country;
use SanctionList\Entity\Directive;
use SanctionList\Entity\Organization;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrganizationType extends AbstractType
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
            ->add('requisite', TextType::class, [
                'label' => 'Реквизит организации (ИНН\ОГРН)',
                'required' => false,
                'attr' => [
                    'placeholder' => 'ИНН / ОГРН'
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Название организации',
                'required' => false,
                'attr' => [
                    'placeholder' => 'ООО "Лютик"'
                ],
            ])
            ->add('country', EntityType::class, [
                'placeholder' => 'Выберите страну, которая применила санкции',
                'label' => 'Страна',
                'class' => Country::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.id', 'DESC');
                },
//                'property_path' => 'country',
                'choice_value' => 'id',
                'choice_label' => 'name',
            ])
            ->add('date_inclusion', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Дата включения',
                'required' => false,
            ])
            ->add('date_exclusion', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Дата исключения',
                'required' => false,
                'attr' => [
                    'class' => 'js-sanction-date-exclusion',
                ],
            ])
            ->add('unknown_exdate', CheckboxType::class, [
                'label' => 'До распоряжения об отмене санкций',
                'required' => false,
                'attr' => [
                    'class' => 'js-sanction-unknown-exclude-date',
                ],
            ])
            ->add('directive', EntityType::class, [
                'placeholder' => 'Выберите директиву',
                'label' => 'Директива',
                'required' => false,
                'class' => Directive::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->orderBy('d.id', 'DESC');
                },
                'choice_value' => 'id',
                'choice_label' => 'name',
//                'property' => 'id',
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

//        $builder->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event) {
//            $data = $event->getData();
//            $form = $event->getForm();
//
//            /** @var $country Country */
//            $country = $data->getCountry();
//            $country = $country ? $country->getId() : false;
//
////            /** @var $region Region */
////            $region = $data['region'];
////            $region = $region ? $region->getId() : false;
////
////            $this->modifyForm($form, $country);
//        });


//        $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) {
//            $data = $event->getData();
//            $form = $event->getForm();
//
//            /** @var $country integer */
//            $country = $data->getCountry() ? (int)$data->getCountry() : null;
////            $region = (int)$data['region'];
//
////            $this->modifyForm($form, $country);
//        });
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
            'data_class' => Organization::class,
        ]);
    }
}
