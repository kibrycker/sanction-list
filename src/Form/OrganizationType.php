<?php

namespace SanctionList\Form;

use Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use SanctionList\Document\Country;
use SanctionList\Document\Directive;
use SanctionList\Document\Organization;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
                    'placeholder' => 'Реквизит организации (ИНН\ОГРН)'
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Название организации',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Название организации'
                ],
            ])
            ->add('country', DocumentType::class, [
                'placeholder' => 'Выберите страну, которая применила санкции',
                'label' => 'Страна',
                'class' => Country::class,
                'query_builder' => function(DocumentRepository $dr) {
                    return $dr->createQueryBuilder('c')
                        ->sort('id', 'DESC');
                },
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
            ->add('unknownExcDate', CheckboxType::class, [
                'label' => 'До распоряжения об отмене санкций',
                'required' => false,
                'attr' => [
                    'class' => 'js-sanction-unknown-exclude-date',
                ],
            ])
            ->add('basic', TextareaType::class, [
                'label' => 'Основание для введения санкций',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Основание для введения санкций',
                    'rows' => 5
                ]
            ])
            ->add('directive', DocumentType::class, [
                'placeholder' => 'Выберите директиву',
                'label' => 'Директива',
                'required' => false,
                'class' => Directive::class,
                'query_builder' => function(DocumentRepository $dr) {
                    return $dr->createQueryBuilder('d')
                        ->sort('id', 'DESC');
                },
                'choice_value' => 'id',
                'choice_label' => 'name',
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            $data = $event->getData();
            if (!$data->getDateCreate()) {
                $data->setDateCreate(new \DateTime());
            }

            $data->setDateUpdate(new \DateTime());
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
            'data_class' => Organization::class,
        ]);
    }
}
